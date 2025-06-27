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
                        {{-- <form method="GET" action="{{ route('report.index') }}" class="inline-block">
                            <select name="period_type" onchange="this.form.submit()" class="border rounded px-2 py-1">
                                <option value="harian" {{ $periodType == 'harian' ? 'selected' : '' }}>Harian</option>
                                <option value="bulanan" {{ $periodType == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                <option value="tahunan" {{ $periodType == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                            </select>
                        </form> --}}
                        <div class="gap-x-4">
                            {{-- <a href="{{ route('report.export', ['period_type' => $periodType]) }}">
                                <button
                                    class="w-[150px] bg-[#2264E5] hover:bg-lime-500 text-white shadow-md font-bold py-2 px-4 rounded mr-[50px]">
                                    Export
                                </button>
                            </a> --}}
                            <a href="/report-export">       
                                <x-primary-button class="w-[150px]">
                                    {{ __('Ekspor Laporan') }}
                                </x-primary-button>
                            </a>
                        </div>

                    </div>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Periode Laporan</th>
                                <th class="px-4 py-2">Tipe Laporan</th>
                                <th class="px-4 py-2">Total CH4</th>
                                <th class="px-4 py-2">Total CO2</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($reports as $report)
                                <tr>
                                    {{-- <td class=" px-4 py-2">{{ $report->report_name }}</td> --}}
                                    <td class="px-4 py-2">{{$report->period_date}}</td>
                                    @if ($report->period_type == 'harian')
                                        <td class="px-4 py-2"><span class="py-2 px-4 bg-fuchsia-700 text-white rounded-full">Harian</span></td>
                                    @elseif ($report->period_type == 'bulanan')
                                        <td class="px-4 py-2"><span class="py-2 px-4 bg-blue-700 text-white rounded-full">Bulanan</span></td>
                                    @elseif ($report->period_type == 'tahunan')
                                        <td class="px-4 py-2"><span class="py-2 px-4 bg-cyan-700 text-white rounded-full">Tahunan</span></td>
                                    @endif
                                    <td class=" px-4 py-2">{{ $report->total_ch4 }}</td>
                                    <td class=" px-4 py-2">{{ $report->total_co2 }}</td>
                                    <td class=" px-4 py-2">
                                        <a href="/report/{{ $report->id }}">
                                            <x-primary-button>View</x-primary-button></a>
                                        
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