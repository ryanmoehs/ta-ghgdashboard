<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Unit Pelaksana') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tambah Unit Pelaksana') }}
                </h2>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('pelaksana.store') }}" class="mt-6 space-y-6">
                        @csrf
                
                        <div>
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                
                        <div>
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" required autofocus autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('username')" />
                        </div>
                
                        <input type="text" name="role" value="unit_pelaksana" hidden>
                
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label for="no_hp" :value="__('Nomor Handphone')" />
                            <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" required autocomplete="no_hp" />
                            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                
                        
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                
                        <div>
                            <x-input-label for="alamat" :value="__('alamat')" />
                            <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" required autofocus autocomplete="alamat" />
                            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                            </div>
                            <div>
                                <x-input-label for="provinsi" :value="__('provinsi')" />
                                <x-text-input id="provinsi" name="provinsi" type="text" class="mt-1 block w-full" required autofocus autocomplete="provinsi" />
                            <x-input-error class="mt-2" :messages="$errors->get('provinsi')" />
                        </div>
                        <div>
                            <x-input-label for="kab_kota" :value="__('kab_kota')" />
                            <x-text-input id="kab_kota" name="kab_kota" type="text" class="mt-1 block w-full" required autofocus autocomplete="kab_kota" />
                            <x-input-error class="mt-2" :messages="$errors->get('kab_kota')" />
                            </div>
                            <div>
                                <x-input-label for="kecamatan" :value="__('kecamatan')" />
                                <x-text-input id="kecamatan" name="kecamatan" type="text" class="mt-1 block w-full" required autofocus autocomplete="kecamatan" />
                                <x-input-error class="mt-2" :messages="$errors->get('kecamatan')" />
                            </div>
                            <div>
                                <x-input-label for="desa" :value="__('desa')" />
                                <x-text-input id="desa" name="desa" type="text" class="mt-1 block w-full" required autofocus autocomplete="desa" />
                                <x-input-error class="mt-2" :messages="$errors->get('desa')" />
                            </div>
                            <div>
                                <x-input-label for="no_telp" :value="__('no_telp')" />
                                <x-text-input id="no_telp" name="no_telp" type="text" class="mt-1 block w-full" required autofocus autocomplete="no_telp" />
                                <x-input-error class="mt-2" :messages="$errors->get('no_telp')" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
       
    </div>
</x-app-layout>
