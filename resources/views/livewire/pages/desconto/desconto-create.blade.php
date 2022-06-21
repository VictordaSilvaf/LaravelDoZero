@extends('.livewire.layouts.dashboard-layout')
@section('content')
    <div class="">

        <div class="">
            <div class="">
                <div class="mb-2 text-lg font-light">
                    <h2>
                        @if (isset($item))
                            Editar
                        @else
                            Cadastrar
                        @endif desconto
                    </h2>
                </div>

                <div class="font-extralight">
                    <div class="">
                        <label class="" for="identificacaoProduto">Nome ou SKU do produto</label>
                        <input type="text" id="identificacaoProduto" name="identificacaoProduto"
                            class="w-full rounded-lg" placeholder="Buscar produto"
                            @if (isset($item)) value="{{ $item->sku_produto }}" @endif
                            wire:model='identificacaoProduto' />
                    </div>
                </div>
                
                <button wire:click='buscarProduto' class="w-full p-2 my-2 rounded-lg bg-desicon-green text-desicon-white" >Buscar
                    produto</button>
                
                <form action={{ route('descontos.store') }} method="POST" wire:submit.prevent='submit'
                    class="">
                    @csrf
                    

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
                                    @if ($item == 0)
                                        required
                                    @endif
                                    />
                            </div>

                            <div class="">
                                <input type="number" id={{ 'porcentagemDesconto' . $item }}
                                    name={{ 'porcentagemDesconto' . $item }} class="w-full rounded-lg"
                                    @if (isset($item)) placeholder="Porcentagem" @endif
                                    wire:model={{ 'porcentagemProduto' . $item }} 
                                    @if (isset($item)) placeholder="Quantidade" @endif
                                    wire:model={{ 'quantidadeProduto' . $item }} 
                                    @if ($item == 0)
                                        required
                                    @endif
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
    </div>
@endsection
