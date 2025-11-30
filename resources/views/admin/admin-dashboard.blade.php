<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- WELCOME CARD --}}
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-10 rounded-2xl shadow-lg mb-8">
                <h1 class="text-3xl font-bold mb-3">Selamat Datang di Dashboard Arsip!</h1>
                <p class="text-lg opacity-90">
                    Kelola dokumen, pantau statistik, dan akses fitur dengan lebih mudah.
                </p>
            </div>

            {{-- STATISTICS CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                {{-- Dokumen Ada --}}
                <div class="p-6 bg-white shadow-md rounded-xl border-l-4 border-green-500">
                    <p class="text-sm text-gray-500">Dokumen Tersimpan</p>
                    <h3 class="text-3xl font-bold text-gray-700 mt-2">
                        {{ 124 }} {{-- dummy --}}
                    </h3>
                </div>

                {{-- Dokumen Tidak Ada --}}
                <div class="p-6 bg-white shadow-md rounded-xl border-l-4 border-red-500">
                    <p class="text-sm text-gray-500">Dokumen Tidak Ditemukan</p>
                    <h3 class="text-3xl font-bold text-gray-700 mt-2">
                        {{ 8 }} {{-- dummy --}}
                    </h3>
                </div>

                {{-- Jumlah User --}}
                <div class="p-6 bg-white shadow-md rounded-xl border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500">Jumlah User</p>
                    <h3 class="text-3xl font-bold text-gray-700 mt-2">
                        {{ 5 }} {{-- dummy --}}
                    </h3>
                </div>

            </div>

            {{-- FILTER --}}
            <div class="bg-white p-6 rounded-xl shadow mb-8">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Filter Dokumen</h3>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <select class="border px-3 py-2 rounded-lg">
                        <option value="">Pilih Cabinet</option>
                    </select>

                    <select class="border px-3 py-2 rounded-lg">
                        <option value="">Pilih Category</option>
                    </select>

                    <select class="border px-3 py-2 rounded-lg">
                        <option value="">Pilih Subcategory</option>
                    </select>

                    <select class="border px-3 py-2 rounded-lg">
                        <option value="">Pilih Tahun</option>
                    </select>

                </div>
                @php
                    $no = 1;
                @endphp

                {{-- LIST DOKUMEN --}}
                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4">Daftar Dokumen</h3>

                    {{-- Dummy list sementara --}}
                    @php
                        $dummy = [
                            ['nama' => 'Laporan Tahunan 2023', 'status' => true, 'tahun' => '2023'],
                            ['nama' => 'Rekap Keuangan Q1', 'status' => false, 'tahun' => '2022'],
                            ['nama' => 'Dokumen Pajak', 'status' => true, 'tahun' => '2024'],
                        ];
                        $no = 1;
                    @endphp

                    <div class="space-y-4">
                        @foreach ($dummy as $doc)
                            <div
                                class="flex items-center justify-between bg-gray-50 border rounded-xl p-4 hover:bg-gray-100 transition shadow-sm">

                                {{-- Nomor --}}
                                <div class="w-10 text-center font-bold text-gray-700">
                                    {{ $no++ }}
                                </div>

                                {{-- Info Dokumen --}}
                                <div class="grid grid-cols-3 gap-6 flex-1 px-4">

                                    {{-- Nama --}}
                                    <div class="font-medium text-gray-800">
                                        {{ $doc['nama'] }}
                                    </div>

                                    {{-- Status --}}
                                    <div>
                                        @if ($doc['status'])
                                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                                Tersedia
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                                Tidak Ada
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Tahun --}}
                                    <div class="text-gray-700 font-medium">
                                        {{ $doc['tahun'] }}
                                    </div>
                                </div>

                                {{-- Aksi --}}
                                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium underline">
                                    Lihat Dokumen
                                </a>

                            </div>
                        @endforeach
                    </div>
                </div>

            </div>


        </div>
    </div>

</x-app-layout>
