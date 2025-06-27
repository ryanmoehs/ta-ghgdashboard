<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Sumber Emisi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 gap-4">
                    <h1 class=" font-bold ">Edit Sumber Emisi</h1>
                    <form action="{{ route('emisi.update', $sumberEmisi->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        {{-- <input type="hidden" name="id" value="{{ $sumberEmisi->id }}"> --}}
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="sumber" :value="__('Sensor Name')" />
                            <x-text-input id="sumber" name="sumber" type="text" class="mt-1 block w-full"
                                 autofocus autocomplete="sumber" placeholder="mis. Sensor A" value="{{ $sumberEmisi->sumber }}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('sumber')" />
                        </div>
                        {{-- <div class="mb-4">
                            <label for="sensor_type" class="block text-gray-700 text-sm font-bold mb-2">Sensor Type</label>
                            <input type="text" name="sensor_type" id="sensor_type" value="{{ $sensor->sensor_type }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                        </div> --}}
                        <div>
                            <x-input-label for="tipe_sumber" :value="__('Tipe Sumber')" />
                            <x-select-input id="tipe_sumber" name="tipe_sumber" type="text" class="mt-1 block w-full" required autofocus autocomplete="status">
                                @foreach($tipeSumberOptions as $value => $label)
                                    <option value="{{ $value }}" {{ $sumberEmisi->tipe_sumber == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('tipe_sumber')" />
                        </div>
                        <div>
                            <x-input-label for="kapasitas_output" :value="__('kapasitas_output')" />
                            <x-text-input id="kapasitas_output" name="kapasitas_output" type="text" class="mt-1 block w-full"
                                 autofocus autocomplete="kapasitas_output" placeholder="mis. Sensor A" value="{{ $sumberEmisi->kapasitas_output }}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('kapasitas_output')" />
                        </div>
                        <div>
                            <x-input-label for="frekuensi_hari" :value="__('Frekuensi Hari')" />
                            <x-text-input id="frekuensi_hari" name="frekuensi_hari" type="text" class="mt-1 block w-full"
                                 autofocus autocomplete="frekuensi_hari" placeholder="mis. Sensor A" value="{{ $sumberEmisi->frekuensi_hari }}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('frekuensi_hari')" />
                        </div>
                        <div>
                            <x-input-label for="durasi_pemakaian" :value="__('Durasi Pemakaian')" />
                            <x-text-input id="durasi_pemakaian" name="durasi_pemakaian" type="text" class="mt-1 block w-full"
                                 autofocus autocomplete="durasi_pemakaian" placeholder="mis. Sensor A" value="{{ $sumberEmisi->durasi_pemakaian }}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('durasi_pemakaian')" />
                        </div>
                        <div>
                            <x-input-label for="dokumentasi" :value="__('Dokumentasi')" />
                            @if ($sumberEmisi->dokumentasi)
                                <img src="{{ asset('uploads/sumber_emisi/' . $sumberEmisi->dokumentasi) }}" alt="Dokumentasi" class="w-50 mb-2">
                            @endif
                            <x-text-input id="dokumentasi" name="dokumentasi" type="file" class="mt-1 block w-full"
                                 autofocus autocomplete="dokumentasi" placeholder="mis. Sensor A" value="{{ $sumberEmisi->dokumentasi }}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('dokumentasi')" />
                        </div>
                        <x-primary-button class="mt-4">Update Sumber Emisi</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>