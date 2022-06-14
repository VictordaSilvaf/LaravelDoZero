@extends('.livewire.layouts.dashboard-layout')
@section('content')

    <h1 class="text-lg font-light">Propostas {{ $status }}</h1>

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
                    data
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
                            {{ $proposta->users->name }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 truncate border border-slate-300">
                            {{ $proposta->clientes->cnpj }}
                        </td>
                        <td class="px-2 py-1 font-light text-center text-gray-600 border border-slate-300">
                            {{ $proposta->total }}
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
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Email</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">PDF</a>
                                </li>
                            </ul>
                        </div>
                    </tr>
                @endforeach
            @endisset

        </tbody>
    </table>

    <div class="flex items-center justify-center mt-4">
        {{ $propostas->appends(['stats' => $status])->onEachSide(1)->links() }}
    </div>

    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src={{ asset('js/proposta/pendentes.js') }}></script>
    <script src={{ asset('js/scripts/masks.js') }}></script>
@endsection
