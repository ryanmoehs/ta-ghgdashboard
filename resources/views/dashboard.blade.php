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
            
            <div class="row-span-2 flex flex-col justify-between">
                <div class="bg-green-700 flex justify-between p-6 text-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2>Kelembaban</h2>
                    <span class="text-lg font-semibold">{{ $humidity }} g/cm³</span>
                </div>
                <div class="bg-red-700 flex justify-between p-6 text-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2>Temperatur</h2>
                    <span class="text-lg font-semibold">{{ $temperature }} °C</span>
                </div>
                <div class="bg-orange-700 flex justify-between p-6 text-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2>Kecepatan Angin</h2>
                    <span class="text-lg font-semibold">-</span>
                </div>
                <div class="bg-blue-700 flex justify-between p-6 text-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2>Arah Angin</h2>
                    <span class="text-lg font-semibold">-</span>
                </div>
            </div>
            
            <div class="flex-col col-span-2 row-span-2 bg-white flex justify-between items-center overflow-hidden shadow-sm sm:rounded-lg p-4">
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
                    <div class="flex">
                        {{-- Chart CO2 --}}
                        <div class="relative flex flex-col items-center justify-center p-2 h-48 w-full">
                            <canvas id="co_gauge"></canvas>
                            <div class="absolute">
                                <p class="text-2xl font-bold text-gray-700">{{ $latest_co2 ?? 0 }}</p>
                                <p class="text-sm text-gray-500 text-center">ppm</p>
                            </div>
                        </div>
                    
                        {{-- Chart CH4 --}}
                        <div class="relative flex flex-col items-center justify-center p-2 h-48 w-full">
                            <canvas id="ch4_gauge"></canvas>
                            <div class="absolute">
                                <p class="text-2xl font-bold text-gray-700">{{ $latest_ch4 ?? 0 }}</p>
                                <p class="text-sm text-gray-500 text-center">ppm</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        {{-- Chart PM2.5 --}}
                        <div class="relative flex flex-col items-center justify-center p-2 h-48 w-full">
                            <canvas id="pm25_gauge"></canvas>
                            <div class="absolute">
                                <p class="text-2xl font-bold text-gray-700">{{ $latest_pm25 ?? 0 }}</p>
                                <p class="text-sm text-gray-500 text-center">µg/m³</p>
                            </div>
                        </div>
                        
                        {{-- Chart PM10 --}}
                        <div class="relative flex flex-col items-center justify-center p-2 h-48 w-full">
                            <canvas id="pm10_gauge"></canvas>
                            <div class="absolute">
                                <p class="text-2xl font-bold text-gray-700">{{ $latest_pm10 ?? 0 }}</p>
                                <p class="text-sm text-gray-500 text-center">µg/m³</p>
                            </div>
                        </div>
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
                    <h2>Status Sensor</h2>
                    @foreach ($sensors as $s)
                    <a href="{{ route('sensor.edit', $s->id) }}">
                        <div class="bg-white flex justify-between overflow-hidden shadow-sm sm:rounded-lg border border-slate-700 border-1 gap-y-2 mt-4 p-2">
                            <h2>{{ $s->sensor_id }}</h2>
                            <span class="text-lg font-semibold text-green-500">Normal</span>
                        </div>
                    </a>
                    @endforeach
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
        const id_co2 = document.getElementById('co_gauge').getContext('2d');
        const id_ch4 = document.getElementById('ch4_gauge').getContext('2d');
        const id_pm25 = document.getElementById('pm25_gauge').getContext('2d');
        const id_pm10 = document.getElementById('pm10_gauge').getContext('2d');

        const value_co2 = {{ $latest_co2 ?? 0 }};
        const max_co2 = 5000; // Contoh nilai maksimum

        const value_ch4 = {{ $latest_ch4 ?? 0 }};
        const max_ch4 = 5000; // Contoh nilai maksimum

        const value_pm25 = {{ $latest_pm25 ?? 0 }};
        const max_pm25 = 250; // Contoh nilai maksimum

        const value_pm10 = {{ $latest_pm10 ?? 0 }};
        const max_pm10 = 420; // Contoh nilai maksimum


        const co_gauge = new Chart(id_co2, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [value_co2, max_co2 - value_co2],
                    backgroundColor: ['rgba(20, 203, 95, 0.8)', 'rgba(121, 121, 121, 0.8)'],
                    borderColor: ['rgba(0, 0, 0, 0.8)'],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'CO₂ (ppm)'
                    },
                    legend : {
                        display: false,
                    }
                },
                rotation : 270,
                circumference: 180,
                maintainAspectRatio: false,
                cutout: '60%',
            }
        });
        const ch4_gauge = new Chart(id_ch4, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [value_ch4, max_ch4 - value_ch4],
                    backgroundColor: ['rgba(20, 203, 95, 0.8)', 'rgba(121, 121, 121, 0.8)'],
                    borderColor: ['rgba(0, 0, 0, 0.8)'],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'CH₄ (ppm)'
                    },
                    legend : {
                        display: false,
                    }
                },
                rotation : 270,
                circumference: 180,
                maintainAspectRatio: false,
                cutout: '60%'
            }
        });
        const pm25_gauge = new Chart(id_pm25, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [value_pm25, max_pm25 - value_pm25],
                    backgroundColor: ['rgba(20, 203, 95, 0.8)', 'rgba(121, 121, 121, 0.8)'],
                    borderColor: ['rgba(0, 0, 0, 0.8)'],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'PM 2.5 (ppm)'
                    },
                    legend : {
                        display: false,
                    }
                },
                rotation : 270,
                circumference: 180,
                maintainAspectRatio: false,
                cutout: '60%'
            }
        });
        const pm10_gauge = new Chart(id_pm10, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [value_pm10, max_pm10 - value_pm10],
                    backgroundColor: ['rgba(20, 203, 95, 0.8)', 'rgba(121, 121, 121, 0.8)'],
                    borderColor: ['rgba(0, 0, 0, 0.8)'],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'PM 10 (ppm)'
                    },
                    legend : {
                        display: false,
                    }
                },
                rotation : 270,
                circumference: 180,
                maintainAspectRatio: false,
                cutout: '60%'
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
                    },
                    {
                        label: 'PM2.5 (ppm)',
                        data: {!! json_encode($pm25) !!},
                        borderColor: 'rgba(79, 245, 39, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: false,
                        tension: 0.4
                    },
                    {
                        label: 'PM10 (ppm)',
                        data: {!! json_encode($pm10) !!},
                        borderColor: 'rgba(203, 140, 20, 1)',
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
