@section('title', config('app.name', 'EMisi') . ' - Edit Sumber Emisi ' . $sumberEmisi->sumber)
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
                            <x-input-label for="sumber" :value="__('Nama Sumber')" />
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
                            <x-select-input id="tipe_sumber" name="tipe_sumber" type="text" class="mt-1 block w-full"  autofocus autocomplete="status">
                                @foreach($tipeSumberOptions as $value => $label)
                                    <option value="{{ $value }}" {{ $sumberEmisi->tipe_sumber == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('tipe_sumber')" />
                        </div>
                        <div>
                            <x-input-label for="kapasitas_output" :value="__('Kapasitas Output')"/>
                            <x-text-input id="kapasitas_output" name="kapasitas_output" type="text" class="mt-1 block w-full"
                                 autofocus autocomplete="kapasitas_output" placeholder="mis. Sensor A" value="{{ $sumberEmisi->kapasitas_output }}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('kapasitas_output')" />
                        </div>
                        <div>
                            <x-input-label for="frekuensi_hari" :value="__('Frekuensi Hari')" />
                            <div>
                                @for ($i = 1; $i <= 7; $i++)
                                    <label class="inline-flex items-center mr-4">
                                        <input type="radio" class="form-radio" name="frekuensi_hari" value="{{ $i }}" {{ $sumberEmisi->frekuensi_hari == $i ? 'checked' : '' }}>
                                        <span class="ml-2">{{ $i }}</span>
                                    </label>
                                @endfor
                            </div>
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
                        <div>
                            <x-input-label for="fuel_properties_id" :value="__('Bahan Bakar')" />
                            <x-select-input id="fuel_properties_id" name="fuel_properties_id" type="text" class="mt-1 block w-full" required autofocus autocomplete="status">
                                <option selected disabled>Pilih Bahan Bakar...</option>
                                @foreach ($fuelProperties as $fp)
                                    <option value="{{$fp->id}}" {{ $sumberEmisi->fuel_properties_id == $fp->id ? 'selected' : '' }}>{{$fp->fuel_type}}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('fuel_properties_id')" />
                        </div>
                        <div>
                            <x-input-label for="unit" :value="__('Unit')" />
                            <x-select-input id="unit" name="unit" type="text" class="mt-1 block w-full" required autofocus autocomplete="status">
                                <option selected disabled>Pilih Unit Satuan...</option>
                                <option value="ton" {{ $sumberEmisi->unit == 'ton' ? 'selected' : '' }}>Ton</option>
                                <option value="liter" {{ $sumberEmisi->unit == 'liter' ? 'selected' : '' }}>Liter</option>
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('unit')" />
                        </div>
                        <x-primary-button class="mt-4">Update Sumber Emisi</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>