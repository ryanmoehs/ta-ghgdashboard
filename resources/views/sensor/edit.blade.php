<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Sensor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h1 class=" font-bold ">Edit Sensor</h1>
                    <form action="{{ route('sensor.update', $sensor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="sensor_name" :value="__('Sensor Name')" />
                            <x-text-input id="sensor_name" name="sensor_name" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="sensor_name" placeholder="mis. Sensor A"
                                value="{{ $sensor->sensor_name }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('sensor_name')" />
                        </div>
                        {{-- <div class="mb-4">
                            <label for="sensor_type" class="block text-gray-700 text-sm font-bold mb-2">Sensor
                                Type</label>
                            <input type="text" name="sensor_type" id="sensor_type" value="{{ $sensor->sensor_type }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                        </div> --}}
                        <div>
                            <x-input-label for="field" :value="__('Field')" />
                            <x-select-input id="tipe_sumber" name="tipe_sumber" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="status">
                                @foreach($sensorOptions as $value => $label)
                                <option value="{{ $value }}" {{ $sensor->field == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('field')" />
                        </div>
                        <div>
                            <x-input-label for="latitude" :value="__('Latitude')" />
                            <x-text-input id="latitude" name="latitude" type="text" class="mt-1 block w-full" required
                                autofocus autocomplete="latitude" placeholder="mis. Sensor A"
                                value="{{ $sensor->latitude }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('latitude')" />
                        </div>
                        <div>
                            <x-input-label for="longitude" :value="__('Longitude')" />
                            <x-text-input id="longitude" name="longitude" type="text" class="mt-1 block w-full" required
                                autofocus autocomplete="longitude" placeholder="mis. Sensor A"
                                value="{{ $sensor->longitude }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('longitude')" />
                        </div>
                        <x-primary-button class="mt-4">+ Update</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>