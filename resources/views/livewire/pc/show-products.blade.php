<div>
    {{-- Buscar produto --}}
    <form action="" method="POST" class="grid px-5 mt-4" wire:submit.prevent='search'>
        @csrf
        <div class="grid grid-cols-5 gap-2">
            <div class="w-full col-span-4 pc--sessaoInput">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="identificacaoProduto">
                    Identificação do produto
                </label>

                <input
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                    type="text" name="identificacaoProduto" id="identificacaoProduto"
                    placeholder="Digite o SKU do produto" wire:model='identificacaoProduto' required />
                @error('identificacaoProduto')
                    <span class="error">{{ $message }}</span>
                @enderror

            </div>

            <div class="w-full pc--sessaoInput">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="">Quantidade</label>
                <input
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                    min="1" type="number" name="quantidadeProduto" id="quantidadeProduto" placeholder="Nº"
                    wire:model='quantidadeProduto' required>
                @error('quantidadeProduto')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        @error('buscaProduto')
            <div class="mb-3" style="color: red; text-align: left; opacity: .65;">
                <span class="error">{{ $message }}</span>
            </div>
        @enderror
        <button type="submit"
            class="px-4 py-2 mb-3 font-light text-white duration-150 bg-blue-500 rounded hover:bg-blue-700"
            id="btnBuscarProduto">Buscar</button>


        {{-- Tabela de produtos --}}
        <section class="max-w-full overflow-x-scroll">
            @if ($produtos)
                <table id="tableProdID" class="w-full max-w-full my-3 table-auto">
                    <thead class="font-thin bg-gray-700 text-desicon-white">
                        <tr class="font-thin text-center">
                            <th class="px-2 py-2 font-light truncate">SKU</th>
                            <th class="px-2 py-2 font-light truncate">Nome do Produto</th>
                            <th class="px-2 py-2 font-light truncate">Quant.</th>
                            <th class="px-2 py-2 font-light truncate">Valor UN</th>
                            <th class="px-2 py-2 font-light truncate">Difal</th>
                            <th class="px-2 py-2 font-light truncate">D. Esc.</th>
                            <th class="px-2 py-2 font-light truncate">Total</th>
                            <th class="px-2 py-2 font-light truncate"></th>
                        </tr>
                    </thead>
                    <tbody id="" class="bg-desicon-white">
                        @if ($produtos)
                            @foreach ($produtos as $id => $produto)
                                <tr class="">
                                    <td class="p-2 border">
                                        {{ $produto[0]->codigo ?? '' }}
                                    </td>
                                    <td class="p-0.5 text-center border">
                                        {{ mb_strimwidth($produto[0]->descricao, 0, 30, '...') }}
                                    </td>
                                    <td class="p-2 text-center truncate border">
                                        {{ $produto[1] }} un
                                    </td>
                                    <td class="p-2 text-center truncate border">R$
                                        {{ number_format($produto[0]->preco, 2, ',', '.') }}
                                    </td>
                                    <td class="p-2 text-center truncate border">
                                        {{-- Porcentagem desconto vendedor --}}
                                        <div class="flex flex-col">
                                            <span>{{ $produto[2] . '%' }}</span>
                                        </div>
                                    </td>
                                    <td class="p-2 text-center truncate border">
                                        {{-- Total desconto escalonado --}}
                                        <div class="flex flex-col">
                                            <p>R$ {{ number_format($produto[3][0], 2, ',', '.') }}</p>
                                            <span>{{ number_format($produto[3][1], 2, '.') }}%</span>
                                        </div>
                                    </td>
                                    <td class="p-2 text-center truncate border">
                                        <p>R$ {{ number_format(($produto[3][0] - (($produto[3][0] * $produto[2]) / 100)) *  $produto[1], 2, ',', '.') }}</p>
                                    </td>
                                    <td class="p-2 text-center border"
                                        wire:click="removerProdutoLista({{ $id }})">
                                        <a href="#" class="" x- id={{ 'listaProduto' . $id }}>
                                            <x-heroicon-s-trash
                                                class="w-6 h-6 text-red-600 duration-100 opacity-75 hover:opacity-95" />
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            @endif
        </section>
    </form>

</div>
