<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unit Teknisi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">

                        <h1 class=" font-bold">Daftar Teknisi</h1>
                        <a href="/data-teknisi/add">
                            <x-primary-button>+ Tambah</x-primary-button>
                        </a>
                    </div>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Username</th>
                                <th class="px-4 py-2">Nama Teknisi</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                                <tr class="hover:bg-gray-100 text-center">
                                    <td class="border px-4 py-2">{{ $u->username }}</td>
                                    <td class="border px-4 py-2">{{ $u->name }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="/data-teknisi/edit/{{ $u->id }}">
                                            <x-primary-button>Edit</x-primary-button>
                                        </a>
                                        {{-- <form action="/teknisi/delete/{{ $u->id }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit">Hapus</x-danger-button> --}}
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>