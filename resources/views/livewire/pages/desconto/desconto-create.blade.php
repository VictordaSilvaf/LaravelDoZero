@extends('.livewire.layouts.dashboard-layout')
@section('content')
    <div class="">

        <div class="">
            <div class="">
                <div class="font-light text-lg mb-2">
                    <h2>
                        @if (isset($item))
                            Editar
                        @else
                            Cadastrar
                        @endif desconto
                    </h2>
                </div>
                <form action={{ route('descontos.store') }} method="POST" wire:submit.prevent='submit'
                    class="">
                    @csrf
                    <div class="font-extralight">
                        <div class="">
                            <label class="" for="identificacaoProduto">Nome ou SKU do produto</label>
                            <input type="text" id="identificacaoProduto" name="identificacaoProduto"
                                class="w-full rounded-lg" placeholder="Buscar produto"
                                @if (isset($item)) value="{{ $item->sku_produto }}" @endif
                                wire:model='identificacaoProduto' />
                        </div>
                    </div>
                    <button id="addCampo" class="rounded-lg bg-desicon-green p-2 text-desicon-white w-full my-2">Buscar
                        produto</button>

                    <div class="font-extralight grid grid-cols-2 gap-2">
                        <div class="">
                            <label class="" for="quantidadeProduto">Quantidade para desconto</label>
                        </div>

                        <div class="">
                            <label class="" for="porcentagemDesconto">Porcentagem de desconto(%)</label>
                        </div>
                    </div>

                    @for ($item = 0; $item < $this->quantidadeParcelas; $item++)
                        {{-- Campos parcela --}}
                        <div class="font-extralight grid grid-cols-2 gap-2 mt-2">
                            <div class="">
                                <input type="number" id={{ 'quantidadeProduto' . $item }}
                                    name={{ 'quantidadeProduto' . $item }} class="w-full rounded-lg"
                                    @if (isset($item)) placeholder="Quantidade" @endif
                                    wire:model={{ 'quantidadeProduto' . $item }} />
                            </div>

                            <div class="">
                                <input type="number" id={{ 'porcentagemDesconto' . $item }}
                                    name={{ 'porcentagemDesconto' . $item }} class="w-full rounded-lg"
                                    @if (isset($item)) placeholder="Porcentagem" @endif
                                    wire:model={{ 'porcentagemProduto' . $item }} />
                            </div>
                        </div>
                    @endfor

                    <div class=''>
                        <button type="submit" class="rounded-lg bg-desicon-blue p-2 text-desicon-white w-full my-2"
                            id="btnSalvar">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
