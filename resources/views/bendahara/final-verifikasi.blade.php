<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verifikasi Final Pengajuan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- CARD UTAMA --}}
            <div class="bg-white shadow-2xl rounded-2xl border border-gray-100 overflow-hidden">
                <div class="p-8 md:p-10">
                    {{-- SECTION 1: HEADER INFORMASI PENGAJUAN --}}
                    <div class="mb-10 pb-10 border-b-2 border-gray-100">
                        {{-- Title with Icon --}}
                        <div class="flex items-start gap-4 mb-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-b from-[#003A8F] to-[#002766] rounded-lg flex items-center justify-center shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-semmibold text-gray-900 mb-2">
                                    {{ $pengajuan->pengajuan_name }}
                                </h3>
                                <p class="text-sm text-gray-500">ID Pengajuan: #{{ $pengajuan->id }}</p>
                            </div>
                        </div>

                        {{-- Info Pemohon --}}
                        <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl p-6 mb-3 border border-gray-200 shadow-sm">
                            <div class="flex items-center gap-2 mb-5">
                                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-800 text-sm uppercase tracking-wide">Informasi Pemohon</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                                    <div class="text-xs text-gray-500 mb-2 font-medium uppercase tracking-wider">Nama Pemohon</div>
                                    <div class="font-medium text-gray-900 text-base">
                                        {{ $pengajuan->user->name }}
                                    </div>
                                </div>

                                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                                    <div class="text-xs text-gray-500 mb-2 font-medium uppercase tracking-wider">Email</div>
                                    <div class="font-medium text-gray-900 text-base break-all">
                                        {{ $pengajuan->user->email }}
                                    </div>
                                </div>

                                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                                    <div class="text-xs text-gray-500 mb-2 font-medium uppercase tracking-wider">Divisi</div>
                                    <div class="font-medium text-gray-900 text-base capitalize">
                                        {{ $pengajuan->user->role }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Timeline --}}
                        <div class="bg-white rounded-xl p-5 mb-3 border border-gray-200 shadow-sm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500 font-medium">Tanggal Dibuat</div>
                                        <div class="font-semibold text-gray-800 text-sm">
                                            {{ $pengajuan->created_at->translatedFormat('d M Y — H:i') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500 font-medium">Terakhir Diupdate</div>
                                        <div class="font-semibold text-gray-800 text-sm">
                                            {{ $pengajuan->updated_at->translatedFormat('d M Y — H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Status Badges --}}
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h4 class="font-medium text-gray-800 text-sm uppercase tracking-wide">Status Pengajuan</h4>
                            </div>
                            
                            <div class="flex flex-wrap gap-3">
                                @if ($pengajuan->status_kelengkapan == 'Belum Lengkap' && $pengajuan->status_verifikasi == 0)
                                    <div class="px-4 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            Dalam Proses
                                        </span>
                                    </div>
                                @endif

                                <span class="px-4 py-2.5 rounded-xl text-sm font-semibold shadow-md
                                    {{ $pengajuan->status_kelengkapan == 'Lengkap' 
                                        ? 'bg-gradient-to-r from-green-500 to-green-600 text-white' 
                                        : 'bg-gradient-to-r from-yellow-400 to-yellow-500 text-white' }}">
                                    <span class="flex items-center gap-2">
                                        @if ($pengajuan->status_kelengkapan == 'Lengkap')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @endif
                                        {{ ucfirst($pengajuan->status_kelengkapan) }}
                                    </span>
                                </span>

                                <span class="px-4 py-2.5 rounded-xl text-sm font-semibold shadow-md
                                    {{ $pengajuan->status_verifikasi 
                                        ? 'bg-gradient-to-r from-green-500 to-green-600 text-white' 
                                        : 'bg-gradient-to-r from-red-400 to-red-500 text-white' }}">
                                    <span class="flex items-center gap-2">
                                        @if ($pengajuan->status_verifikasi)
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0121 12c0 5.523-4.477 10-10 10S1 17.523 1 12 5.477 2 11 2c1.821 0 3.527.465 5.017 1.28" />
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @endif
                                        {{ $pengajuan->status_verifikasi ? 'Terverifikasi' : 'Belum Diverifikasi' }}
                                    </span>
                                </span>

                                <span class="px-4 py-2.5 rounded-xl text-sm font-semibold shadow-md
                                    {{ $pengajuan->status_diarsipkan 
                                        ? 'bg-gradient-to-r from-teal-500 to-teal-600 text-white' 
                                        : 'bg-gray-200 text-gray-700' }}">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                        </svg>
                                        {{ $pengajuan->status_diarsipkan ? 'Diarsipkan' : 'Belum Diarsipkan' }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 2: PEMERIKSA --}}
                    <div class="mb-3 pb-10 border-b-2 border-gray-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 bg-gradient-to-b from-[#003A8F] to-[#002766] rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wide">Diperiksa Oleh</h3>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-4 border-2 border-purple-200 shadow-md">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-semibold text-purple-600 mb-1 uppercase tracking-wide">Nama</div>
                                        <div class="text-gray-900 font-bold">{{ $pengajuan->finance_officer->name ?? '-' }}</div>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-pink-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-semibold text-pink-600 mb-1 uppercase tracking-wide">Email</div>
                                        <div class="text-gray-900 font-bold break-all">{{ $pengajuan->finance_officer->email ?? '-' }}</div>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-semibold text-indigo-600 mb-1 uppercase tracking-wide">Divisi</div>
                                        <div class="text-gray-900 font-bold capitalize">{{ $pengajuan->finance_officer->role ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 3: FILE PENGAJUAN & UPLOAD --}}
                    <div class="mb-10">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 bg-gradient-to-b from-[#003A8F] to-[#002766] rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wide">File Pengajuan</h3>
                        </div>

                        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-r-xl p-5 mb-6">
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm text-blue-800 leading-relaxed">
                                    Mohon untuk <span class="font-bold">menandatangani dokumen pengajuan</span> berikut sebelum dilakukan proses verifikasi final.
                                </p>
                            </div>
                        </div>

                        {{-- File Info --}}
                        <div class="bg-gradient-to-br from-white to-gray-50 border-2 border-gray-200 rounded-2xl p-6 mb-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="flex items-start gap-5">
                                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 rounded-lg shadow-md">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs font-bold text-gray-500 mb-2 uppercase tracking-wider">Nama File</p>
                                    <p class="text-gray-900 font-bold text-lg break-all">
                                        {{ basename($pengajuan->path_file_pengajuan) ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-3 mt-6 pt-6 border-t-2 border-gray-200">
                                <a href="{{ asset('storage/' . $pengajuan->path_file_pengajuan) }}" target="_blank"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800
                                   text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat Dokumen
                                </a>

                                <a href="{{ route('keuangan.download', $pengajuan->id) }}"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200
                                   text-gray-700 text-sm font-bold rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Download File
                                </a>
                            </div>
                        </div>

                        {{-- Upload Form --}}
                        <form action="{{ route('bendahara.verification', $pengajuan->id) }}" method="POST"
                            enctype="multipart/form-data" class="bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-300 rounded-2xl p-8 shadow-lg">

                            @method('PUT')
                            @csrf

                            @if (!$pengajuan->status_kelengkapan || !$pengajuan->status_diarsipkan)
                                <div class="flex items-center gap-3 mb-5">
                                    <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <label class="block font-bold text-gray-800 text-sm uppercase tracking-wide">
                                        Upload File Bertanda Tangan
                                    </label>
                                </div>

                                <div class="bg-white border-2 border-dashed border-green-300 rounded-xl p-6 mb-6 hover:border-green-400 transition-colors duration-200">
                                    <input type="file" name="file_pengajuan" class="block w-full text-sm text-gray-700 file:mr-4 file:py-3 file:px-6
                                        file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-gradient-to-r file:from-blue-600 file:to-blue-700
                                        file:text-white hover:file:from-blue-700 hover:file:to-blue-800 file:shadow-md hover:file:shadow-lg
                                        file:transition-all file:duration-200 cursor-pointer focus:outline-none" required>
                                </div>

                                <button type="submit"
                                    class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 
                                    text-white font-bold text-base rounded-xl shadow-lg hover:shadow-xl 
                                    transform hover:-translate-y-0.5 transition-all duration-200 
                                    flex items-center justify-center gap-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Upload dan Verifikasi Final
                                </button>
                            @else
                                <div class="bg-gradient-to-br from-gray-100 to-gray-200 border-2 border-gray-300 rounded-xl p-6 text-center">
                                    <div class="flex justify-center mb-4">
                                        <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 font-semibold">
                                        File pengajuan sudah lengkap & diarsipkan.
                                    </p>
                                    <p class="text-xs text-gray-500 mt-2">
                                        Tidak dapat diperbarui lagi.
                                    </p>
                                </div>
                            @endif

                        </form>
                    </div>

                    {{-- SECTION 4: TOMBOL KEMBALI --}}
                    <div class="pt-2">
                        <a href="{{ route('bendahara.dashboard') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 
                            text-white font-semibold rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                            Kembali ke Dashboard
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>