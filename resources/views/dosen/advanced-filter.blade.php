@extends('navbar/navbar-dosen')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Advanced Filter - Notion Style</title>

<style>
    body {
        background-color: #191919;
    }

    .filter-container {
        background-color: #1e1e1e;
        border: 1px solid #2e2e2e;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 12px;
    }

    .filter-group {
        background-color: #252525;
        border: 1px solid #333;
        border-radius: 6px;
        padding: 16px;
        margin: 8px 0;
        margin-left: 20px;
        position: relative;
    }

    .filter-group::before {
        content: '';
        position: absolute;
        left: -20px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #404040;
    }

    .filter-rule {
        background-color: #2a2a2a;
        border: 1px solid #3a3a3a;
        border-radius: 4px;
        padding: 12px;
        margin: 8px 0;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-select, .filter-input {
        background-color: #1e1e1e;
        border: 1px solid #404040;
        color: #e0e0e0;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 14px;
        outline: none;
        transition: all 0.2s;
    }

    .filter-select:hover, .filter-input:hover {
        border-color: #5a5a5a;
    }

    .filter-select:focus, .filter-input:focus {
        border-color: #2196F3;
        box-shadow: 0 0 0 2px rgba(33, 150, 243, 0.1);
    }

    .logic-badge {
        background-color: #2e2e2e;
        border: 1px solid #404040;
        color: #b0b0b0;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.2s;
        min-width: 60px;
        text-align: center;
    }

    .logic-badge:hover {
        background-color: #353535;
        border-color: #5a5a5a;
    }

    .logic-badge.and {
        color: #4CAF50;
        border-color: #4CAF50;
    }

    .logic-badge.or {
        color: #FF9800;
        border-color: #FF9800;
    }

    .btn-add {
        background-color: transparent;
        border: 1px dashed #404040;
        color: #b0b0b0;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-add:hover {
        background-color: #2a2a2a;
        border-color: #5a5a5a;
        color: #e0e0e0;
    }

    .btn-remove {
        background-color: transparent;
        border: 1px solid #ff4444;
        color: #ff4444;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-remove:hover {
        background-color: #ff4444;
        color: white;
    }

    .btn-apply {
        background-color: #2196F3;
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(33, 150, 243, 0.3);
    }

    .btn-apply:hover {
        background-color: #1976D2;
        box-shadow: 0 4px 12px rgba(33, 150, 243, 0.4);
    }

    .btn-reset {
        background-color: transparent;
        border: 1px solid #666;
        color: #b0b0b0;
        padding: 12px 24px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-reset:hover {
        background-color: #2a2a2a;
        border-color: #888;
        color: #e0e0e0;
    }

    .filter-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #333;
    }

    .filter-label {
        color: #b0b0b0;
        font-size: 13px;
        font-weight: 500;
        min-width: 80px;
    }

    .section-title {
        color: #e0e0e0;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .info-badge {
        background-color: #2a2a2a;
        border: 1px solid #404040;
        color: #888;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 12px;
        margin-bottom: 16px;
        display: inline-block;
    }

    .results-section {
        background-color: #1e1e1e;
        border: 1px solid #2e2e2e;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
    }

    .date-inputs {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .date-separator {
        color: #666;
        font-weight: 600;
    }
</style>

<section class="p-6 mt-[80px] mx-auto max-w-7xl">
    <div class="mb-6">
        <h1 class="section-title">Advanced Filter</h1>
        <p class="info-badge">
            🎨 Notion-inspired filtering interface
        </p>
    </div>

    <div class="filter-container">
        <div id="filterBuilder">
            <!-- Main filter group will be rendered here by JavaScript -->
        </div>

        <div class="mt-6 flex gap-3">
            <button onclick="applyFilters()" class="btn-apply">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Terapkan Filter
            </button>
            <button onclick="resetFilters()" class="btn-reset">
                Reset
            </button>
            <button onclick="window.location.href='{{ route('dosen.home') }}'" class="btn-reset">
                Kembali ke Home
            </button>
        </div>
    </div>

    <div class="results-section" id="resultsSection" style="display: none;">
        <h2 class="section-title mb-4">Hasil Filter</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-400">
                <thead class="text-xs text-white uppercase bg-[#388da8]">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">NIM</th>
                        <th scope="col" class="px-6 py-3">Prodi</th>
                        <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Nomor HP</th>
                        <th scope="col" class="px-6 py-3">Role</th>
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
