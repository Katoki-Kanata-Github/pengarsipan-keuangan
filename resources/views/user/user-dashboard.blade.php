<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- ================= HERO SECTION ================= --}}
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-xl p-8 shadow-lg">
                <h1 class="text-3xl font-bold mb-1">
                    Halo, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-sm opacity-90">
                    Selamat datang di Sistem Pengajuan Keuangan. Ayo kelola pengajuanmu dengan mudah.
                </p>
            </div>

            {{-- ================= STATISTIC GRID ================= --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Belum Lengkap --}}
                <div class="p-6 bg-white border rounded-xl shadow hover:shadow-md transition flex items-center gap-4">
                    <div class="p-4 bg-yellow-100 text-yellow-600 rounded-full">
                        ⚠️
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">File Belum Lengkap</p>
                        <p class="text-2xl font-bold">5</p> {{-- angka dummy --}}
                    </div>
                </div>

                {{-- Belum Diverifikasi --}}
                <div class="p-6 bg-white border rounded-xl shadow hover:shadow-md transition flex items-center gap-4">
                    <div class="p-4 bg-red-100 text-red-600 rounded-full">
                        ❗
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Belum Diverifikasi</p>
                        <p class="text-2xl font-bold">3</p> {{-- angka dummy --}}
                    </div>
                </div>

            </div>

            {{-- ================= AJAK PENGAJUAN ================= --}}
            <div class="bg-white border rounded-xl p-8 shadow">
                <h2 class="text-xl font-bold text-gray-800 mb-3">
                    Ingin melakukan pengajuan keuangan?
                </h2>
                <p class="text-gray-600 mb-6">
                    Ajukan kebutuhan keuanganmu dengan cepat dan mudah melalui sistem kami.
                </p>

                <a href="{{ route('pengajuan.index') }}"
                    class="inline-block px-6 py-3 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition">
                    Buat Pengajuan Baru
                </a>
            </div>

        </div>
    </div>

</x-app-layout>
