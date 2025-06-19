@php
$user = Auth::user();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Channel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="font-semibold">Tambah Channel</h1>
                    {{-- Form Tambah Channel --}}
                    <form action="{{ route('channel.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="channel_id" :value="__('Channel ID')" />
                            <x-text-input id="channel_id" name="channel_id" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="channel_id"
                                placeholder="Tuliskan Channel ID Thingspeak" />
                            <x-input-error class="mt-2" :messages="$errors->get('channel_id')" />
                        </div>
                        <div>
                            <x-input-label for="name" :value="__('Name Channel')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
                                autocomplete="name" placeholder="Tuliskan nama channel" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="api_read_key" :value="__('API Read Key')" />
                            <x-text-input id="api_read_key" name="api_read_key" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="api_read_key"
                                placeholder="Tuliskan API Read Key Thingspeak" />
                            <x-input-error class="mt-2" :messages="$errors->get('api_read_key')" />
                        </div>
                        <div>
                            <x-input-label for="latitude" :value="__('Latitude')" />
                            <x-text-input id="latitude" name="latitude" type="text" class="mt-1 block w-full" required
                                autofocus autocomplete="latitude" placeholder="Tuliskan Longitude" />
                            <x-input-error class="mt-2" :messages="$errors->get('latitude')" />
                        </div>
                        <div>
                            <x-input-label for="longitude" :value="__('Longitude')" />
                            <x-text-input id="longitude" name="longitude" type="text" class="mt-1 block w-full" required
                                autofocus autocomplete="longitude" placeholder="Tuliskan Latitude" />
                            <x-input-error class="mt-2" :messages="$errors->get('longitude')" />
                        </div>
                        <div>
                            <x-input-label for="deksripsi" :value="__('Deksripsi')" />
                            <x-text-input id="deksripsi" name="deksripsi" type="text" class="mt-1 block w-full" required
                                autofocus autocomplete="deksripsi" placeholder="Tuliskan Deskripsi singkat Channel" />
                            <x-input-error class="mt-2" :messages="$errors->get('deksripsi')" />
                        </div>



                        <x-primary-button>Simpan</x-primary-button>
                    </form>

                    {{-- Form Deteksi Field --}}
                    {{-- <form action="{{ route('thingspeak.detect.fields') }}" method="POST" class="mb-4">
                        @csrf
                        <h4>Deteksi Field Otomatis dari ThingSpeak</h4>
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" name="channel_id" placeholder="Channel ID" required>
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" name="api_read_key"
                                placeholder="API Read Key (jika ada)">
                        </div>
                        <button type="submit" class="btn btn-success">Deteksi Field</button>
                    </form>

                    @isset($fields)
                    <h4>Field Ditemukan</h4>
                    <ul class="list-group">
                        @foreach ($fields as $field)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $field['field'] }}</strong>: {{ $field['label'] }}
                            </div>
                            <form action="{{ route('sensor.store') }}" method="POST" class="d-flex gap-2">
                                @csrf
                                <input type="hidden" name="thingspeak_channel_id" value="{{ $channelId }}">
                                <input type="hidden" name="field" value="{{ $field['field'] }}">
                                <input type="hidden" name="parameter_name" value="{{ $field['label'] }}">
                                <input type="text" name="unit" placeholder="Satuan" class="form-control" required>
                                <button type="submit" class="btn btn-sm btn-primary">Daftarkan</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    @endisset --}}
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>