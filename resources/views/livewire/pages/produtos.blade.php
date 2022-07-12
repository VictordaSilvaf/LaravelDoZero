    {{-- Mesagens de erro --}}
    @if (session('msgErro'))
        <div class="w-full p-2 mb-2 bg-red-600 rounded-lg text-desicon-white">
            <p class="msg" style="text-align: center;">{{ session('msgErro') }}</p>
        </div>
    @endif
    @if (session('msg'))
        <div class="w-full p-2 mb-2 rounded-lg bg-desicon-green text-desicon-white">
            <p class="msg" style="text-align: center;">{{ session('msg') }}</p>
        </div>
    @endif

    <h1 class="text-lg font-light">Produtos</h1>

    <form method="POST" action="{{ route('dashboard.produtos.adicionar') }}" wire:submit.prevent='adicionarProduto'>
        <label for="skuProduto" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="search" name="skuProduto" id="skuProduto"
                class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Digite o nome ou o SKU do produto..." wire:model='skuProduto'>
            <button type="submit"
                class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="submit">Buscar</button>
        </div>
    </form>

    <table class="w-full mt-2 border table-auto border-slate-400 bg-desicon-white">
        <thead>
            <tr>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    SKU
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Descrição
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Estoque
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Preço
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Desconto
                </th>
            </tr>
        </thead>
        <tbody>
            @isset($produtos)
                @foreach ($produtos as $produto)
                    <tr>
                        <td class="px-2 py-1 font-light text-center text-gray-600 border border-slate-300">
                            {{ mb_strimwidth($produto->codigo, 0, 14, '...') }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300" maxlength="10">
                            {{ mb_strimwidth($produto->descricao, 0, 40, '...') }}
                        </td>
                        <td class="px-2 py-1 font-light text-center text-gray-600 border border-slate-300">
                            {{ $produto->estoqueAtual }}
                        </td>
                        <td class="px-2 py-1 font-light text-center text-gray-600 truncate border border-slate-300">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </td>
                        <td class="font-light text-center text-gray-600 border jstify-center border-slate-300">
                            @isset($produto->desconto)
                                <a href="{{ route('descontos.update', ['id' => $produto->desconto->id]) }}"
                                    class="flex justify-center p-1 duration-100 rounded-lg hover:opacity-50">
                                    <x-tabler-discount-2 h='5' w='5' />
                                </a>
                            @endisset
                        </td>

                    </tr>
                @endforeach
            @endisset

        </tbody>
    </table>
    <div class="w-full">
        @isset($produtos)
            {{ $produtos->onEachSide(1)->links() }}
        @endisset
    </div>
