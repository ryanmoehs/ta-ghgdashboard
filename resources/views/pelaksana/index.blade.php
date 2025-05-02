<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unit Pelaksana') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class=" font-bold">Daftar Unit Pelaksana</h1>
                    <a href="/pelaksana/add">
                        <button
                            class="w-[225px] bg-[#2264E5] hover:bg-lime-500 text-white shadow-md font-bold py-2 px-4 rounded mr-[50px]">
                            Tambah Unit Pelaksana
                        </button>
                    </a>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Username</th>
                                <th class="px-4 py-2">Nama Pelaksana</th>
                                <th class="px-4 py-2">Induk Perusahaan</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($reports as $report)
                                <tr>
                                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2">{{ $report->unit_name }}</td>
                                    <td class="border px-4 py-2">{{ $report->count }}</td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>