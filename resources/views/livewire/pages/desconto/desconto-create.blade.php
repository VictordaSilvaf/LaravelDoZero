    <div class="">
        <div class="">
            <div class="mb-2 text-lg font-light">
                <h2>
                    {{ isset($produto) ? 'Editar' : 'Cadastrar' }} desconto
                </h2>
            </div>

            <div>
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
            </div>

            <form wire:submit.prevent="buscarProduto" class="font-extralight">
                <div class="">
                    <label class="" for="identificacaoProduto">Nome ou SKU do produto</label>
                    <input type="text" id="identificacaoProduto" name="identificacaoProduto"
                        class="w-full rounded-lg" placeholder="Buscar produto" wire:model='identificacaoProduto'
                        @isset($busca) value="{{ $busca }}" @endisset
                        @if (isset($produto)) value="{{ $produto->codigo }}" @endif />
                </div>
                <div class="w-full text-center text-red-600 font-extralight">
                    <span>{{ isset($erro) ? $erro : '' }}</span>
                </div>

                @if (isset($produtos))
                    <div class="w-full border rounded-lg shadow-md bg-desicon-white">
                        <td>
                            @foreach ($produtos as $item)
                                <a href="{{ route('descontos.create', ['identificacaoProduto' => $item->codigo]) }}"
                                    class="">
                                    <li
                                        class="grid grid-cols-4 gap-4 py-0.5 bg-desicon-white hover:opacity-60 hover:text-desicon-blue">
                                        <div class="text-center">{{ $item->codigo }}</div>
                                        <div class="col-span-3 text-center">{{ $item->descricao }}</div>
                                    </li>
                                </a>
                            @endforeach
                        </td>
                    </div>
                @endif

                <button class="w-full p-2 my-2 rounded-lg bg-desicon-green text-desicon-white" type="submit">
                    Buscar produto
                </button>
            </form>
        </div>

        @if (isset($desconto))
            <form method="POST" wire:submit.prevent='store' class="@if (!isset($produto)) hidden @endif">
            @else
                <form wire:submit.prevent='store' class="@if (!isset($produto)) hidden @endif">
        @endif
        @csrf
        <input type="text" wire:model='identificacaoProduto' id="identificacaoProduto" name="identificacaoProduto"
            hidden value='{{ isset($produto->codigo) ? $produto->codigo : '' }}'>
        <div class="grid grid-cols-2 gap-2 font-extralight">
            <div class="">
                <label class="" for="quantidade">Quantidade para desconto</label>
            </div>

            <div class="">
                <label class="" for="porcentagem">Porcentagem de desconto(%)</label>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2 mt-2 font-extralight">
            <div class="">
                <input type="number" id='quantidadeProduto0' name='quantidadeProduto0' class="w-full rounded-lg"
                    placeholder="Quantidade" wire:model='quantidadeProduto0'
                    placeholder="{{ isset($desconto) ? $desconto->quantidade0 : '0' }}"
                    value="{{ isset($desconto) ? $desconto->quantidade0 : '' }}" />
            </div>

            <div class="">
                <input type="number" id='porcentagemDesconto0' name='porcentagemDesconto0' class="w-full rounded-lg"
                    placeholder="Porcentagem" wire:model='porcentagemDesconto0'
                    value="{{ isset($desconto) ? $desconto->porcentagem0 : '' }}" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2 mt-2 font-extralight">
            <div class="">
                <input type="number" id='quantidadeProduto1' name='quantidadeProduto1' class="w-full rounded-lg"
                    placeholder="Quantidade" wire:model='quantidadeProduto1'
                    value="{{ isset($desconto) ? $desconto->quantidade1 : '' }}" />
            </div>

            <div class="">
                <input type="number" id='porcentagemDesconto1' name='porcentagemDesconto1' class="w-full rounded-lg"
                    placeholder="Porcentagem" wire:model='porcentagemDesconto1'
                    value="{{ isset($desconto) ? $desconto->porcentagem1 : '' }}" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2 mt-2 font-extralight">
            <div class="">
                <input type="number" id='quantidadeProduto2' name='quantidadeProduto2' class="w-full rounded-lg"
                    placeholder="Quantidade" wire:model='quantidadeProduto2'
                    value="{{ isset($desconto) ? $desconto->quantidade2 : '' }}" />
            </div>

            <div class="">
                <input type="number" id='porcentagemDesconto2' name='porcentagemDesconto2' class="w-full rounded-lg"
                    placeholder="Porcentagem" wire:model='porcentagemDesconto2'
                    value="{{ isset($desconto) ? $desconto->porcentagem2 : '' }}" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2 mt-2 font-extralight">
            <div class="">
                <input type="number" id='quantidadeProduto3' name='quantidadeProduto3' class="w-full rounded-lg"
                    placeholder="Quantidade" wire:model='quantidadeProduto3'
                    value="{{ isset($desconto) ? $desconto->quantidade3 : '' }}" />
            </div>

            <div class="">
                <input type="number" id='porcentagemDesconto3' name='porcentagemDesconto3'
                    class="w-full rounded-lg" placeholder="Porcentagem" wire:model='porcentagemDesconto3'
                    value="{{ isset($desconto) ? $desconto->porcentagem3 : '' }}" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2 mt-2 font-extralight">
            <div class="">
                <input type="number" id='quantidadeProduto4' name='quantidadeProduto4' class="w-full rounded-lg"
                    placeholder="Quantidade" wire:model='quantidadeProduto4'
                    value="{{ isset($desconto) ? $desconto->quantidade4 : '' }}" />
            </div>

            <div class="">
                <input type="number" id='porcentagemDesconto4' name='porcentagemDesconto4'
                    class="w-full rounded-lg" placeholder="Porcentagem" wire:model='porcentagemDesconto4'
                    value="{{ isset($desconto) ? $desconto->porcentagem4 : '' }}" />
            </div>
        </div>

        <div class=''>
            <button type="submit" class="w-full p-2 my-2 rounded-lg bg-desicon-blue text-desicon-white"
                id="btnSalvar">Salvar</button>
        </div>
        </form>
    </div>
