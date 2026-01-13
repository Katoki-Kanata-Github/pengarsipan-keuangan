<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verifikasi Final Pengajuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- CARD UTAMA --}}
            <div class="bg-white shadow-lg sm:rounded-xl border border-gray-100 p-8">

                {{-- SECTION 1: HEADER INFORMASI PENGAJUAN --}}
                <div class="mb-8 pb-8 border-b-2 border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">
                        {{ $pengajuan->pengajuan_name }}
                    </h3>

                    {{-- Info Pemohon --}}
                    <div class="bg-gray-50 rounded-lg p-5 mb-6">
                        <h4 class="font-semibold text-gray-800 mb-4 text-sm uppercase tracking-wide">Informasi Pemohon
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                            <div>
                                <div class="text-gray-500 mb-1">Nama Pemohon</div>
                                <div class="font-medium text-gray-900">
                                    {{ $pengajuan->user->name }}
                                </div>
                            </div>

                            <div>
                                <div class="text-gray-500 mb-1">Email</div>
                                <div class="font-medium text-gray-900">
                                    {{ $pengajuan->user->email }}
                                </div>
                            </div>

                            <div>
                                <div class="text-gray-500 mb-1">Divisi</div>
                                <div class="font-medium text-gray-900 capitalize">
                                    {{ $pengajuan->user->role }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Timeline --}}
                    <div class="flex flex-wrap items-center gap-6 text-gray-600 text-sm mb-6">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0
                002-2V7a2 2 0 00-2-2H5a2 2 0
                00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Dibuat: <span class="font-medium text-gray-800">
                                    {{ $pengajuan->created_at->translatedFormat('d M Y — H:i') }}
                                </span></span>
                        </div>

                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0
                11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Update: <span class="font-medium text-gray-800">
                                    {{ $pengajuan->updated_at->translatedFormat('d M Y — H:i') }}
                                </span></span>
                        </div>
                    </div>

                    {{-- Status Badges --}}
                    <div class="bg-blue-50 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-3 text-sm uppercase tracking-wide">Status Pengajuan
                        </h4>
                        <div class="flex flex-wrap gap-3">
                            @if ($pengajuan->status_kelengkapan == 'Belum Lengkap' && $pengajuan->status_verifikasi == 0)
                                <div class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-700">
                                    Tahapan: Dalam Proses
                                </div>
                            @endif

                            <span
                                class="px-3 py-1 rounded-full text-sm font-medium
                                {{ $pengajuan->status_kelengkapan == 'Lengkap' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                Kelengkapan: {{ ucfirst($pengajuan->status_kelengkapan) }}
                            </span>

                            <span
                                class="px-3 py-1 rounded-full text-sm font-medium
                                {{ $pengajuan->status_verifikasi ? 'bg-green-100 text-green-700' : 'bg-red-200 text-red-600' }}">
                                {{ $pengajuan->status_verifikasi ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' }}
                            </span>

                            <span
                                class="px-3 py-1 rounded-full text-sm font-medium
                                {{ $pengajuan->status_diarsipkan ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $pengajuan->status_diarsipkan ? 'Diarsipkan' : 'Belum Diarsipkan' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: PEMERIKSA --}}
                <div class="mb-8 pb-8 border-b-2 border-gray-200">
                    <h3 class="font-semibold text-lg text-gray-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Diperiksa Oleh
                    </h3>

                    <div class="bg-gray-50 rounded-lg p-5 border border-gray-200">
                        <div class="space-y-3 text-gray-700">
                            <div class="flex">
                                <span class="font-medium w-20">Nama:</span>
                                <span class="text-gray-900">{{ $pengajuan->finance_officer->name ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="font-medium w-20">Email:</span>
                                <span class="text-gray-900">{{ $pengajuan->finance_officer->email ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="font-medium w-20">Divisi:</span>
                                <span
                                    class="text-gray-900 capitalize">{{ $pengajuan->finance_officer->role ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: FILE PENGAJUAN & UPLOAD --}}
                <div class="mb-8 pb-8 border-b-2 border-gray-200">
                    <h3 class="font-semibold text-lg text-gray-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        File Pengajuan
                    </h3>

                    <p class="text-sm text-blue-800 leading-relaxed mb-6">
                        Mohon untuk <span class="font-semibold">menandatangani dokumen pengajuan</span> berikut
                        sebelum dilakukan proses verifikasi final.
                    </p>

                    {{-- File Info --}}
                    <div class="bg-white border-2 border-gray-200 rounded-lg p-5 mb-6">
                        <div class="flex items-start gap-4">
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 mb-1">Nama File:</p>
                                <p class="text-gray-900 font-semibold break-all">
                                    {{ basename($pengajuan->path_file_pengajuan) ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-3 mt-5 pt-5 border-t border-gray-200">
                            <a href="{{ route('view.file', $pengajuan->id) }}" target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700
                   text-white text-sm font-medium rounded-lg shadow-sm transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat Dokumen
                            </a>

                            <a href="{{ route('download.file', $pengajuan->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200
                   text-gray-700 text-sm font-medium rounded-lg shadow-sm transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>

                    {{-- Upload Form --}}
                    <form action="{{ route('bendahara.verification', $pengajuan->id) }}" method="POST"
                        enctype="multipart/form-data" class="bg-green-50 border-2 border-green-200 rounded-lg p-6">

                        @method('PUT')
                        @csrf

                        @if (!$pengajuan->status_kelengkapan || !$pengajuan->status_diarsipkan)
                            {{-- Upload File Bertanda Tangan --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                                <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200">
                                    <div class="p-2 bg-blue-100 rounded-lg">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-lg text-gray-800">Upload File Bertanda Tangan
                                        </h3>
                                        <p class="text-xs text-gray-500 mt-0.5">Unggah dokumen yang telah
                                            ditandatangani</p>
                                    </div>
                                    <span
                                        class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Wajib</span>
                                </div>

                                <div class="space-y-4">
                                    {{-- File Input --}}
                                    <div class="relative">
                                        <input id="file_pengajuan" type="file" name="file_pengajuan"
                                            accept="application/pdf"
                                            class="block w-full text-sm text-gray-700
                file:mr-4 file:py-2.5 file:px-5
                file:rounded-lg file:border-0
                file:text-sm file:font-semibold
                file:bg-blue-600 file:text-white
                hover:file:bg-blue-700
                cursor-pointer
                border-2 border-gray-300 rounded-xl
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                transition duration-150"
                                            onchange="updateFileName(this)" required>
                                    </div>

                                    {{-- Selected File Display --}}
                                    <div id="file-display"
                                        class="hidden p-4 bg-green-50 rounded-lg border border-green-200">
                                        <div class="flex items-center gap-3">
                                            <div class="p-2 bg-green-100 rounded-lg">
                                                <svg class="w-5 h-5 text-green-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xs text-green-600 font-medium mb-0.5">File Berhasil
                                                    Dipilih</p>
                                                <p id="selected-file-name"
                                                    class="text-sm font-semibold text-gray-800 truncate"></p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Info Box --}}
                                    <div
                                        class="flex items-start gap-3 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div class="text-sm text-blue-800">
                                            <p class="font-semibold mb-2">Pastikan dokumen memenuhi syarat:</p>
                                            <ul class="list-disc list-inside space-y-1 text-xs ml-1">
                                                <li>Dokumen telah ditandatangani oleh pihak yang berwenang</li>
                                                <li>File dalam format PDF yang dapat dibaca dengan baik</li>
                                                <li>Tanda tangan terlihat jelas dan tidak terpotong</li>
                                                <li>Semua halaman dokumen lengkap dan sesuai urutan</li>
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Requirements Grid --}}
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                        <div
                                            class="flex items-center gap-2 p-3 bg-white rounded-lg border border-gray-200">
                                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-xs font-medium text-gray-700">Format PDF</span>
                                        </div>
                                        <div
                                            class="flex items-center gap-2 p-3 bg-white rounded-lg border border-gray-200">
                                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-xs font-medium text-gray-700">Max 50MB</span>
                                        </div>
                                        <div
                                            class="flex items-center gap-2 p-3 bg-white rounded-lg border border-gray-200">
                                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-xs font-medium text-gray-700">Bertanda Tangan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- JavaScript untuk Update File Name --}}
                            <script>
                                function updateFileName(input) {
                                    const fileDisplay = document.getElementById('file-display');
                                    const fileName = document.getElementById('selected-file-name');

                                    if (input.files && input.files[0]) {
                                        fileName.textContent = input.files[0].name;
                                        fileDisplay.classList.remove('hidden');
                                    } else {
                                        fileDisplay.classList.add('hidden');
                                    }
                                }
                            </script>

                            {{-- Input Biaya yang Dibayarkan --}}
                            <div class="bg-white border-2 border-gray-200 rounded-lg p-6 mb-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="p-2 bg-green-100 rounded-lg">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <label class="block font-semibold text-gray-800 text-sm">Biaya yang
                                            Dibayarkan</label>
                                        <p class="text-xs text-gray-500 mt-0.5">Masukkan nominal biaya untuk pengajuan
                                            ini</p>
                                    </div>
                                </div>

                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="text-gray-700 font-semibold text-base">Rp</span>
                                    </div>
                                    <input type="number" name="biaya" value="{{ $pengajuan->biaya ?? '' }}"
                                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-lg text-gray-800 font-medium
            placeholder-gray-400 focus:ring-2 focus:ring-green-400 focus:border-green-500 focus:outline-none
            transition-all duration-200 bg-white shadow-sm hover:border-green-300"
                                        placeholder="0" min="0" step="1000">
                                </div>

                                <div
                                    class="flex items-start gap-2 mt-3 p-3 bg-green-50 rounded-lg border border-green-200">
                                    <svg class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-xs text-green-800">
                                        Masukkan nominal biaya dalam Rupiah. Pastikan nominal sesuai dengan dokumen
                                        pengajuan.
                                    </p>
                                </div>
                            </div>

                            {{-- Input Nomor Kuitansi Section --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                                <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200">
                                    <div class="p-2 bg-indigo-100 rounded-lg">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg text-gray-800">Nomor Kuitansi</h3>
                                        <p class="text-xs text-gray-500 mt-0.5">Masukkan nomor kuitansi untuk pengajuan
                                            ini
                                        </p>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <input type="text" name="kuitansi" value="{{ $kuitansi ?? '' }}" required
                                        class="w-full border-2 border-gray-300 rounded-lg p-3 text-gray-800 font-medium placeholder-gray-400
                focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 focus:outline-none
                transition-all duration-200 bg-white shadow-sm hover:border-indigo-300"
                                        placeholder="Contoh: KWT/2024/001">

                                    <div
                                        class="flex items-start gap-2 p-3 bg-indigo-50 rounded-lg border border-indigo-200">
                                        <svg class="w-4 h-4 text-indigo-600 mt-0.5 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        <p class="text-xs text-indigo-800">
                                            Nomor kuitansi bersifat opsional. Pastikan format nomor sesuai dengan
                                            standar
                                            institusi Anda.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Input No SPM --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                                <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200">
                                    <div class="p-2 bg-purple-100 rounded-lg">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg text-gray-800">Nomor SPM</h3>
                                        <p class="text-xs text-gray-500 mt-0.5">Masukkan nomor Surat Perintah Membayar
                                            (SPM)</p>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <input type="text" name="no_spm" value="{{ $no_spm ?? '' }}"
                                        class="w-full border-2 border-gray-300 rounded-lg p-3 text-gray-800 font-medium placeholder-gray-400
            focus:ring-2 focus:ring-purple-400 focus:border-purple-500 focus:outline-none
            transition-all duration-200 bg-white shadow-sm hover:border-purple-300"
                                        placeholder="Contoh: SPM/2024/001">

                                    <div
                                        class="flex items-start gap-2 p-3 bg-purple-50 rounded-lg border border-purple-200">
                                        <svg class="w-4 h-4 text-purple-600 mt-0.5 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        <p class="text-xs text-purple-800">
                                            Nomor SPM bersifat opsional. Pastikan format nomor sesuai dengan standar
                                            pencatatan keuangan institusi.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Metode Pembayaran & Sumber Dana Section --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                {{-- Metode Pembayaran --}}
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                    <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200">
                                        <div class="p-2 bg-emerald-100 rounded-lg">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-lg text-gray-800">Metode Pembayaran</h3>
                                            <p class="text-xs text-gray-500 mt-0.5">Pilih metode pembayaran</p>
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <select name="payment_method" id="payment_method"
                                            class="w-full border-2 border-gray-300 rounded-lg p-3 text-gray-800 font-medium
                focus:ring-2 focus:ring-emerald-400 focus:border-emerald-500 focus:outline-none
                transition-all duration-200 bg-white shadow-sm hover:border-emerald-300
                appearance-none cursor-pointer"
                                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e');
                background-repeat: no-repeat;
                background-position: right 1rem center;
                background-size: 1.5em 1.5em;
                padding-right: 3rem;"
                                            required>
                                            <option value="" selected disabled class="text-gray-400">Pilih
                                                metode pembayaran...</option>
                                            @foreach ($payment_method as $payment)
                                                <option value="{{ $payment->id }}" class="text-gray-800">
                                                    {{ $payment->payment_method_name }} - {{ $payment->sub_category }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div
                                            class="flex items-start gap-2 p-3 bg-emerald-50 rounded-lg border border-emerald-200">
                                            <svg class="w-4 h-4 text-emerald-600 mt-0.5 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-xs text-emerald-800">
                                                Pilih metode pembayaran yang sesuai dengan kebutuhan pengajuan
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Sumber Dana --}}
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                    <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200">
                                        <div class="p-2 bg-amber-100 rounded-lg">
                                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-lg text-gray-800">Sumber Dana</h3>
                                            <p class="text-xs text-gray-500 mt-0.5">Pilih sumber dana</p>
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <select name="funding_source" id="funding_source"
                                            class="w-full border-2 border-gray-300 rounded-lg p-3 text-gray-800 font-medium
                focus:ring-2 focus:ring-amber-400 focus:border-amber-500 focus:outline-none
                transition-all duration-200 bg-white shadow-sm hover:border-amber-300
                appearance-none cursor-pointer"
                                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e');
                background-repeat: no-repeat;
                background-position: right 1rem center;
                background-size: 1.5em 1.5em;
                padding-right: 3rem;"
                                            required>
                                            <option value="" selected disabled class="text-gray-400">Pilih
                                                sumber dana...</option>
                                            @foreach ($funding_source as $funding)
                                                <option value="{{ $funding->id }}" class="text-gray-800">
                                                    {{ $funding->funding_source_name }} - {{ $funding->sub_category }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div
                                            class="flex items-start gap-2 p-3 bg-amber-50 rounded-lg border border-amber-200">
                                            <svg class="w-4 h-4 text-amber-600 mt-0.5 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-xs text-amber-800">
                                                Pastikan memilih sumber dana yang sesuai dengan jenis pengajuan
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Pilih Cabinet untuk Arsip --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                                <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200">
                                    <div class="p-2 bg-amber-100 rounded-lg">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg text-gray-800">Cabinet Arsip</h3>
                                        <p class="text-xs text-gray-500 mt-0.5">Pilih lokasi penyimpanan arsip digital
                                        </p>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <select name="cabinet_id" required
                                        class="w-full border-2 border-gray-300 rounded-lg p-3 text-gray-800 font-medium
            focus:ring-2 focus:ring-amber-400 focus:border-amber-500 focus:outline-none
            transition-all duration-200 bg-white shadow-sm hover:border-amber-300
            appearance-none cursor-pointer"
                                        style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e');
                    background-repeat: no-repeat;
                    background-position: right 1rem center;
                    background-size: 1.5em 1.5em;
                    padding-right: 3rem;">
                                        <option value="" selected disabled class="text-gray-400">Pilih Cabinet
                                            untuk Simpan sebagai Arsip</option>
                                        @foreach ($cabinets as $cabinet)
                                            <option value="{{ $cabinet->id }}" class="text-gray-800">
                                                {{ $cabinet->cabinet_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div
                                        class="flex items-start gap-2 p-3 bg-amber-50 rounded-lg border border-amber-200">
                                        <svg class="w-4 h-4 text-amber-600 mt-0.5 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div class="text-xs text-amber-800">
                                            <p class="font-semibold mb-1">Informasi Cabinet:</p>
                                            <ul class="list-disc list-inside space-y-0.5 ml-1">
                                                <li>Pilih cabinet sesuai dengan kategori atau divisi pengajuan</li>
                                                <li>Dokumen yang diarsipkan akan tersimpan di cabinet yang dipilih</li>
                                                <li>Pastikan memilih cabinet yang tepat untuk memudahkan pencarian</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full sm:w-auto px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold
                rounded-lg shadow-md hover:shadow-lg transition duration-200 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Upload Pengajuan dan Verifikasi Final
                            </button>
                        @else
                            <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 text-center">
                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <p class="text-sm text-gray-600 italic">
                                    File pengajuan sudah lengkap & diarsipkan. Tidak dapat diperbarui lagi.
                                </p>
                            </div>
                        @endif

                    </form>
                </div>

                {{-- SECTION 4: TOMBOL KEMBALI --}}
                <div class="pt-2">
                    <a href="{{ route('bendahara.dashboard') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
