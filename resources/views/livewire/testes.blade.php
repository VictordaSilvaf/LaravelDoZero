<div>
    <div>
        <input type="text" wire:model='test' name="" id="">
        {{ $test }}
    </div>
    
    <h1 class="text-lg font-light">Propostas</h1>

    <form class="mt-2" method="POST" action="{{ route('proposta.search') }}">
        @csrf
        <div class="flex">
            
            
            <div class="relative w-full">
                <input type="search" name="search" id="search" class="w-full" placeholder="Buscar proposta" @if (isset($search)) value="{{ $search }}" @endif>
                
                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
            </div>
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
</div>
