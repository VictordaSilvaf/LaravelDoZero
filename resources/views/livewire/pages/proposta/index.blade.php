@extends('.livewire.layouts.dashboard-layout')
@section('content')
    <h1 class="text-lg font-light">Propostas {{ $status }}</h1>

    <form class="mt-2" method="POST" action="{{ route('proposta.search') }}">
        @csrf
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
        <div class="relative">
            <input type="text" hidden name="stats" id="stats" value="{{ $status }}">
            <div 
                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg 
                    class="w-5 h-5 text-gray-500 dark:text-gray-400" 
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24" 
                    xmlns="http://www.w3.org/2000/svg">
                
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>    
                </svg>
            </div>
            
            <input 
                type="number" 
                id="search" 
                name="search" 
                class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                placeholder="Search Mockups, Logos..."
                @if (isset($search)) value="{{ $search }}" @endif
                >
            
            <button 
                type="submit" 
                class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Search
            </button>
        </div>
    </form>

    <table class="w-full mt-4 border table-auto border-slate-400 bg-desicon-white">
        <thead>
            <tr>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    ID
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Vendedor
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    CPF Cliente
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Total
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Data
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">

                </th>
            </tr>
        </thead>
        <tbody>
            @isset($propostas)
                @foreach ($propostas as $proposta)
                    <tr>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $proposta->id }}
                        </td>
                        <td class="px-2 py-1 font-light text-center text-gray-600 truncate border border-slate-300 ">
                            
                            {{ mb_strimwidth($proposta->users->name, 0, 20, '...') }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 truncate border border-slate-300">
                            {{ $proposta->clientes->cnpj }}
                        </td>
                        <td class="px-2 py-1 font-light text-center text-gray-600 truncate border border-slate-300">
                           R$ {{ $proposta->total }}
                        </td>
                        <td class="px-2 py-1 font-light text-center text-gray-600 border border-slate-300">
                            {{ $proposta->updated_at }}
                        </td>
                        <td
                            class="px-2 py-1 font-light text-center text-gray-600 duration-150 border border-slate-300 hover:opacity-80">
                            <button id={{ 'dropdownButton' . $loop->index }}
                                class="dropdownButton p-1.5 rounded-lg bg-desicon-blue focus:opacity-60" type="button">
                                <x-bi-gear-fill class="w-3 h-3 text-desicon-white" />
                            </button>
                        </td>
                        <!-- Dropdown menu -->
                        <div id={{ 'dropdownMenu' . $loop->index }}
                            class="hidden text-center bg-white divide-y divide-gray-100 rounded shadow w-28 dropdownMenuz-10 dark:bg-gray-700 dropdownMenu">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownButton">
                                <li>
                                    <a href={{ route('proposta.show', ['id' => $proposta->id]) }}
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Visualizar</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Editar</a>
                                </li>
                                <li>
                                    <a href={{ route('proposta.estado', ['id' => $proposta->id, 'estado' => 1]) }}
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Aceitar</a>
                                </li>
                                <li>
                                    <a href={{ route('proposta.estado', ['id' => $proposta->id, 'estado' => 2]) }}
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Recusar</a>
                                </li>
                                <li>
                                    <a href="{{ route('proposta.enviarpdf', $proposta->id) }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Email</a>
                                </li>
                                <li>
                                    <a href="{{ route('proposta.pdf', $proposta->id) }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">PDF</a>
                                </li>
                            </ul>
                        </div>
                    </tr>
                @endforeach
            @endisset

        </tbody>
    </table>
    <div class="w-full">
        {{-- @isset($propostas)
            {{ $propostas->appends(['stats' => $status])->onEachSide(1)->links() }}
        @endisset --}}
    </div>

    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src={{ asset('js/proposta/pendentes.js') }}></script>
    <script src={{ asset('js/scripts/masks.js') }}></script>
@endsection
