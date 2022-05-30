<div>
    {{-- Buscar produto --}}
    <form action="" method="POST" class="grid px-5 mt-4 pc--sessaoBusca" wire:submit.prevent='search'>
        @csrf
        <div class="flex gap-2">
            <div class="pc--sessaoInput w-full">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="identificacaoProduto">
                    Identificação do produto
                </label>

                <input
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border  rounded appearance-none focus:outline-none focus:bg-white"
                    type="text" name="identificacaoProduto" id="identificacaoProduto"
                    placeholder="Digite o SKU do produto" wire:model='identificacaoProduto' required />

            </div>

            <div class="pc--sessaoInput w-full">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="">Quantidade</label>
                <input
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border  rounded appearance-none focus:outline-none focus:bg-white"
                    min="1" type="number" name="quantidadeProduto" id="quantidadeProduto"
                    placeholder="Quant. do produto" wire:model='quantidadeProduto' required>
            </div>
        </div>
        <button type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-light py-2 px-4 rounded duration-150 mb-3"
            id="btnBuscarProduto" onclick="">Buscar</button>
        @error('buscaProduto')
            <div class="" style="color: red; text-align: left; opacity: .65;">
                <span class="error">{{ $message }}</span>
            </div>
        @enderror

        {{-- Tabela de produtos --}}
        <section class="">
            @if ($produtos)
                <table id="tableProdID" class="table-auto w-full my-3">
                    <thead class="bg-gray-700 text-desicon-white font-thin">
                        <tr class="font-thin text-center">
                            <th class="font-light py-2">SKU</th>
                            <th class="font-light py-2">Nome do Produto</th>
                            <th class="font-light py-2">Quantidade</th>
                            <th class="font-light py-2">Valor UN</th>
                            <th class="font-light py-2">Desconto</th>
                            <th class="font-light py-2">Desc Esc.</th>
                            <th class="font-light py-2">Desc Pg.</th>
                            <th class="font-light py-2">Total</th>
                            <th class="font-light py-2"></th>
                        </tr>
                    </thead>
                    <tbody id="" class="bg-desicon-white">
                        @if ($produtos)
                            @foreach ($produtos as $produto)
                                <tr class="">
                                    <td class="">
                                        {{ $produto[0]->codigo ?? '' }}
                                    </td>
                                    <td class="">
                                        {{ $produto[0]->descricao ?? '' }}
                                    </td>
                                    <td class="">
                                        {{ $produto[1] }}
                                    </td>
                                    <td class="">Valor UN</td>
                                    <td class="">Desconto</td>
                                    <td class="">Desc Esc.</td>
                                    <td class="">Desc Pg.</td>
                                    <td class="">Valor Total</td>
                                    <td class="">

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
