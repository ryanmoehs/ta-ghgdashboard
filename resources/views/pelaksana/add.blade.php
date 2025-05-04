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
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                
                        <div>
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" required autofocus autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('username')" />
                        </div>
                
                        <div>
                            <x-input-label for="role" :value="__('Role')" />
                            {{-- <x-text-input id="role" name="role" type="text" class="mt-1 block w-full" required autofocus autocomplete="role" /> --}}
                            <x-select-input id="role" name="role" type="text" class="mt-1 block w-full" required autofocus autocomplete="role">
                                <option value="unit_pelaksana" >Unit Pelaksana</option>
                                <option value="#" >Tes</option>
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('role')" />
                        </div>
                
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
                
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-2">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('pelaksana.store') }}" class="mt-6 space-y-6">
                        @csrf
                
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
