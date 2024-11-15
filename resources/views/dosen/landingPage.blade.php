@extends('navbar/navbar-dosen')
@section('content')
<title>Admin Panel</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="p-2 relative overflow-x-auto mt-[80px] mx-1 mb-5">
    <div class="flex border-2 mt-5 mb-2 ms-0 border-[#388da8] overflow-hidden max-w-md mx-auto font-[sans-serif]">
        <input type="text" id="search" placeholder="Search Something..." class="w-full outline-none bg-white text-gray-600 text-sm px-4 py-3" data-search-url="{{ route('dosen.search') }}" />

        <button type='button' class="flex items-center justify-center bg-[#388da8] px-5 text-sm text-white">
          Search
        </button>
    </div>


    <table  class="w-full text-sm text-left rtl:text-right text-gray-500  dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-[#388da8] text-center">
            <tr>
                <th scope="col" class="p-4"></th>
                <th scope="col" class="px-6 py-3">Nama</th>
                <th scope="col" class="px-6 py-3">NIM</th>
                <th scope="col" class="px-6 py-3">Prodi</th>
                <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Nomor Telepon</th>
                <th scope="col" class="px-6 py-3">Role</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody id="mahasiswaTable">
            @include('dosen.partials.mahasiswaTable', ['dataMahasiswa' => $dataMahasiswa, 'no' => $no])
        </tbody>
    </table>
    <div class="mt-4" style="margin-right: 20px">{{ $dataMahasiswa->links('pagination::bootstrap-5') }}</div>
</section>

{{-- <script>
    document.getElementById('search').addEventListener('input', function() {
        let query = this.value;

        fetch(`{{ route('dosen.search') }}?query=${query}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('mahasiswaTable').innerHTML = data;
        });
    });
</script> --}}


@endsection
