<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Input Arsip') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-xl p-8 border border-gray-200">
                <form action="{{ route('subcategory.store', $category->id) }}" method="POST" class="space-y-6">
                    @csrf

                    <input type="text" name="category_id" value="{{ $category->id }}" class="hidden">

                    {{-- Nama Sub Category --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Sub Kategori
                        </label>
                        <input type="text" name="name" id="name"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                            placeholder="Masukkan nama rak arsip" required>
                    </div>

                    {{-- Jenis Kategori --}}
                    <div class="group">
                        <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                            <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Jenis Kategori
                        </label>

                        {{-- Info Box --}}
                        <div class="mb-3 bg-amber-50 border border-amber-200 rounded-lg p-3">
                            <p class="text-xs text-amber-800">
                                <strong>Pilih salah satu</strong> jenis kategori atau <strong>kosongkan
                                    keduanya</strong> jika akan membuat sub-kategori. Kode arsip akan dibuat di
                                sub-kategori nanti.
                            </p>
                        </div>

                        {{-- Selection Grid --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            {{-- Payment Method Card --}}
                            <div
                                class="bg-white border border-gray-200 rounded-lg p-3 hover:border-blue-400 transition-colors">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                        <path fill-rule="evenodd"
                                            d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <h4 class="font-semibold text-gray-800 text-sm">Metode Pembayaran</h4>
                                </div>

                                <select name="payment_method"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white">
                                    <option value="">-- Kosongkan jika tidak dipilih --</option>
                                    @foreach ($payment as $pay)
                                        <option value="{{ $pay->id }}">
                                            {{ $pay->payment_method_name }}{{ $pay->sub_category ? ' → ' . $pay->sub_category : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Funding Source Card --}}
                            <div
                                class="bg-white border border-gray-200 rounded-lg p-3 hover:border-purple-400 transition-colors">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <h4 class="font-semibold text-gray-800 text-sm">Sumber Dana</h4>
                                </div>

                                <select name="funding_source"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all bg-white">
                                    <option value="">-- Kosongkan jika tidak dipilih --</option>
                                    @foreach ($funding as $fun)
                                        <option value="{{ $fun->id }}">
                                            {{ $fun->funding_source_name }}{{ $fun->sub_category ? ' → ' . $fun->sub_category : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>


                    {{-- Tombol Aksi --}}
                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('category.show', $category->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                            ← Kembali
                        </a>

                        <button type="submit"
                            class="inline-flex items-center px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">
                            + Buat Sub Kategori
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
