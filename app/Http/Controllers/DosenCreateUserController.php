<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DosenCreateUserController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the entire request
            $validator = Validator::make($request->all(), [
                'users' => 'required|array',
                'users.*.email' => 'required|email|unique:users,email',
                'users.*.password' => 'required|min:8',
                'users.*.name' => 'required|string',
                'users.*.nim' => 'required|string|unique:mahasiswas,NIM',
                'users.*.prodi' => 'nullable|string',
                'users.*.tanggal_lahir' => 'nullable|date',
                'users.*.phone' => 'nullable|string',
                'users.*.role' => 'required|in:role_1,role_2'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $createdUsers = [];

            DB::beginTransaction();

            foreach ($request->users as $userData) {
                // Create user
                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'role' => 'Mahasiswa'
                ]);

                // Create mahasiswa
                $mahasiswa = Mahasiswa::create([
                    'mahasiswa_id' => $user->user_id,
                    'NIM' => $userData['nim'],
                    'prodi' => $userData['prodi'],
                    'tanggal_lahir' => $userData['tanggal_lahir'],
                    'nomor_hp' => $userData['phone'],
                    'mahasiswa_role' => $userData['role']
                ]);

                // Store created user data for response
                $createdUsers[] = [
                    'user' => $user,
                    'mahasiswa' => $mahasiswa
                ];
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Users created successfully',
                'data' => $createdUsers
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create users',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
