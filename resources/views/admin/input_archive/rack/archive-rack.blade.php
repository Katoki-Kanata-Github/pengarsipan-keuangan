<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Rak Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('category.show', $year->category_id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    <div class="py-4 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Card --}}
            <div class="relative overflow-hidden bg-white rounded-xl shadow-xl p-8 mb-8 border border-gray-100">
        
                <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-b from-[#003A8F] to-[#002766] rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Kelola Rak Arsip
                            </h3>
                            <p class="text-sm font-semibold text-gray-500">Total Rak : {{ $racks->count() }} Item</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        {{-- Tombol Tambah Rak --}}
                        <a href="{{ route('rack.create_with_year', $year->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2
                                   bg-gradient-to-r from-emerald-500 to-teal-600
                                   hover:from-emerald-600 hover:to-teal-700
                                   text-white font-medium rounded-lg
                                   shadow-lg hover:shadow-xl
                                   transform hover:-translate-y-0.5
                                   transition-all duration-200">
                            <img src="https://img.icons8.com/?size=24&id=48427&format=png&color=ffffff"
                                class="w-5" />
                            Tambah Rak Arsip
                        </a>
                    </div>
                </div>

                {{-- Daftar Rak --}}
                @php $no = 1; @endphp

                @if ($racks->count() > 0)
                    <div class="mt-10 space-y-4 rounded-lg">
                        @foreach ($racks as $rak)
                        <div class="flex items-center justify-between p-4 bg-white border border-gray-400 rounded-lg
                                    shadow-sm hover:shadow-md hover:bg-gray-300 transition-all duration-200 group">

                                {{-- Bagian Klik Utama --}}
                                <a href="{{ route('rak.show', $rak->id) }}"
                                    class="flex items-center gap-4 flex-1 group-hover:text-indigo-600">
                                    <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gradient-to-b from-[#003A8F] to-[#002766] text-white font-semibold">
                                        {{ $no++ }}
                                    </div>

                                    <div class="w-12 h-12 flex items-center justify-center bg-white rounded-lg border-2 border-cyan-400 group-hover:border-cyan-400 group-hover:scale-110 transition-all duration-300 shadow-md">
                                        <svg class="w-7 h-7 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                    </div>

                                    <div class="space-y-1">
                                        {{-- Nama Rak --}}
                                        <p class="text-gray-900 font-semibold text-base leading-tight">
                                            {{ $rak->rack_name }}
                                        </p>

                                        {{-- Informasi Detail --}}
                                        <div class="flex items-center gap-4 text-sm text-gray-600">

                                            {{-- Kode Rak --}}
                                            <span class="flex items-center gap-1 bg-gray-100 px-2 py-0.5 rounded-lg">
                                                <img src="https://img.icons8.com/?size=16&id=7880&format=png&color=4b5563"
                                                    class="w-4 opacity-70">
                                                {{ $rak->kode_rack ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </a>

                                {{-- Tombol Aksi --}}
                                <div class="flex items-center gap-2 ml-4">
                                    <a href="{{ route('rak.edit', $rak->id) }}"
                                        class="flex items-center justify-center bg-amber-500 hover:bg-orange-600 rounded-md p-2 transition"
                                        title="Edit">
                                        <img src="https://img.icons8.com/?size=24&id=88584&format=png&color=ffffff"
                                            alt="edit">
                                    </a>

                                    <form action="{{ route('rak.destroy', $rak->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus rak ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center justify-center bg-red-500 hover:bg-red-600 rounded-md p-2 transition"
                                            title="Hapus">
                                            <img src="https://img.icons8.com/?size=24&id=43949&format=png&color=ffffff"
                                                alt="delete">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                {{-- Empty State --}}
                <div class="mt-10 text-center bg-white rounded-2xl shadow-md border border-gray-200 py-24">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full mb-6 shadow-inner">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <p class="text-xl font-semibold text-gray-700 mb-3">Belum Ada Rak Arsip</p>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">Tidak ada rak arsip yang tersedia. Silakan tambahkan rak pertama untuk mulai menyimpan dokumen Anda.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>