<x-app-layout>
    <x-slot name="header">
        <span class="font-light text-slate-400 text-sm">Home / Sumber Emisi</span>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sumber Emisi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 overflow-hidden gap-x-4 shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col">
                    Fugitif
                    <span class="font-semibold text-2xl">{{count($sumberEmisis)}}</span>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col">
                    Energy
                    <span class="font-semibold text-2xl">2</span>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col">
                    Total
                    <span class="font-semibold text-2xl">2</span>
                </div>
            </div>
            <div class="bg-white mt-4 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <input type="text" id="table-search-users" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 " placeholder="Search for data">
                        </div>
                        <div class="mt-6 flex justify-end gap-x-4">
                            <a href="/emisi/tambah">
                                <x-primary-button>
                                    {{ __('+ Buat') }}
                                </x-primary-button>
                            </a>
                            <a href="{{ route('report.export') }}">
                                <x-primary-button>
                                    {{ __('> Export') }}
                                </x-primary-button>
                            </a>
                        </div>
                    </div>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Sumber</th>
                                <th class="px-4 py-2">Kapasitas Output</th>
                                <th class="px-4 py-2">Tipe Sumber</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($sumberEmisis as $se)
                                <tr>
                                    <td class="flex px-4 py-2 justify-center align-center items-center">
                                        <img src="{{asset('uploads/sumber_emisi/'.$se->dokumentasi)}}" 
                                        alt="{{$se->dokumentasi}}"
                                        class="w-20">
                                        {{-- {{ $se->dokumentasi }} --}}
                                    </td>
                                    <td class=" px-4 py-2">{{ $se->sumber }}</td>
                                    <td class=" px-4 py-2">{{ $se->kapasitas_output }} {{$se->unit}}</td>
                                    @if ($se->tipe_sumber == 'kendaraan')
                                        <td class="px-4 py-2"><span class="py-2 px-4 bg-fuchsia-700 text-white rounded-full">Kendaraan</span></td>
                                    @elseif ($se->tipe_sumber == 'alat_berat')
                                        <td class="px-4 py-2"><span class="py-2 px-4 bg-blue-700 text-white rounded-full">Alat Berat</span></td>
                                    @elseif ($se->tipe_sumber == 'boiler')
                                        <td class="px-4 py-2"><span class="py-2 px-4 bg-cyan-700 text-white rounded-full">Boiler</span></td>
                                    @endif
                                    <td class=" px-4 py-2">
                                        {{-- <a href="/emisi/{{$se->id}}" class="px-4 py-2 rounded-full bg-blue-400 text-white">View</a>
                                        <a href="/emisi/{{$se->id}}" class="px-4 py-2 rounded-full bg-blue-400 text-white">Edit</a> --}}

                                        <a href="/emisi/{{$se->id}}">View</a>
                                        <a href="/emisi/{{$se->id}}">Edit</a>
                                        <a href="#modalDel"
                                            data-target="confirm-sumber-emisi-deletion">Delete</a>
                                            
                                        <x-modal id="modalDel" name="confirm-sumber-emisi-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form method="post" action="{{ route('emisi.destroy', $se->id) }}" class="p-6">
                                                @csrf
                                                @method('delete')
                                    
                                                <h2 class="text-lg font-medium text-gray-900">
                                                    {{ __('Yakin menghapus data ini?') }}
                                                </h2>
                                    
                                                <p class="mt-1 text-sm text-gray-600">
                                                    {{ __('Emisi $se->sumber') }}
                                                </p>
                                    
                                    
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Batal') }}
                                                    </x-secondary-button>
                                    
                                                    <x-danger-button class="ms-3">
                                                        {{ __('Hapus Data') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                        
                                    </td>
                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
        
                </div>
            </div>
        </div>
    </div>


</x-app-layout>