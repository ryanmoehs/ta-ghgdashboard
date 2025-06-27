<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sumber Emisi') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <a href="/emisi/edit/{{$sumberEmisi->id}}">
                <x-primary-button>
                    Edit Data
                </x-primary-button>
            </a>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="p-2 max-w-full flex justify-between">
                    <div class="grid grid-cols-2 justify-between gap-4">
                        <div class="flex flex-col gap-4">
                            <div>
                                <x-input-label for="sumber" :value="__('Sumber')" />
                                <span id="sumber" class="block font-semibold">{{$sumberEmisi->sumber}}</span>
                            </div>
                            <div>
                                <x-input-label for="tipe_sumber" :value="__('Tipe Sumber')" />
                                @if ($sumberEmisi->tipe_sumber == 'alat_berat')
                                    <span id="tipe_sumber" class=" block font-semibold">Alat Berat</span>
                                @elseif ($sumberEmisi->tipe_sumber == 'kendaraan')
                                    <span id="tipe_sumber" class=" block font-semibold">Kendaraan</span>
                                @elseif ($sumberEmisi->tipe_sumber == 'boiler')
                                    <span id="tipe_sumber" class=" block font-semibold">Boiler</span>
                                @elseif ($sumberEmisi->tipe_sumber == 'genset')
                                    <span id="tipe_sumber" class=" block font-semibold">Genset</span>
                                @elseif ($sumberEmisi->tipe_sumber == 'lainnya')
                                    <span id="tipe_sumber" class=" block font-semibold">Lainnya</span>
                                @elseif($sumberEmisi->tipe_sumber =='dryer')
                                    <span id="tipe_sumber" class=" block font-semibold">Dryer</span>
                                @endif
                            </div>
                            <div>
                                <x-input-label for="kapasitas_output" :value="__('Kapasitas Output')" />
                                <span id="kapasitas_output"
                                    class=" block font-semibold">{{$sumberEmisi->kapasitas_output}} {{$sumberEmisi->unit}}</span>
                            </div>
                            <div>
                                <x-input-label for="frekuensi_hari" :value="__('Frekuensi Hari Aktif')" />
                                <h1><span id="frekuensi_hari"
                                    class=" block font-semibold">{{$sumberEmisi->frekuensi_hari}} /7</span>
                            </div>
                            <div>
                                <x-input-label for="durasi_pemakaian" :value="__('Durasi Pemakaian')" />
                                <span id="durasi_pemakaian"
                                    class=" block font-semibold">{{$sumberEmisi->durasi_pemakaian}}
                                    {{$sumberEmisi->unit}}</span>
                            </div>
                        </div>
                        <div>
                            <div>
                                <img src="{{asset('uploads/sumber_emisi/'.$sumberEmisi->dokumentasi)}}"
                                    alt="{{$sumberEmisi->dokumentasi}}" class="w-50">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex flex-col gap-y-2">
                            {{-- <div>
                                <x-input-label for="unit" :value="__('Unit Satuan')" />
                                <span id="unit" class=" block font-semibold">{{$sumberEmisi->unit}}</span>
                            </div> --}}
                            {{-- <div>
                                <x-input-label for="no_telp" :value="__('Nomor Telepon')" />
                                <span id="no_telp" class=" block font-semibold">{{$sumberEmisi->no_telp}}</span>
                            </div>
                            <div>
                                <x-input-label for="kode_pos" :value="__('Kode Pos')" />
                                <span id="kode_pos" class=" block font-semibold">{{$sumberEmisi->kode_pos}}</span>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>