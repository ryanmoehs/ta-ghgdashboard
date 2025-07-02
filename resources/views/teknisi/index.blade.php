@section('title', config('app.name', 'EMisi') . ' - Daftar Teknisi')
<x-app-layout>
    <x-slot name="header">
        <span class="font-light text-slate-400 text-sm">Home / Unit Teknisi</span>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unit Teknisi') }}
        </h2>
        <span class="text-sm text-slate-500">Data Unit Teknisi</span>
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
                                    <td class=" px-4 py-2">{{ $u->username }}</td>
                                    <td class=" px-4 py-2">{{ $u->name }}</td>
                                    <td class=" px-4 py-2">
                                        <a href="/data-teknisi/edit/{{ $u->id }}">
                                            <x-primary-button>Edit</x-primary-button>
                                        </a>
                                        <x-danger-button type="button"
                                            onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'confirm-teknisi-deletion-{{ $u->id }}' }))">
                                            Hapus
                                        </x-danger-button>
                                        <x-modal id="modalDel{{ $u->id }}" name="confirm-teknisi-deletion-{{ $u->id }}">
                                            <form method="POST" action="{{ route('teknisi.destroy', $u->id) }}" class="p-6">
                                                @csrf
                                                @method('delete')
                                                <h2 class="text-sm text-gray-600">
                                                    {{ __('Yakin menghapus data ini?') }}
                                                </h2>
                                                <p class="mt-1 text-lg font-medium text-black">
                                                    {{ __($u->name) }}
                                                </p>
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Batal') }}
                                                    </x-secondary-button>
                                                    <x-danger-button class="ms-3">
                                                        {{ __('Hapus Data') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
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