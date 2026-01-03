<x-app-layout>
    {{-- HEADER PAGE --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 tracking-tight">
            {{ __('Input Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('category.show', $category->id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="py-6 bg-gradient-to-br from-slate-50 to-indigo-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARD UTAMA --}}
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">

                {{-- HEADER CARD (MENYATU & BERWARNA) --}}
                <div class="relative px-6 py-5 bg-gradient-to-b from-[#003A8F] to-[#002766]">
                    <div class="absolute inset-0 bg-black/10"></div>

                    <div class="relative flex items-center gap-4">
                        <div class="w-11 h-11 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white">
                                Tambah Sub Kategori
                            </h3>
                            <p class="text-sm text-indigo-200">
                                Lengkapi data sub kategori arsip
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <div class="p-6 sm:p-10">
                    <form action="{{ route('subcategory.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $category->id }}">

                        {{-- NAMA SUB KATEGORI --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Nama Sub Kategori
                            </label>
                            <input type="text" name="name"
                                class="w-full rounded-xl border-2 border-gray-200 focus:border-indigo-600
                                focus:ring-4 focus:ring-indigo-100 px-4 py-2 transition"
                                placeholder="Contoh: Surat Masuk" required>
                            <p class="mt-1 text-xs text-gray-500">
                                Gunakan nama yang mudah dipahami
                            </p>
                        </div>

                        {{-- KODE SUB KATEGORI --}}
                        <div>
                            <label for="kode" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                                Kode Sub Kategori
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-mono">#</span>
                                <input type="text" name="kode"
                                    class="w-full rounded-xl border-2 border-gray-200 focus:border-indigo-600
                                    focus:ring-4 focus:ring-indigo-100 pl-10 pr-4 py-2 transition font-mono"
                                    placeholder="SM-001" required>
                            </div>
                        </div>

                        {{-- KETERANGAN --}}
                        <div>
                            <label for="Keterangan" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Keterangan
                            </label>
                            <textarea name="Keterangan" rows="3"
                                class="w-full rounded-xl border-2 border-gray-200 focus:border-blue-600
                                focus:ring-4 focus:ring-blue-100 px-4 py-3 transition resize-none"
                                placeholder="Deskripsi singkat sub kategori..." required></textarea>
                        </div>

                        {{-- AKSI --}}
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4">
                            <span class="text-sm text-gray-500">
                                Semua field wajib diisi
                            </span>

                            <div class="flex gap-3 w-full sm:w-auto">
                                <button type="submit"
                                    class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-2.5
                                    bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold
                                    rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Simpan
                                </button>

                                <a href="{{ route('category.show', $category->id) }}"
                                    class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-2.5
                                    bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-xl
                                    shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
