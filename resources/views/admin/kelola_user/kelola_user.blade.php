<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Kelola User
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-lg sm:rounded-xl p-8">

                {{-- HEADER --}}
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-semibold text-gray-700">
                        Daftar User Terdaftar
                    </h3>

                    <a href="{{ route('account.create') }}"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow">
                        + Register User Baru
                    </a>
                </div>

                {{-- TABLE USER --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full border rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">No</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Nama</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Email</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Role</th>
                                <th class="px-4 py-3 text-center text-gray-700 font-semibold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no = 1; @endphp

                            @foreach ($users as $user)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">{{ $no++ }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                                    <td class="px-4 py-3">{{ $user->email }}</td>
                                    <td class="px-4 py-3 capitalize">
                                        <span
                                            class="
        px-3 py-1 rounded-full text-sm
        {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}
    ">
                                            {{ $user->role }}
                                        </span>
                                    </td>


                                    <td class="px-4 py-3">
                                        <div class="flex justify-center gap-3">

                                            {{-- EDIT BUTTON --}}
                                            <a href="{{ route('account.edit', $user->id) }}"
                                                class="p-2 bg-yellow-500 hover:bg-yellow-600 rounded-lg shadow text-white">
                                                <img src="https://img.icons8.com/?size=24&id=88584&format=png&color=ffffff"
                                                    alt="edit">
                                            </a>

                                            {{-- DELETE BUTTON --}}
                                            <form action="{{ route('account.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="p-2 bg-red-600 hover:bg-red-700 rounded-lg shadow text-white">
                                                    <img src="https://img.icons8.com/?size=24&id=43949&format=png&color=ffffff"
                                                        alt="delete">
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($users->count() === 0)
                        <p class="text-center text-gray-500 italic mt-6">Belum ada user yang terdaftar.</p>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
