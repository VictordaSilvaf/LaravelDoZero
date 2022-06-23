@extends('.livewire.layouts.dashboard-layout')
@section('content')
    <div class="">
        {{-- {{ dd($produtos) }} --}}
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
                        <input type="text" id="identificacaoProduto" name="identificacaoProduto" class="w-full rounded-lg"
                            placeholder="Buscar produto" wire:model='identificacaoProduto' 
                            @isset($busca) value="{{  $busca }}" @endisset @if (isset($identificacaoProduto))
                                value="{{ $produto->codigo }}"
                            @endif />
                    </div>
                    <div class="w-full text-center text-red-600 font-extralight">
                        <span>{{ isset($erro) ? $erro : "" }}</span>
                    </div>
                    
                    @if (isset($produtos))
                        <div class="w-full border rounded-lg shadow-md bg-desicon-white">
                            <td>
                                @foreach ($produtos as $item)
                                    <a href="{{ route('descontos.create', ['identificacaoProduto' => $item->codigo]) }}" class="">
                                        <li class="grid grid-cols-4 gap-4 py-0.5 bg-desicon-white hover:opacity-60 hover:text-desicon-blue">
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
           
            @if (isset($produto)) 
                <form action={{ route('descontos.update2', ['id' => $desconto->id]) }} method="POST" wire:submit.prevent='submit' class="" >
            @else
                <form action={{ route('descontos.store') }} method="POST" wire:submit.prevent='submit' class="" >
            @endif

            @if (!isset($produto)) 
            hidden
            @endif
            
                @csrf
                <input type="text" wire:model='identificacaoProduto' id="identificacaoProduto" name="identificacaoProduto" hidden value='{{ isset($produto->codigo ) ? $produto->codigo : "" }}'>
                <div class="grid grid-cols-2 gap-2 font-extralight">
                    <div class="">
                        <label class="" for="quantidade">Quantidade para desconto</label>
                    </div>

                    <div class="">
                        <label class="" for="porcentagem">Porcentagem de desconto(%)</label>
                    </div>
                </div>

                {{-- Campos parcela --}}
                @for ($item = 0; $item < $this->quantidadeParcelas; $item++)
                    <div class="grid grid-cols-2 gap-2 mt-2 font-extralight">
                        <div class="">
                            <input type="number" id={{ 'quantidadeProduto' . $item }}
                                name={{ 'quantidadeProduto' . $item }} class="w-full rounded-lg"
                                @if (isset($item)) placeholder="Quantidade" @endif
                                wire:model={{ 'quantidadeProduto' . $item }}
                                @if ($item == 0) required @endif value=
                                "{{ isset($desconto) ? $desconto->dados[0]['quantidade'.$item] : '' }}"
                                />
                        </div>

                        <div class="">
                            <input type="number" id={{ 'porcentagemDesconto' . $item }}
                                name={{ 'porcentagemDesconto' . $item }} class="w-full rounded-lg"
                                @if (isset($item)) placeholder="Porcentagem" @endif
                                wire:model={{ 'porcentagemProduto' . $item }}
                                @if (isset($item)) placeholder="Quantidade" @endif
                                wire:model={{ 'quantidadeProduto' . $item }}
                                @if ($item == 0) required @endif
                                value=
                                "{{ isset($desconto) ? $desconto->dados[0]['porcentagem'.$item] : '' }}"
                                />
                        </div>
                    </div>
                @endfor

                <div class=''>
                    <button type="submit" class="w-full p-2 my-2 rounded-lg bg-desicon-blue text-desicon-white"
                        id="btnSalvar">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
