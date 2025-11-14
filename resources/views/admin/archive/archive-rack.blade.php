<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Daftar Rak Arsip') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-xl p-6 border border-gray-200">
                {{-- Tombol Tambah --}}
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">Kelola Rak Arsip</h3>
                    <a href="{{ route('rak.create') }}"
                        class="inline-flex items-center gap-2 bg-green-500 text-white font-medium px-4 py-2 rounded-lg hover:bg-green-600 transition">
                        <img src="https://img.icons8.com/?size=24&id=48427&format=png&color=ffffff" alt="plus">
                        Tambah Rak Arsip
                    </a>
                </div>

                {{-- Daftar Rak --}}
                @php $no = 1; @endphp

                @if ($raks->count() > 0)
                    <div class="divide-y divide-gray-200 rounded-lg border border-gray-100">
                        @foreach ($raks as $rak)
                            <div
                                class="flex items-center justify-between p-4 hover:bg-gray-50 transition duration-150 ease-in-out group rounded-md">

                                {{-- Bagian Klik Utama --}}
                                <a href="{{ route('rak.show', $rak->id) }}"
                                    class="flex items-center gap-4 flex-1 group-hover:text-indigo-600">
                                    <div
                                        class="w-8 h-8 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-semibold">
                                        {{ $no++ }}
                                    </div>
                                    <div>
                                        <p class="text-gray-800 font-medium">{{ $rak->rack_name }}</p>
                                        <p class="text-sm text-gray-500">Kode Rak: {{ $rak->kode_rack ?? '-' }}</p>
                                    </div>
                                </a>

                                {{-- Tombol Aksi --}}
                                <div class="flex items-center gap-2 ml-4">
                                    <a href="{{ route('rak.edit', $rak->id) }}"
                                        class="flex items-center justify-center bg-blue-500 hover:bg-blue-600 rounded-md p-2 transition"
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
                    <div class="text-center py-10 text-gray-500">
                        <img src="https://img.icons8.com/?size=96&id=102550&format=png&color=9ca3af"
                            class="mx-auto mb-3 opacity-70" alt="no data">
                        <p>Tidak ada rak arsip yang tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
