<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Daftar Rak Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('rack.show', $folder->id) }}"
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
            <div class="relative overflow-hidden bg-white rounded-3xl shadow-xl p-8 mb-8 border border-gray-100">
                
                <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-b from-[#003A8F] to-[#002766] rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">
                                Kelola File Arsip
                            </h3>
                            <p class="text-sm font-semibold text-gray-500">Total Arsip : {{ $archives->count() }}</p>
                        </div>
                    </div>

                    <a href="{{ route('file.create_with_folder', $folder->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700
                                text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <img src="https://img.icons8.com/?size=24&id=48427&format=png&color=ffffff" alt="plus">
                        Tambah File Arsip
                    </a>
                </div>

                {{-- Daftar Rak --}}
                @php $no = 1; @endphp

                @if ($archives->count() > 0)
                    <div class="mt-10 space-y-4 rounded-lg">
                        @foreach ($archives as $archive)
                        <div class="flex items-center justify-between p-4 bg-white border border-gray-400 rounded-lg
                                    shadow-sm hover:shadow-md hover:bg-gray-300 transition-all duration-200 group">

                                {{-- Bagian Klik Utama --}}
                                <a href="{{ route('file.show', $archive->id) }}"
                                    class="flex items-center gap-4 flex-1 group-hover:text-indigo-600">
                                    <div
                                        class="w-8 h-8 flex items-center justify-center rounded-full bg-gradient-to-b from-[#003A8F] to-[#002766] text-white font-semibold">
                                        {{ $no++ }}
                                    </div>
                                    <div>
                                        <p class="text-gray-800 font-medium">{{ $archive->file_name }}</p>
                                        @if ($archive->file_path == null)
                                            <p class="text-sm text-red-500 font-semibold">Belum ada archive</p>
                                        @else
                                            <p class="text-sm text-green-600 font-semibold">archive tersedia</p>
                                        @endif
                                    </div>
                                </a>

                                {{-- Tombol Aksi --}}
                                <div class="flex items-center gap-2 ml-4">
                                    <a href="{{ route('file.edit', $archive->id) }}"
                                        class="flex items-center justify-center bg-amber-500 hover:bg-orange-600 rounded-md p-2 transition"
                                        title="Edit">
                                        <img src="https://img.icons8.com/?size=24&id=88584&format=png&color=ffffff"
                                            alt="edit">
                                    </a>

                                    <form action="{{ route('file.destroy', $archive->id) }}" method="POST"
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-xl font-semibold text-gray-700 mb-3">Belum Ada File Arsip</p>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">Tidak ada file arsip yang tersedia. Silakan tambahkan file pertama untuk mulai mengelola dokumen Anda.</p>
                    </div>
                @endif
            </div>

            
        </div>
    </div>
</x-app-layout>
