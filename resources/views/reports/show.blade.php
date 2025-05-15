<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Laporan {{ $report->timestamps }}
                </h2>
                <div class="max-w-xl">
                    {{-- <form method="post" action="{{ route('report.store') }}" class="mt-6 space-y-6"> --}}
                        {{-- @csrf --}}
                
                        {{-- <div>
                            <x-input-label for="name" :value="__('Nama Sensor')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $nama_sensor }}" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div> --}}
                
                        <div>
                            <x-input-label for="total_ch4" :value="__('Total CH4')" />
                            <x-text-input id="total_ch4" name="total_ch4" type="text" class="mt-1 block w-full" value="{{ $report->total_ch4 }}" required autofocus autocomplete="total_ch4" />
                            <x-input-error class="mt-2" :messages="$errors->get('total_ch4')" />
                        </div>
                            
                        <div class="mt-2">
                            <x-input-label for="total_co2" :value="__('Total CO2')" />
                            <x-text-input id="total_co2" name="total_co2" type="text" class="mt-1 block w-full" value="{{ $report->total_co2 }}" required autofocus autocomplete="total_co2" />
                            <x-input-error class="mt-2" :messages="$errors->get('total_co2')" />
                        </div>
            
                        <div class="mt-2">
                            <x-input-label for="komentar" :value="__('Komentar')" />
                            <x-text-input id="komentar" name="komentar" type="text" class="mt-1 block w-full" value="{{ $report->komentar }}" required autocomplete="komentar" />
                            <x-input-error class="mt-2" :messages="$errors->get('komentar')" />
                        </div>
                </div>

                <div class="flex justify-end gap-x-4 mt-4">
                    
                    <a href="/report/{{ $report->id }}" class="px-4 py-2 rounded-full bg-green-700 text-white">Terima</a>
                    <a href="/report/{{ $report->id }}" class="px-4 py-2 rounded-full bg-red-700 text-white">Tolak</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>