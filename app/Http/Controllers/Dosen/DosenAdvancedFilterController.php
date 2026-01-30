<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\MahasiswaRole;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DosenAdvancedFilterController extends Controller
{
    /**
     * Show the advanced filter page
     */
    public function index()
    {
        $roles = MahasiswaRole::all();
        return view('dosen.advanced-filter', compact('roles'));
    }

    /**
     * Apply advanced filters and return results
     */
    public function apply(Request $request)
    {
        try {
            $filters = $request->input('filters');
            
            if (empty($filters)) {
                $dataMahasiswa = Mahasiswa::join('users', 'mahasiswa.mahasiswa_id', '=', 'users.user_id')
                    ->where('users.role', 'Mahasiswa')
                    ->select('mahasiswa.*', 'users.name', 'users.email')
                    ->paginate(10);
                $no = 10 * ($dataMahasiswa->currentPage() - 1);
                return view('dosen.partials.mahasiswaTable', compact('dataMahasiswa', 'no'));
            }

            $query = Mahasiswa::join('users', 'mahasiswa.mahasiswa_id', '=', 'users.user_id')
                ->where('users.role', 'Mahasiswa')
                ->select('mahasiswa.*', 'users.name', 'users.email');

            $this->applyFilterGroup($query, $filters);

            $dataMahasiswa = $query->distinct()->orderBy('mahasiswa.mahasiswa_id')->paginate(10);
            $no = 10 * ($dataMahasiswa->currentPage() - 1);

            if ($dataMahasiswa->isEmpty()) {
                $error = "Tidak ada mahasiswa yang sesuai dengan kriteria filter.";
                return view('dosen.partials.mahasiswaTable', compact('dataMahasiswa', 'no', 'error'));
            }

            return view('dosen.partials.mahasiswaTable', compact('dataMahasiswa', 'no'));

        } catch (\Exception $e) {
            Log::error('Advanced Filter Error: ' . $e->getMessage());
            $error = "Terjadi kesalahan saat memproses filter.";
            $dataMahasiswa = collect();
            $no = 0;
            return view('dosen.partials.mahasiswaTable', compact('dataMahasiswa', 'no', 'error'));
        }
    }

    /**
     * Recursively apply filter groups with AND/OR logic
     */
    private function applyFilterGroup($query, $filterGroup)
    {
        $logic = $filterGroup['logic'] ?? 'and';
        $rules = $filterGroup['rules'] ?? [];
        $groups = $filterGroup['groups'] ?? [];

        $query->where(function ($q) use ($rules, $groups, $logic) {
            // Apply individual rules
            foreach ($rules as $index => $rule) {
                if ($index === 0 && $logic === 'and') {
                    $this->applyRule($q, $rule, 'where');
                } elseif ($index === 0 && $logic === 'or') {
                    $this->applyRule($q, $rule, 'where');
                } elseif ($logic === 'and') {
                    $this->applyRule($q, $rule, 'where');
                } else {
                    $this->applyRule($q, $rule, 'orWhere');
                }
            }

            // Apply nested groups
            foreach ($groups as $index => $group) {
                if (($index === 0 && empty($rules)) || $logic === 'and') {
                    $this->applyFilterGroup($q, $group);
                } else {
                    $q->orWhere(function ($subQuery) use ($group) {
                        $this->applyFilterGroup($subQuery, $group);
                    });
                }
            }
        });
    }

    /**
     * Apply individual filter rule
     */
    private function applyRule($query, $rule, $method = 'where')
    {
        $field = $rule['field'];
        $operator = $rule['operator'];
        $value = $rule['value'];

        // Map field names to database columns
        $fieldMap = [
            'nama' => 'users.name',
            'nim' => 'mahasiswa.NIM',
            'email' => 'users.email',
            'tanggal_lahir' => 'mahasiswa.tanggal_lahir',
            'prodi' => 'mahasiswa.prodi',
            'nomor_hp' => 'mahasiswa.nomor_hp',
            'role_id' => 'mahasiswa.role_id',
            'created_at' => 'mahasiswa.created_at'
        ];

        $dbField = $fieldMap[$field] ?? $field;

        switch ($operator) {
            case 'equals':
                $query->$method($dbField, '=', $value);
                break;
            case 'not_equals':
                $query->$method($dbField, '!=', $value);
                break;
            case 'contains':
                $query->$method($dbField, 'like', "%{$value}%");
                break;
            case 'not_contains':
                $query->$method($dbField, 'not like', "%{$value}%");
                break;
            case 'starts_with':
                $query->$method($dbField, 'like', "{$value}%");
                break;
            case 'ends_with':
                $query->$method($dbField, 'like', "%{$value}");
                break;
            case 'before':
                $query->$method($dbField, '<', Carbon::parse($value)->format('Y-m-d'));
                break;
            case 'after':
                $query->$method($dbField, '>', Carbon::parse($value)->format('Y-m-d'));
                break;
            case 'on_or_before':
                $query->$method($dbField, '<=', Carbon::parse($value)->format('Y-m-d'));
                break;
            case 'on_or_after':
                $query->$method($dbField, '>=', Carbon::parse($value)->format('Y-m-d'));
                break;
            case 'between':
                if (is_array($value) && count($value) === 2) {
                    $query->$method(function ($q) use ($dbField, $value) {
                        $q->whereBetween($dbField, [
                            Carbon::parse($value[0])->format('Y-m-d'),
                            Carbon::parse($value[1])->format('Y-m-d')
                        ]);
                    });
                }
                break;
            case 'greater_than':
                $query->$method($dbField, '>', $value);
                break;
            case 'less_than':
                $query->$method($dbField, '<', $value);
                break;
            case 'greater_or_equal':
                $query->$method($dbField, '>=', $value);
                break;
            case 'less_or_equal':
                $query->$method($dbField, '<=', $value);
                break;
            case 'is_empty':
                $query->$method(function ($q) use ($dbField) {
                    $q->whereNull($dbField)->orWhere($dbField, '=', '');
                });
                break;
            case 'is_not_empty':
                $query->$method(function ($q) use ($dbField) {
                    $q->whereNotNull($dbField)->where($dbField, '!=', '');
                });
                break;
        }
    }

    /**
     * Get filter options (fields, operators, etc.)
     */
    public function getOptions()
    {
        $roles = MahasiswaRole::all();
        
        return response()->json([
            'fields' => [
                ['value' => 'nama', 'label' => 'Nama'],
                ['value' => 'nim', 'label' => 'NIM'],
                ['value' => 'email', 'label' => 'Email'],
                ['value' => 'prodi', 'label' => 'Program Studi'],
                ['value' => 'tanggal_lahir', 'label' => 'Tanggal Lahir'],
                ['value' => 'nomor_hp', 'label' => 'Nomor HP'],
                ['value' => 'role_id', 'label' => 'Role / Intensitas'],
                ['value' => 'created_at', 'label' => 'Tanggal Dibuat'],
            ],
            'operators' => [
                'text' => [
                    ['value' => 'equals', 'label' => 'Sama dengan'],
                    ['value' => 'not_equals', 'label' => 'Tidak sama dengan'],
                    ['value' => 'contains', 'label' => 'Mengandung'],
                    ['value' => 'not_contains', 'label' => 'Tidak mengandung'],
                    ['value' => 'starts_with', 'label' => 'Dimulai dengan'],
                    ['value' => 'ends_with', 'label' => 'Diakhiri dengan'],
                    ['value' => 'is_empty', 'label' => 'Kosong'],
                    ['value' => 'is_not_empty', 'label' => 'Tidak kosong'],
                ],
                'number' => [
                    ['value' => 'equals', 'label' => 'Sama dengan'],
                    ['value' => 'not_equals', 'label' => 'Tidak sama dengan'],
                    ['value' => 'greater_than', 'label' => 'Lebih besar dari'],
                    ['value' => 'less_than', 'label' => 'Lebih kecil dari'],
                    ['value' => 'greater_or_equal', 'label' => 'Lebih besar atau sama dengan'],
                    ['value' => 'less_or_equal', 'label' => 'Lebih kecil atau sama dengan'],
                ],
                'date' => [
                    ['value' => 'equals', 'label' => 'Pada tanggal'],
                    ['value' => 'before', 'label' => 'Sebelum'],
                    ['value' => 'after', 'label' => 'Sesudah'],
                    ['value' => 'on_or_before', 'label' => 'Pada atau sebelum'],
                    ['value' => 'on_or_after', 'label' => 'Pada atau sesudah'],
                    ['value' => 'between', 'label' => 'Antara'],
                ],
            ],
            'roles' => $roles->map(function ($role) {
                return ['value' => $role->id, 'label' => $role->name];
            })
        ]);
    }
}
