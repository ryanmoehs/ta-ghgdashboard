<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Sensor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <span>Lokasi Sensor</span>
                    <div id="map" class="w-full h-[250px]"></div>
                    <script>
                        var map = L.map('map').setView([-6.9175, 107.6191], 20);
                        
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '© OpenStreetMap'
                        }).addTo(map);

                        @foreach ($sensors as $sensor)
                        // ntar nambahin jumlah sensornya
                            L.marker([{{ $sensor->latitude }}, {{ $sensor->longitude }}]).addTo(map)
                            .bindPopup(`
                                Name : {{ $sensor->sensor_name }}<br>
                                Lat: {{ $sensor->latitude }}<br>
                                Long: {{ $sensor->longitude }}<br>
                                <a href="/sensor/{{$sensor->id}}">View Data</a>
                            `);

                            @endforeach
                    </script>

                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="overflow-x-auto">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between">
                            <span>Data Sensor</span>
                            <a href="/sensor/create">
                                <x-primary-button>+ Tambah Sensor</x-button-primary>
                            </a>
                        </div>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sensor Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Field</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Unit</th>
                                    <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Latitude</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Longitude</th> -->
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($sensors as $sensor)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $sensor->sensor_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $sensor->field}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $sensor->unit}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="http://maps.google.com/maps?q={{ $sensor->latitude }}%2C{{ $sensor->longitude }}&z=17&hl=en"
                                            class="text-blue-600 hover:text-blue-900">View on Map</a>
                                        |
                                        <a href="{{ route('sensor.edit', $sensor->id) }}"
                                            class="text-blue-600 hover:text-blue-900">Edit</a>
                                        |
                                        <form action="{{ route('sensor.destroy', $sensor->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this sensor?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                        |
                                        <a href="#">Maintenance</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="overflow-x-auto">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between">
                            <span>Data Channel</span>
                            <a href="/channel/add">
                                <x-primary-button>+ Tambah Channel</x-button-primary>
                            </a>
                        </div>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Channel Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Channel ID</th>
                                    <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Latitude</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Longitude</th> -->
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($channels as $ch)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $ch->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $ch->channel_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{-- <a href="http://maps.google.com/maps?q={{ $ch->latitude }}%2C{{ $ch->longitude }}&z=17&hl=en"
                                            class="text-blue-600 hover:text-blue-900">View on Map</a>
                                        |
                                        <a href="{{ route('sensor.edit', $sensor->id) }}"
                                            class="text-blue-600 hover:text-blue-900">Edit</a>
                                        |
                                        <form action="{{ route('sensor.destroy', $sensor->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this sensor?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                        | --}}
                                        {{-- <a href="#">Maintenance</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
    </div>


</x-app-layout>