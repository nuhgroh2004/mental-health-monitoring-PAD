@extends('navbar/navbar-dosen')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Advanced Filter - Notion Style</title>

<style>
    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    body {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%, #dee2e6 100%);
        min-height: 100vh;
    }

    .filter-container {
        background: #ffffff;
        border: 2px solid #388da8;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 4px 20px rgba(56, 141, 168, 0.15);
    }

    .filter-group {
        background: #f8f9fa;
        border: 1px solid rgba(56, 141, 168, 0.3);
        border-radius: 8px;
        padding: 20px;
        margin: 12px 0;
        margin-left: 28px;
        position: relative;
        transition: all 0.3s ease;
    }

    .filter-group:hover {
        background: #ffffff;
        border-color: rgba(56, 141, 168, 0.5);
        box-shadow: 0 2px 8px rgba(56, 141, 168, 0.1);
    }

    .filter-group::before {
        content: '';
        position: absolute;
        left: -28px;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(180deg, #388da8 0%, #2a6d82 100%);
        border-radius: 2px;
    }

    .filter-rule {
        background: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 14px;
        margin: 10px 0;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        transition: all 0.2s ease;
    }

    .filter-rule:hover {
        background: #f8f9fa;
        border-color: rgba(56, 141, 168, 0.4);
        transform: translateX(2px);
    }

    .filter-select, .filter-input {
        background: #ffffff;
        border: 1px solid #ced4da;
        color: #212529;
        padding: 10px 14px;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
        transition: all 0.2s ease;
        min-width: 160px;
    }

    .filter-select:hover, .filter-input:hover {
        border-color: #388da8;
        background: #f8f9fa;
    }

    .filter-select:focus, .filter-input:focus {
        border-color: #388da8;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(56, 141, 168, 0.1);
    }

    .filter-select option {
        background-color: #ffffff;
        color: #212529;
        padding: 8px;
    }

    .logic-badge {
        background: #ffffff;
        border: 1.5px solid #388da8;
        color: #388da8;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.2s ease;
        min-width: 70px;
        text-align: center;
    }

    .logic-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(56, 141, 168, 0.3);
        background: #388da8;
        color: #ffffff;
    }

    .logic-badge.and {
        background: linear-gradient(135deg, #388da8 0%, #2a6d82 100%);
        color: #ffffff;
        border-color: #388da8;
    }

    .logic-badge.and:hover {
        background: linear-gradient(135deg, #2a6d82 0%, #1f5261 100%);
        border-color: #2a6d82;
    }

    .logic-badge.or {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: #ffffff;
        border-color: #17a2b8;
    }

    .logic-badge.or:hover {
        background: linear-gradient(135deg, #138496 0%, #0f6674 100%);
        border-color: #138496;
    }

    .btn-add {
        background: transparent;
        border: 1.5px dashed #388da8;
        color: #388da8;
        padding: 10px 18px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-add:hover {
        background: rgba(56, 141, 168, 0.1);
        border-color: #388da8;
        border-style: solid;
        color: #2a6d82;
        transform: translateY(-1px);
    }

    .btn-remove {
        background: transparent;
        border: 1px solid #dc3545;
        color: #dc3545;
        padding: 8px 14px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-remove:hover {
        background: #dc3545;
        border-color: #dc3545;
        color: #ffffff;
        transform: scale(1.05);
    }

    .btn-apply {
        background: linear-gradient(135deg, #388da8 0%, #2a6d82 100%);
        border: none;
        color: #ffffff;
        padding: 14px 32px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(56, 141, 168, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-apply:hover {
        background: linear-gradient(135deg, #2a6d82 0%, #1f5261 100%);
        box-shadow: 0 6px 24px rgba(56, 141, 168, 0.4);
        transform: translateY(-2px);
    }

    .btn-reset {
        background: #ffffff;
        border: 1px solid #ced4da;
        color: #495057;
        padding: 14px 28px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-reset:hover {
        background: #f8f9fa;
        border-color: #388da8;
        color: #388da8;
        transform: translateY(-1px);
    }

    .filter-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
        padding-bottom: 14px;
        border-bottom: 2px solid rgba(56, 141, 168, 0.2);
    }

    .filter-label {
        color: #495057;
        font-size: 13px;
        font-weight: 600;
        min-width: 85px;
        letter-spacing: 0.5px;
    }

    .page-title {
        color: #212529;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 24px;
    }

    .results-section {
        background: #ffffff;
        border: 2px solid #388da8;
        border-radius: 12px;
        padding: 28px;
        margin-top: 24px;
        box-shadow: 0 4px 20px rgba(56, 141, 168, 0.15);
    }

    .results-title {
        color: #212529;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .results-section table {
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #dee2e6;
    }

    .results-section thead {
        background: linear-gradient(135deg, #388da8 0%, #2a6d82 100%);
    }

    .results-section tbody tr {
        border-bottom: 1px solid #dee2e6;
        transition: all 0.2s ease;
    }

    .results-section tbody tr:hover {
        background: rgba(56, 141, 168, 0.05);
    }

    .date-inputs {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .date-separator {
        color: #388da8;
        font-weight: 700;
        font-size: 16px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .filter-container, .results-section {
        animation: fadeIn 0.4s ease-out;
    }
</style>

<section class="p-6 mt-[80px] mx-auto max-w-7xl">
    <div class="mb-6">
        <h1 class="page-title">Filter Lanjutan</h1>
        <p class="page-subtitle">
            Buat filter kompleks dengan kondisi bertingkat untuk pencarian data mahasiswa yang lebih spesifik
        </p>
    </div>

    <div class="filter-container">
        <div id="filterBuilder">
            <!-- Main filter group will be rendered here by JavaScript -->
        </div>

        <div class="mt-6 flex gap-3 flex-wrap">
            <button onclick="applyFilters()" class="btn-apply">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Terapkan Filter
            </button>
            <button onclick="resetFilters()" class="btn-reset">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Reset Filter
            </button>
            <button onclick="window.location.href='{{ route('dosen.home') }}'" class="btn-reset">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </button>
        </div>
    </div>

    <div class="results-section" id="resultsSection" style="display: none;">
        <h2 class="results-title">Hasil Filter</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-300">
                <thead class="text-xs text-white uppercase">
                    <tr>
                        <th scope="col" class="px-6 py-4">No</th>
                        <th scope="col" class="px-6 py-4">Nama</th>
                        <th scope="col" class="px-6 py-4">NIM</th>
                        <th scope="col" class="px-6 py-4">Prodi</th>
                        <th scope="col" class="px-6 py-4">Tanggal Lahir</th>
                        <th scope="col" class="px-6 py-4">Email</th>
                        <th scope="col" class="px-6 py-4">Nomor HP</th>
                        <th scope="col" class="px-6 py-4">Role</th>
                    </tr>
                </thead>
                <tbody id="resultsTable">
                    <!-- Results will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/dosen/advanced-filter.js') }}"></script>

@endsection
