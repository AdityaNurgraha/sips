@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex flex-col md:flex-row justify-between md:items-center gap-3 mb-4">
        <h2 class="text-xl font-bold">Kelola User</h2>

        <a href="{{ route('admin.users.create') }}"
           class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition w-full md:w-auto text-center">
            + Tambah User
        </a>
    </div>

    {{-- Container agar responsif dengan scroll di layar kecil --}}
    <div class="overflow-x-auto">
        <table class="w-full border min-w-[650px]">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border text-sm md:text-base">#</th>
                    <th class="p-2 border text-sm md:text-base">Nama</th>
                    <th class="p-2 border text-sm md:text-base">Email</th>
                    <th class="p-2 border text-sm md:text-base">Role</th>
                    <th class="p-2 border text-sm md:text-base">NUPTK</th>
                    <th class="p-2 border text-sm md:text-base">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td class="p-2 border text-sm md:text-base">{{ $index + 1 }}</td>
                        <td class="p-2 border text-sm md:text-base">{{ $user->name }}</td>
                        <td class="p-2 border text-sm md:text-base">{{ $user->email }}</td>
                        <td class="p-2 border capitalize text-sm md:text-base">{{ $user->role }}</td>
                        <td class="p-2 border text-sm md:text-base">
                            {{ $user->role == 'guru' ? ($user->nuptk ?? '-') : '-' }}
                        </td>
                        <td class="p-2 border space-y-1 md:space-y-0 md:space-x-1 flex flex-col md:flex-row">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-center">
                                Edit
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 w-full md:w-auto">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-2 text-center text-gray-500">Belum ada user</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
