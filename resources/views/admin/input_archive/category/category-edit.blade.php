<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('cabinet.show', $category->cabinet_id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    <div class="py-6 bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARD UTAMA --}}
            <div class="overflow-hidden rounded-3xl shadow-2xl border border-gray-100 bg-white">

                {{-- HEADER GRADIENT --}}
                <div class="relative px-8 py-7 bg-gradient-to-b from-[#003A8F] to-[#002766]">
                    <div class="flex items-center gap-5">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-9 h-9 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white">
                                Edit Kategori Arsip
                            </h3>
                            <p class="text-white/90 text-sm mt-1">
                                Perbarui data kategori arsip dengan benar
                            </p>
                        </div>
                    </div>

                    {{-- efek dekoratif --}}
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/3"></div>
                </div>

                {{-- BODY FORM --}}
                <div class="p-8 md:p-10">
                    <form action="{{ route('category.update', $category->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        {{-- Nama Kategori Arsip --}}
                        <div class="group">
                            <label for="name" class="flex items-center gap-2 text-base font-bold text-gray-700 mb-3">
                                <div class="w-6 h-6 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                Nama Kategori Arsip
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="name" id="name" value="{{ $category->category_name }}"
                                    class="w-full px-5 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 shadow-sm transition-all duration-300 placeholder-gray-400 text-gray-800 font-medium hover:border-gray-300"
                                    placeholder="Contoh: Dokumen Keuangan" required>
                                <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Masukkan nama kategori yang jelas dan deskriptif
                            </p>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="group">
                            <label for="deskripsi" class="flex items-center gap-2 text-base font-bold text-gray-700 mb-3">
                                <div class="w-6 h-6 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                    </svg>
                                </div>
                                Deskripsi
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <textarea name="deskripsi" id="deskripsi" rows="2" 
                                    class="w-full px-5 py-4 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 shadow-sm transition-all duration-300 placeholder-gray-400 text-gray-800 font-medium hover:border-gray-300 resize-none"
                                    placeholder="Jelaskan kategori arsip ini secara singkat..." required>{{ $category->deskripsi }}</textarea>
                                <div class="absolute top-4 right-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 group-focus-within:text-purple-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Berikan penjelasan singkat tentang jenis dokumen dalam kategori ini
                            </p>
                        </div>


                        {{-- URL Icon --}}
                        <div class="group">
                            <label for="url" class="flex items-center gap-2 text-base font-bold text-gray-700 mb-3">
                                <div class="w-6 h-6 bg-pink-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                URL Icon
                                <span class="text-red-500">*</span>
                            </label>

                            {{-- Instruksi Card --}}
                            <div class="mb-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-xl p-5 shadow-sm">
                                <div class="flex items-start gap-3 mb-3">
                                    <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg">
                                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-blue-900 mb-2">Panduan Memasukkan URL Icon dari Icons8</h5>
                                        <ol class="text-sm text-blue-800 space-y-2">
                                            <li class="flex items-start gap-2">
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full flex-shrink-0 mt-0.5">1</span>
                                                <div>
                                                    <span>Buka situs</span>
                                                    <a href="https://icons8.com" target="_blank" class="text-red-600 hover:text-red-700 font-bold underline ml-1">icons8.com</a>
                                                    <span> dan cari icon yang diinginkan</span>
                                                </div>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full flex-shrink-0 mt-0.5">2</span>
                                                <span>Klik icon tersebut hingga terbuka halaman detailnya, lalu pilih copy  <strong>link to png </strong>"jumlahnya hurufnya harus sama"</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full flex-shrink-0 mt-0.5">3</span>
                                                <span>Ganti warna icon menjadi <code class="bg-blue-100 px-2 py-1 rounded text-xs">color=000000</code> → <code class="bg-blue-100 px-2 py-1 rounded text-xs">
                                                    putih pada bagian “color=000000 menjadi color=ffffff”</code></span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full flex-shrink-0 mt-0.5">4</span>
                                                <span>Ganti ukuran (size) menjadi. <code class="bg-blue-100 px-2 py-1 rounded text-xs">contohnya size=100 </code></span>
                                            </li>
                                        </ol>
                                    </div>
                                </div>

                                {{-- Example URL --}}
                                <div class="mt-4 pt-4 border-t border-blue-200">
                                    <p class="text-sm font-bold text-blue-900 mb-2">Contoh URL yang benar:</p>
                                    <div class="bg-white p-3 rounded-lg border border-blue-200 shadow-sm">
                                        <code class="text-xs text-gray-700 break-all">https://img.icons8.com/?size=100&id=2HU1G5leSjOg&format=png&color=ffffff</code>
                                    </div>
                                </div>
                            </div>

                            {{-- Input URL --}}
                            <div class="relative">
                                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                </div>
                                <input type="text" name="url" id="url" value="{{ $category->url_icon }}"
                                    class="w-full pl-12 pr-5 py-4 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 shadow-sm transition-all duration-300 placeholder-gray-400 text-gray-800 font-medium hover:border-gray-300"
                                    placeholder="https://img.icons8.com/?size=100&id=xxxxx&format=png&color=ffffff" required>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Pastikan URL mengikuti format yang benar sesuai panduan di atas
                            </p>
                        </div>

                        {{-- Footer Actions --}}
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 pt-8 border-t-2 border-gray-100">
                            
                            {{-- Info Required Fields --}}
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium">Semua field wajib diisi</span>
                            </div>

                            {{-- Submit Button --}}
                            <div class="flex gap-3 w-full sm:w-auto">
                                <button type="submit"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    Update
                                </button>

                                <a href="{{ route('cabinet.show', $category->cabinet_id) }}"
                                    class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-200 to-gray-300 hover:from-gray-300 hover:to-gray-400 text-gray-700 font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
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