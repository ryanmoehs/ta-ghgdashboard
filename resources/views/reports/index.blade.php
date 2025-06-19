<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="font-bold">Laporan</h1>
                        <form method="GET" action="{{ route('report.index') }}" class="inline-block">
                            <select name="period_type" onchange="this.form.submit()" class="border rounded px-2 py-1">
                                <option value="harian" {{ $periodType == 'harian' ? 'selected' : '' }}>Harian</option>
                                <option value="bulanan" {{ $periodType == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                <option value="tahunan" {{ $periodType == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                            </select>
                        </form>
                        <div class="gap-x-4">
                            <a href="{{ route('report.export', ['period_type' => $periodType]) }}">
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
                                <th class="px-4 py-2">Total CH4</th>
                                <th class="px-4 py-2">Total CO2</th>
                                <th class="px-4 py-2">Status Laporan</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($reports as $report)
                                <tr>
                                    <td class=" px-4 py-2">{{ $report->updated_at }}</td>
                                    <td class=" px-4 py-2">{{ $report->total_ch4 }}</td>
                                    <td class=" px-4 py-2">{{ $report->total_co2 }}</td>
                                    @if($report->status == 'draft')
                                    <td class="px-4 py-2"><span class="py-2 px-4 bg-slate-400 rounded-full">Draft</span></td>
                                    @elseif($report->status == 'diteruskan')
                                    <td class="px-4 py-2"><span class="py-2 px-4 bg-blue-400 rounded-full">Diteruskan</span></td>
                                    @elseif($report->status == 'diterima')
                                        <td class="px-4 py-2"><span class="py-2 px-4 bg-green-400 rounded-full">Diterima</span></td>
                                    @elseif($report->status == 'dikembalikan')
                                        <td class="px-4 py-2"><span class="py-2 px-4 bg-red-400 rounded-full">Dikembalikan</span></td>
                                    @endif
                                    <td class=" px-4 py-2">
                                        <a href="/report/{{ $report->id }}" class="px-4 py-2 rounded-full bg-blue-400 text-white">View</a>
                                        <a href="/report/{{ $report->id }}" class="px-4 py-2 rounded-full bg-green-400 text-white">ACC</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class=" font-bold">Laporan Tahunan</h1>
                        <table class="table-auto w-full mt-4">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">No</th>
                                    <th class="px-4 py-2">Nama Unit</th>
                                    <th class="px-4 py-2">Jumlah Laporan</th>
                                    <th class="px-4 py-2">Status Laporan</th>
                                    <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            {{-- @if ($report) --}}
                            @foreach ($reports as $report)
                            <tr>
                                <td class=" px-4 py-2">{{ $report->updated_at }}</td>
                                <td class=" px-4 py-2">{{ $report->total_ch4 }}</td>
                                <td class=" px-4 py-2">{{ $report->total_co2 }}</td>
                                @if($report->status == 'draft')
                                <td class="px-4 py-2"><span class="py-2 px-4 bg-slate-400 rounded-full">Draft</span></td>
                                @elseif($report->status == 'diteruskan')
                                <td class="px-4 py-2"><span class="py-2 px-4 bg-blue-400 rounded-full">Diteruskan</span></td>
                                @elseif($report->status == 'diterima')
                                    <td class="px-4 py-2"><span class="py-2 px-4 bg-green-400 rounded-full">Diterima</span></td>
                                    @elseif($report->status == 'dikembalikan')
                                    <td class="px-4 py-2"><span class="py-2 px-4 bg-red-400 rounded-full">Dikembalikan</span></td>
                                @endif
                                <td class=" px-4 py-2">
                                    <a href="/report/{{ $report->id }}" class="px-4 py-2 rounded-full bg-blue-400 text-white">View</a>
                                    <a href="/report/{{ $report->id }}" class="px-4 py-2 rounded-full bg-green-400 text-white">ACC</a>
                                </td>
                            </tr>
                            @endforeach
                            {{-- @else
                                <td class="px-4 py-2"><span class="py-2 px-4 bg-green-400 rounded-full">Belum ada Data</span></td>

                            @endif --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>