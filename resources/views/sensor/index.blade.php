<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lokasi Sensor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class=" font-bold ">Sensor</h1>
                    <a href="/sensor-location/create">
                        <button
                            class="w-[225px] bg-[#2264E5] hover:bg-lime-500 text-white shadow-md font-bold py-2 px-4 rounded mr-[50px] mb-4">
                            Tambah Sensor
                        </button>
                    </a>
                    <div id="map" class="w-full h-[500px]"></div>
                    <script>
                        var map = L.map('map').setView([-6.9175, 107.6191], 25);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '© OpenStreetMap'
                        }).addTo(map);

                        @foreach ($sensors as $sensor)
                            L.marker([{{ $sensor->latitude }}, {{ $sensor->longitude }}]).addTo(map)
                                .bindPopup('<b>{{ $sensor->sensor_id }}</b><br>{{ $sensor->timestamp }}<br><a href="http://maps.google.com/maps?q={{ $sensor->latitude }}%2C{{ $sensor->longitude }}&z=17&hl=en">Go to Map</a><br>');
                        @endforeach
                    </script>   
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sensor ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sensor Type</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Latitude</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Longitude</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($sensors as $sensor)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $sensor->sensor_id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $sensor->sensor_type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $sensor->latitude }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $sensor->longitude }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="http://maps.google.com/maps?q={{ $sensor->latitude }}%2C{{ $sensor->longitude }}&z=17&hl=en" class="text-blue-600 hover:text-blue-900">View on Map</a>
                                            |
                                            <a href="{{ route('sensor.edit', $sensor->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                            |
                                            <form action="{{ route('sensor.destroy', $sensor->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this sensor?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
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
    </div>
</div>


</x-app-layout>