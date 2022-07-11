    @if (session('msgErro'))
        <div class="w-full p-3 rounded-lg bg-desicon-red text-desicon-white">
            <p class="msg" style="text-align: center;">{{ session('msgErro') }}</p>
        </div>
    @endif
    @if (session('msg'))
        <div class="w-full p-3 rounded-lg bg-desicon-green text-desicon-white">
            <p class="msg" style="text-align: center;">{{ session('msg') }}</p>
        </div>
    @endif

    <div class="items-center">
        <h2 class="items-center">Descontos</h2>
    </div>

    @can('admin')
        <div class="flex mt-4">
            <div class="flex flex-row">
                <form action="{{ route('descontos.importar') }}" method="POST" class="flex"
                    enctype="multipart/form-data">
                    @csrf
                    <input
                        class="block w-full pr-4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        id="file_input" name="file_input" type="file" required>

                    @error('file_input')
                        <span class="error">{{ $message }}</span>
                    @enderror

                    <button type="submit"
                        class="h-full px-2 ml-2 rounded-lg bg-desicon-blue text-desicon-white">Importar</button>
                </form>

                <form action="{{ route('descontos.exportar') }}" method="GET">
                    @csrf
                    <button type="submit"
                        class="h-full px-2 ml-4 rounded-lg bg-desicon-blue text-desicon-white ">Exportar</button>
                </form>
                <a href="{{ route('descontos.create') }}"
                    class="flex items-center h-full px-2 ml-4 text-center rounded-lg bg-desicon-blue text-desicon-white">Adicionar</a>
            </div>
        </div>
    @endcan

    <form class="mt-2">
        <label for="default-search"
            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Buscar</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="search" id="default-search"
                class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Buscar desconto..." {{-- wire:model='search' --}} required>

            <button type="submit"
                class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
        </div>
    </form>



    <table class="w-full mt-2 text-sm border table-auto border-slate-400 bg-desicon-white">
        <thead class="">
            <tr class="">
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">ID</th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">SKU</th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">Descrição</th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">Descontos</th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300"></th>
            </tr>
        </thead>

        <tbody>
            @isset($descontos)
                @foreach ($descontos as $id => $item)
                    {{-- {{ dd($item->produto) }} --}}

                    <tr class="">
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $item->id }}</td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $item->produto->codigo }}</td>

                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            <p data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Disabled popover"
                                id="popUp">
                                {{ mb_strimwidth($item->produto->descricao, 0, 20, '...') }}
                            </p>
                        </td>
                        <td class="text-gray-600 border font-extralight border-slate-300">
                            <div class="grid grid-cols-5">
                                <div class="flex flex-col px-2 text-center truncate ">
                                    @isset($item->quantidade0)
                                        <p>{{ $item->quantidade0 }}</p>
                                        <p>{{ $item->porcentagem0 }}%</p>
                                    @endisset
                                </div>
                                <div class="flex flex-col px-2 text-center truncate">
                                    @isset($item->quantidade1)
                                        <p>{{ $item->quantidade1 }}</p>
                                        <p>{{ $item->porcentagem1 }}%</p>
                                    @endisset
                                </div>
                                <div class="flex flex-col px-2 text-center truncate">
                                    @isset($item->quantidade2)
                                        <p>{{ $item->quantidade2 }}</p>
                                        <p>{{ $item->porcentagem2 }}%</p>
                                    @endisset
                                </div>
                                <div class="flex flex-col px-2 text-center truncate">
                                    @isset($item->quantidade3)
                                        <p>{{ $item->quantidade3 }}</p>
                                        <p>{{ $item->porcentagem3 }}%</p>
                                    @endisset
                                </div>
                                <div class="flex flex-col px-2 text-center truncate">
                                    @isset($item->quantidade4)
                                        <p>{{ $item->quantidade4 }}</p>
                                        <p>{{ $item->porcentagem4 }}%</p>
                                    @endisset
                                </div>
                            </div>
                        </td>

                        <td class="justify-center px-2 py-1 font-light text-gray-600 border border-slate-300">
                            <div class="flex justify-center">
                                <a href="{{ route('descontos.update', $item->id) }}"
                                    class="duration-100 hover:opacity-50" id='adicionarDesconto'>
                                    <x-feathericon-edit class="w-5 h-5" />
                                </a>

                                <form action="{{ route('descontos.destroy', $item->id) }}" method="POST" class="ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="duration-100 hover:opacity-50">
                                        <x-heroicon-o-trash class="w-5 h-5" />
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
    <div class="w-full">
        @isset($descontos)
            {{ $descontos->onEachSide(1)->links() }}
        @endisset
    </div>
