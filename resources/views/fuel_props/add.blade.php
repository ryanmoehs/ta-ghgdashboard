@section('title', config('app.name', 'EMisi') . ' - Tambah Bahan Bakar')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Bahan Bakar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Tambah Bahan Bakar') }}
                    </h2>
                    <div class="max-w-xl">
                        <form method="post" action="{{ route('fuel_props.store') }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="fuel_type" :value="__('Tipe Bahan Bakar')" />
                                <x-text-input id="fuel_type" name="fuel_type" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="name" placeholder="Tulis nama bahan bakar" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="unit" :value="__('Satuan')" />
                                <x-text-input id="unit" name="unit" type="text" class="mt-1 block w-full" required
                                    autofocus autocomplete="unit" placeholder="Pilih satuan" />
                                <x-input-error class="mt-2" :messages="$errors->get('unit')" />
                            </div>

                            <div>
                                <x-input-label for="densitas" :value="__('Densitas')" />
                                <x-text-input id="densitas" name="densitas" type="text" class="mt-1 block w-full"
                                    required autocomplete="densitas" placeholder="Tulis Faktor Konversi" />
                                <x-input-error class="mt-2" :messages="$errors->get('densitas')" />
                            </div>
                            <div>
                                <x-input-label for="ncv" :value="__('NCV')" />
                                <x-text-input id="ncv" name="ncv" type="text" class="mt-1 block w-full" required
                                    autocomplete="ncv" placeholder="Tulis Faktor Konversi" />
                                <x-input-error class="mt-2" :messages="$errors->get('ncv')" />
                            </div>

                            <button type="button" id="hitung-konversi"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">Hitung
                                Faktor Konversi</button>
                            <div>
                                <x-input-label for="conversion_factor" :value="__('Faktor Konversi')" />
                                <x-text-input id="conversion_factor" name="conversion_factor" type="text"
                                    class="mt-1 block w-full" required autocomplete="conversion_factor"
                                    placeholder="Tulis Faktor Konversi" readonly />
                                <x-input-error class="mt-2" :messages="$errors->get('conversion_factor')" />
                            </div>

                            <div>
                                <x-input-label for="co2_factor" :value="__('Faktor CO2')" />
                                <x-text-input id="co2_factor" name="co2_factor" type="text" class="mt-1 block w-full"
                                    required autocomplete="co2_factor"
                                    placeholder="Tuliskan koma menjadi titik. Mis. 4.8" />
                                <x-input-error class="mt-2" :messages="$errors->get('co2_factor')" />
                            </div>
                            <div>
                                <x-input-label for="ch4_factor" :value="__('Faktor CH4')" />
                                <x-text-input id="ch4_factor" name="ch4_factor" type="text" class="mt-1 block w-full"
                                    required autocomplete="ch4_factor"
                                    placeholder="Tuliskan koma menjadi titik. Mis. 4.8" />
                                <x-input-error class="mt-2" :messages="$errors->get('ch4_factor')" />
                            </div>
                            <div>
                                <x-input-label for="n2o_factor" :value="__('Faktor N2O')" />
                                <x-text-input id="n2o_factor" name="n2o_factor" type="text" class="mt-1 block w-full"
                                    required autocomplete="n2o_factor"
                                    placeholder="Tuliskan koma menjadi titik. Mis. 4.8" />
                                <x-input-error class="mt-2" :messages="$errors->get('n2o_factor')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- revisi lagi bagian ini --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('hitung-konversi');
        if (btn) {
            btn.addEventListener('click', function() {
                var densitasInput = document.getElementById('densitas');
                var ncvInput = document.getElementById('ncv');
                var convInput = document.getElementById('conversion_factor');
                if (densitasInput && ncvInput && convInput) {
                    var densitas = parseFloat(densitasInput.value.replace(',', '.'));
                    var ncv = parseFloat(ncvInput.value.replace(',', '.'));
                    if (!isNaN(densitas) && !isNaN(ncv)) {
                        // Menghitung faktor konversi
                        // Faktor Konversi = Densitas * NCV / 1000000
                        // 10000000 digunakan untuk mengkonversi dari kg ke ton
                        var hasil = densitas * ncv / 1000000;
                        convInput.value = hasil;
                    } else {
                        alert('Masukkan nilai Densitas dan NCV yang valid!');
                    }
                }
            });
        }
    });
</script>