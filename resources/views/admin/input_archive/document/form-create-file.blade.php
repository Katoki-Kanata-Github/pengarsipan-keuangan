<x-app-layout>
    {{-- HEADER --}}
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Input Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('archive.list', $folders->id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-md shadow-2xl rounded-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-3xl">
                {{-- CARD HEADER --}}
                <div class="relative bg-gradient-to-b from-[#003A8F] to-[#002766] px-4 py-4">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="relative flex items-start gap-4">
                        <div class="p-2 bg-white/20 backdrop-blur-md rounded-lg shadow-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white">Form Input Arsip Baru</h3>
                            <p class="text-sm text-white">Lengkapi data arsip berikut dengan benar.</p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-6">
                    @csrf
                    <input type="hidden" name="folders_id" value="{{ $folders->id }}">

                    {{-- Nama File --}}
                    <div class="group">
                        <label class="flex items-center gap-2 text-sm font-bold text-gray-800 mb-3">
                            Nama File Arsip <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">
                            <input type="text" name="name" required
                                placeholder="Contoh: Dokumen Pajak 2024"
                                class="w-full rounded-xl border-2 border-gray-200 px-5 py-2 text-gray-700 font-medium placeholder:text-gray-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </div>
                        </div>

                        <p class="text-xs text-gray-500 mt-2 ml-1 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Gunakan nama yang jelas agar mudah dicari
                        </p>
                    </div>

                    {{-- Upload PDF --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Upload File PDF Arsip
                        </label>
                        <input type="file" name="file_archive"
                            class="w-full block rounded-lg border border-gray-300 bg-gray-50 file:bg-indigo-600 file:text-white file:border-none file:py-2 file:px-4 file:rounded-lg file:cursor-pointer hover:file:bg-indigo-700 transition"
                            accept="application/pdf">
                        <p class="text-xs text-gray-500 mt-1">Format: PDF • Maksimal 20MB</p>
                    </div>

                    {{-- Keterangan --}}
                    <div>
                        <label class="flex items-center gap-2 text-sm font-bold text-gray-800 mb-3">
                            Keterangan / Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="keterangan" rows="3" required placeholder="Contoh: Arsip laporan keuangan"
                            class="w-full rounded-xl border-2 border-gray-200 px-3 py-2 text-gray-700 font-medium resize-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition"></textarea>
                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                        <p class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Semua field wajib diisi
                        </p>

                        <div class="flex gap-3 w-full sm:w-auto">
                            <button type="submit"
                                    class="flex-1 px-8 py-2.5 rounded-lg text-white font-semibold bg-gradient-to-r from-green-600 to-emerald-600 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition">
                                Simpan
                            </button>

                            <a href="{{ route('archive.list', $folders->id) }}"
                                class="flex-1 px-5 py-2.5 rounded-lg font-semibold text-gray-700 bg-gray-300 hover:bg-gray-400 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition text-center">
                                Batal
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
