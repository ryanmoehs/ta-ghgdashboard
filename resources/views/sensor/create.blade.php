<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendataan Sensor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class=" font-bold ">Tambah Sensor</h1>
                    <form action="{{ route('sensor.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="sensor_name" :value="__('Sensor Name')" />
                            <x-text-input id="sensor_name" name="sensor_name" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="sensor_name" placeholder="mis. Sensor A" />
                            <x-input-error class="mt-2" :messages="$errors->get('sensor_name')" />
                        </div>
                        <div>
                            <x-input-label for="field" :value="__('Field')" />
                            <x-select-input id="field" name="field" type="text"
                                class="mt-1 block w-full" required autofocus autocomplete="status">
                                <option selected disabled>Pilih Field sesuai fitur deteksi sensor...</option>
                                <option value="field1">Field 1 - Kecepatan Angin (m/s)</option>
                                <option value="field2">Field 2 - Arah Angin (°)</option>
                                <option value="field3">Field 3 - Suhu (°C)</option>
                                <option value="field4">Field 4 - Kelembaban (%)</option>
                                <option value="field5">Field 5 - PM2.5 (µg/m3)</option>
                                <option value="field6">Field 6 - PM10 (µg/m3)</option>
                                <option value="field7">Field 7 - CO2 (ppm)</option>
                                <option value="field8">Field 8 - CH4 (ppm)</option>

                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('field')" />
                        </div>
                        <input type="hidden" id="parameter_name" name="parameter_name">
                        <input type="hidden" id="unit" name="unit">
                        <div>
                            <x-input-label for="latitude" :value="__('Latitude')" />
                            <x-text-input id="latitude  " name="latitude" type="text" class="mt-1 block w-full" required
                                autofocus autocomplete="latitude " placeholder="" />
                            <x-input-error class="mt-2" :messages="$errors->get('latitude')" />
                        </div>
                        <div>
                            <x-input-label for="longitude" :value="__('Longitude')" />
                            <x-text-input id="longitude  " name="longitude" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="longitude " placeholder="" />
                            <x-input-error class="mt-2" :messages="$errors->get('longitude')" />
                        </div>


                        <x-primary-button>Tambah Sensor</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const fieldMapping = {
            field1: { parameter: "Kecepatan Angin", unit: "m/s" },
            field2: { parameter: "Arah Angin", unit: "°" },
            field3: { parameter: "Suhu", unit: "°C" },
            field4: { parameter: "Kelembaban", unit: "%" },
            field5: { parameter: "PM2.5", unit: "µg/m3" },
            field6: { parameter: "PM10", unit: "µg/m3" },
            field7: { parameter: "CO2", unit: "ppm" },
            field8: { parameter: "CH4", unit: "%LEL" },
        };

        document.getElementById('field').addEventListener('change', function () {
            const selected = this.value;
            const mapping = fieldMapping[selected];
            if (mapping) {
                document.getElementById('parameter_name').value = mapping.parameter;
                document.getElementById('unit').value = mapping.unit;
            }
        });
    </script>
</x-app-layout>