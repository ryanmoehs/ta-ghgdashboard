<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Perusahaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <a href="perusahaan/edit/1" class="p-2 bg-blue-700 rounded-lg text-white">Edit Perusahaan</a>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="p-2 max-w-full flex justify-between">
                    <div class="flex flex-col gap-y-2">
                        <div>
                            <x-input-label for="nama" :value="__('Nama Perusahaan')" />
                            <span id="nama" class="block font-semibold">{{$perusahaans->nama}}</span>
                        </div>
                        <div>
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <span id="alamat" class=" block font-semibold">{{$perusahaans->alamat}}</span>
                        </div>
                        <div>
                            <x-input-label for="provinsi" :value="__('Provinsi')" />
                            <span id="provinsi" class=" block font-semibold">{{$perusahaans->provinsi}}</span>
                        </div>
                        <div>
                            <x-input-label for="kab_kota" :value="__('Kabupaten/Kota')" />
                            <span id="kab_kota" class=" block font-semibold">{{$perusahaans->kab_kota}}</span>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-col gap-y-2">
                            
                            <div>
                                <x-input-label for="kecamatan" :value="__('Kecamatan')" />
                                <span id="kecamatan" class=" block font-semibold">{{$perusahaans->kecamatan}}</span>
                            </div>
                            <div>
                                <x-input-label for="kelurahan" :value="__('Kelurahan')" />
                                <span id="kelurahan" class=" block font-semibold">{{$perusahaans->kelurahan}}</span>
                            </div>
                            <div>
                                <x-input-label for="no_telp" :value="__('Nomor Telepon')" />
                                <span id="no_telp" class=" block font-semibold">{{$perusahaans->no_telp}}</span>
                        </div>
                        <div>
                            <x-input-label for="kode_pos" :value="__('Kode Pos')" />
                            <span id="kode_pos" class=" block font-semibold">{{$perusahaans->kode_pos}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-4">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="p-2 max-w-full flex justify-between">
            <div class="flex flex-col gap-y-2">
                <div>
                    <x-input-label for="penanggung_jawab" :value="__('Penanggung Jawab')" />
                    <span id="penanggung_jawab" class=" block font-semibold">{{$perusahaans->penanggung_jawab}}</span>
                </div>
                <div>
                    <x-input-label for="no_hp" :value="__('No HP')" />
                    <span id="no_hp" class=" block font-semibold">{{$perusahaans->no_hp}}</span>
                </div>
                <div>
                    <x-input-label for="jabatan" :value="__('Jabatan')" />
                    <span id="jabatan" class="mt-1 block font-semibold">{{$perusahaans->jabatan}}</span>
                </div>
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <span id="email" class="mt-1 block font-semibold">{{$perusahaans->email}}</span>
                </div>
            </div>
            <div class="flex flex-col gap-y-2">
                <div>
                    <a href="perusahaan/edit" class="p-2 bg-blue-700 rounded-lg text-white">Edit Perusahaan</a>
                </div>
            </div>
        </div>
        <div>
        </div>
</x-app-layout>