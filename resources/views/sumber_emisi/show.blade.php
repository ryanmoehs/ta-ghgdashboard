<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
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
                    <div class="flex flex-col gap-y-2">
                        <div>
                            <img src="{{asset('uploads/sumber_emisi/'.$sumberEmisi->dokumentasi)}}" 
                                        alt="{{$sumberEmisi->dokumentasi}}"
                                        class="w-20">
                        </div>
                        <div>
                            {{-- <x-input-label for="sumber" :value="__('Sumber')" /> --}}
                            <span id="sumber" class="block font-semibold">{{$sumberEmisi->sumber}}</span>
                        </div>
                        <div>
                            <x-input-label for="tipe_sumber" :value="__('Tipe Sumber')" />
                            <span id="tipe_sumber" class=" block font-semibold">{{$sumberEmisi->tipe_sumber}}</span>
                        </div>
                        <div>
                            <x-input-label for="kapasitas_output" :value="__('Kapasitas Output')" />
                            <span id="kapasitas_output" class=" block font-semibold">{{$sumberEmisi->kapasitas_output}}</span>
                        </div>
                        <div>
                            <x-input-label for="frekuensi_hari" :value="__('Frekuensi Hari Aktif')" />
                            <span id="frekuensi_hari" class=" block font-semibold">{{$sumberEmisi->frekuensi_hari}}</span>/7
                        </div>
                        <div>
                            <x-input-label for="durasi_pemakaian" :value="__('Durasi Pemakaian')" />
                            <span id="durasi_pemakaian" class=" block font-semibold">{{$sumberEmisi->durasi_pemakaian}} {{$sumberEmisi->unit}}</span>
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