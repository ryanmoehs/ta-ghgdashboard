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
                    <a href="/sensor-location"> 
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mb-4">Back</button>
                    </a>
                    <h1 class=" font-bold ">Tambah Sensor</h1>
                    <form action="{{ route('sensor.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="sensor_id" class="block text-gray-700 text-sm font-bold mb-2">Sensor ID (Nama Sensor)</label>
                            <input type="text" name="sensor_id" id="sensor_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="sensor_type" class="block text-gray-700 text-sm font-bold mb-2">Sensor Type</label>
                            <input type="text" name="sensor_type" id="sensor_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <div class="mb-4">
                            <label for="latitude" class="block text-gray-700 text-sm font-bold mb-2">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="longitude" class="block text-gray-700 text-sm font-bold mb-2">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Sensor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>