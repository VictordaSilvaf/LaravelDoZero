<div>
    {{-- Buscar produto --}}
    <form action="" method="POST" class="grid px-5 mt-4" wire:submit.prevent='search'>
        @csrf
        <div class="flex gap-2">
            <div class="w-full pc--sessaoInput">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="identificacaoProduto">
                    Identificação do produto
                </label>

                <input
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                    type="text" name="identificacaoProduto" id="identificacaoProduto"
                    placeholder="Digite o SKU do produto" wire:model='identificacaoProduto' required />

            </div>

            <div class="w-full pc--sessaoInput">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="">Quantidade</label>
                <input
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                    min="1" type="number" name="quantidadeProduto" id="quantidadeProduto"
                    placeholder="Quant. do produto" wire:model='quantidadeProduto' required>
            </div>
        </div>
        <button type="submit"
            class="px-4 py-2 mb-3 font-light text-white duration-150 bg-blue-500 rounded hover:bg-blue-700"
            id="btnBuscarProduto" onclick="">Buscar</button>
        @error('buscaProduto')
            <div class="" style="color: red; text-align: left; opacity: .65;">
                <span class="error">{{ $message }}</span>
            </div>
        @enderror

        {{-- Tabela de produtos --}}
        <section class="">
            @if ($produtos)
                <table id="tableProdID" class="w-full my-3 table-auto">
                    <thead class="font-thin bg-gray-700 text-desicon-white">
                        <tr class="font-thin text-center">
                            <th class="px-2 py-2 font-light truncate">SKU</th>
                            <th class="px-2 py-2 font-light truncate">Nome do Produto</th>
                            <th class="px-2 py-2 font-light truncate">Quant.</th>
                            <th class="px-2 py-2 font-light truncate">Valor UN</th>
                            <th class="px-2 py-2 font-light truncate">Total</th>
                            <th class="px-2 py-2 font-light truncate"></th>
                        </tr>
                    </thead>
                    <tbody id="" class="bg-desicon-white">
                        @if ($produtos)
                            @foreach ($produtos as $produto)
                                <tr class="">
                                    <td class="p-2">
                                        {{ $produto[0]->codigo ?? '' }}
                                    </td>
                                    <td class="p-0.5 text-center">
                                        {{ mb_strimwidth($produto[0]->descricao, 0, 64, '...') }}
                                    </td>
                                    <td class="p-2 text-center truncate">
                                        {{ $produto[1] }} un
                                    </td>
                                    <td class="p-2 text-center truncate">R$
                                        {{ number_format($produto[0]->preco, 2, ',', '.') }}
                                    </td>
                                    <td class="p-2 text-center truncate">
                                        aaaaa
                                    </td>
                                    <td class="p-2 text-center">
                                        <a href="#" class="">
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
