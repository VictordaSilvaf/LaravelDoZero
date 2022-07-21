<div class="">
    <livewire:components.alert />

    <h1 class="text-lg font-light">Propostas</h1>
    <form class="mt-2" method="POST" wire:submit.prevent='render'>
        <div class="flex">
            <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Buscar
                propostas</label>

            <button id="dropdown-button" data-dropdown-toggle="dropdown"
                class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                type="button">{{ $filtro }}<svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg></button>
            <div id="dropdown"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700"
                data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
                style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(897px, 5637px, 0px);">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                    <li>
                        <button type="button"
                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            name="todas" id="todas" wire:click="mudarFiltro('todas')">todas</button>
                    </li>
                    <li>
                        <button type="button"
                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            name="aceita" id="aceita" wire:click="mudarFiltro('aceita')">aceita</button>
                    </li>
                    <li>
                        <button type="button"
                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            name="pendente" id="pendente" wire:click="mudarFiltro('pendente')">pendente</button>
                    </li>
                    <li>
                        <button type="button"
                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            name="recusada" id="recusada" wire:click="mudarFiltro('recusada')">recusada
                        </button>
                    </li>
                </ul>
            </div>
            <div class="relative w-full">
                <input type="search" id="search-dropdown" wire:model='busca'
                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                    placeholder="Buscar propostas..." required>

                <button type="submit"
                    class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg
                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </form>

    <div class='w-full overflow-auto'>
        <table class="w-full max-w-full mt-4 overflow-x-scroll border table-auto border-slate-400 bg-desicon-white">
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
                    @can('admin')
                        <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">

                        </th>
                    @endcan

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
                            @can('admin')
                                <td
                                    class="px-2 py-1 font-light text-center text-gray-600 duration-150 border border-slate-300 hover:opacity-80">
                                    <button id={{ 'dropdownButton' . $loop->index }}
                                        class="dropdownButton p-1.5 rounded-lg 
                                    @if ($proposta->status == 'aceita') bg-desicon-green
                                    @elseif ($proposta->status == 'recusada')
                                        bg-desicon-red
                                        @else
                                        bg-desicon-yellow @endif
                                     focus:opacity-60"
                                        type="button">
                                        <x-bi-gear-fill class="w-3 h-3 text-desicon-white" />
                                    </button>
                                </td>
                            @endcan
                            <!-- Dropdown menu -->
                            <div id={{ 'dropdownMenu' . $loop->index }}
                                class="hidden text-center bg-white divide-y divide-gray-100 rounded shadow w-28 dropdownMenuz-10 dark:bg-gray-700 dropdownMenu">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownButton">
                                    <li>
                                        <a href={{ route('proposta.show', ['id' => $proposta->id]) }}
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Visualizar</a>
                                    </li>
                                    @if ($proposta->status != 'recusada' && $proposta->status != 'aceita')
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Editar</a>
                                        </li>

                                        <li>
                                            <a href="#"
                                                wire:click="mudarEstadoPC({{ $proposta->id }}, {{ 1 }})"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Aceitar</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                wire:click="mudarEstadoPC({{ $proposta->id }}, {{ 2 }})"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Recusar</a>
                                        </li>
                                    @endif

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
    </div>

    <div class="w-full">
        @isset($propostas)
            {{ $propostas->onEachSide(1)->links() }}
        @endisset
    </div>

    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src={{ asset('js/proposta/pendentes.js') }}></script>
    <script src={{ asset('js/scripts/masks.js') }}></script>
</div>
