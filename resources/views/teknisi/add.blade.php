@section('title', config('app.name', 'EMisi') . ' - Tambah Teknisi')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Unit teknisi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tambah Unit teknisi') }}
                </h2>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('teknisi.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
                                autocomplete="name" placeholder="Tulis nama anda. Mis. Denis" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" required
                                autofocus autocomplete="username" placeholder="Tuliskan tanpa spasi. Mis. denis1"/>
                            <x-input-error class="mt-2" :messages="$errors->get('username')" />
                        </div>

                        <input type="text" name="role" value="teknisi" hidden>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required
                                autocomplete="email" placeholder="Tulis email anda. Mis. denis@email.com" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label for="no_hp" :value="__('Nomor Handphone')" />
                            <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" required
                                autocomplete="no_hp" placeholder="Tuliskan nomor handphone anda. Mis. 081234567"/>
                            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                required autocomplete="new-password" placeholder="Tuliskan password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
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