<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Maintenance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <h1 class=" font-bold">Laporan Bulanan</h1>
                        <div class="gap-x-4">
                            <a href="{{ route('report.export') }}">
                                <button
                                    class="w-[150px] bg-[#2264E5] hover:bg-lime-500 text-white shadow-md font-bold py-2 px-4 rounded mr-[50px]">
                                    Export
                                </button>
                            </a>
                            <a href="/report/create">
                                <button
                                    class="w-[150px] bg-[#2264E5] hover:bg-lime-500 text-white shadow-md font-bold py-2 px-4 rounded mr-[50px]">
                                    Buat
                                </button>
                            </a>
                        </div>

                    </div>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Tanggal Laporan</th>
                                <th class="px-4 py-2">Nama Alat</th>
                                <th class="px-4 py-2">Jenis</th>
                                <th class="px-4 py-2">Status Maintenance</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($maintenance_sensor as $ms)
                                <tr>
                                    <td class=" px-4 py-2">{{ $ms->waktu_mulai }}</td>
                                    <td class=" px-4 py-2">{{ $ms->nama_alat }}</td>
                                    <td class=" px-4 py-2">{{ $ms->jenis_alat }}</td>
                                    @if($ms->status == 'draft')
                                    <td class="px-4 py-2"><span class="py-2 px-4 bg-slate-400 rounded-full">Draft</span></td>
                                    @elseif($ms->status == 'diteruskan')
                                    <td class="px-4 py-2"><span class="py-2 px-4 bg-blue-400 rounded-full">Diteruskan</span></td>
                                    @elseif($ms->status == 'diterima')
                                        <td class="px-4 py-2"><span class="py-2 px-4 bg-green-400 rounded-full">Diterima</span></td>
                                    @elseif($ms->status == 'dikembalikan')
                                        <td class="px-4 py-2"><span class="py-2 px-4 bg-red-400 rounded-full">Dikembalikan</span></td>
                                    @endif
                                    <td class=" px-4 py-2">
                                        <a href="/ms/{{ $ms->id }}" class="px-4 py-2 rounded-full bg-blue-400 text-white">View</a>
                                        <a href="/ms/{{ $ms->id }}" class="px-4 py-2 rounded-full bg-green-400 text-white">ACC</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>