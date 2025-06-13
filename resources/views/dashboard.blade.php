<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <h2 class="font-medium text-gray-800 leading-tight">
            Selamat Datang {{auth()->user()->name}} !
        </h2>
    </x-slot>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-12">
        <div class="grid grid-cols-3 gap-2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <select name="" id="" class="rounded-lg">
                        {{-- <option value="sensor_1">Sensor 1</option> --}}
                        <option value="sensor_1">Sensor 1</option>
                        <option value="sensor_2">Sensor 2</option>
                        <option value="sensor_3">Sensor 3</option>
                        <option value="sensor_4">Sensor 4</option>
                    </select>
                    <div class="p-4 mt-2 flex flex-col align-center items-center justify-center text-white">
                        <img src="{{ asset('images/map2.png') }}" alt="icon sensor" class="w-20">
                        <h2 class="font-semibold text-lg">Sensor 1</h2>
                        <span class="font-medium text-lg">Aman</span>
                    </div>
                </div>
            </div>
            <div class="col-span-2 bg-white flex justify-around content-center items-center overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div class="p-6 text-gray-900 ">  --}}
                    {{-- <div class="flex flex-col p-2 text-white">
                        <img src="{{ asset('images/map2.png') }}" alt="icon sensor" class="w-20">
                        <h2 class="font-semibold text-lg">CO2</h2>
                    </div>
                    <div class="flex flex-col p-2 text-white">
                        <img src="{{ asset('images/map2.png') }}" alt="icon sensor" class="w-20">
                        <h2 class="font-semibold text-lg">CH4</h2>
                    </div>
                    <div class="flex flex-col p-2 text-white">
                        <img src="{{ asset('images/map2.png') }}" alt="icon sensor" class="w-20">
                        <h2 class="font-semibold text-lg">N2O</h2>
                    </div> --}}
                    <div class="flex flex-col p-2">
                        <canvas id="co_gauge"></canvas>
                    </div>
                    <div class="flex flex-col p-2">
                        <canvas id="co_gauge"></canvas>
                    </div>
                    
                {{-- </div> --}}
            </div>
            <div class="col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <canvas id="gas_line"></canvas>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Grid 3
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
            </div>
        </div>
    </div>

    {{-- gauge chart --}}
    <script>
        const gauge = document.getElementById('co_gauge').getContext('2d');
        const co_gauge = new Chart(gauge, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [5000, 700],
                    backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(121, 121, 121, 0.8)'],
                    borderColor: ['rgba(54, 162, 235, 1)'],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Current CO₂ Level (ppm)'
                    },
                    legend : {
                        display: false,
                    }
                },
                rotation : 270,
                circumference: 180,
            }
        });
    </script>

    {{-- line chart --}}
    <script>
        const line = document.getElementById('gas_line').getContext('2d');
        const gas_line = new Chart(line, {
            type: 'line',
            data: {
                labels: {!! json_encode($timestamps) !!},
                datasets: [
                    {
                        label: 'CH₄ (ppm)',
                        data: {!! json_encode($ch4) !!},
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: false,
                        tension: 0.4
                    },
                    {
                        label: 'CO₂ (ppm)',
                        data: {!! json_encode($co2) !!},
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: false,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Gas Sensor Chart (CH₄ & CO₂)'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        title: {
                            display: true,
                            text: 'Konsentrasi (ppm)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Waktu (Jam:Menit)'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
