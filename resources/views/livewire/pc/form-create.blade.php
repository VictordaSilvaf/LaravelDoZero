<form action={{ route('proposta.create') }} method="POST" wire:submit.prevent='submit'>
    @csrf
    <section class="w-full px-5 py-2 pc--dados">
        <div class="grid pc--dadosLinha">
            <div class="pc--sessaoInput">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="clienteTransportadora">Nome da transportadora</label>
                <select
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                    id="clienteTransportadora" name="clienteTransportadora" wire:model='clienteTransportadora' required>
                    <option selected value="">Nome da transportadora...</option>
                    <option value='MANDAÊ SERVIÇOS DE CONSULTORIA EM LOGÍSTICA S/A'>
                        MANDAÊ SERVIÇOS DE CONSULTORIA EM
                        LOGÍSTICA S/A
                    </option>
                    <option value="SEDEX - EXPRESSO CORREIOS">SEDEX - EXPRESSO CORREIOS</option>
                    <option value="PAC - ECONÔMICO CORREIOS">PAC - ECONÔMICO CORREIOS</option>
                    <option value="JONAS VIEIRA">JONAS VIEIRA</option>
                    <option value="PEX">PEX</option>
                    <option value="RETIRAR">RETIRAR</option>
                    <option value="OUTROS">OUTROS</option>
                </select>
            </div>
            <div class="pc--sessaoInput pc--sessaoInput1">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="clienteEnvio">Modo
                    de
                    envio</label>
                <select
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                    id="clienteEnvio" name="clienteEnvio" wire:model='clienteEnvio' required>
                    <option selected value="">Modo de envio...</option>
                    <option value="R">Contratação do Frete por conta do Remetente (CIF)</option>
                    <option value="D">Contratação do Frete por conta do Destinatário (FOB)</option>
                    <option value="T">Contratação do Frete por conta de Terceiros</option>
                    <option value="3">Transporte Próprio por conta do Remetente</option>
                    <option value="4">Transporte Próprio por conta do Destinatário</option>
                    <option value="S">Sem Ocorrência de Transporte</option>
                </select>
            </div>
        </div>

        <div class="grid pc--dadosLinha">
            <div class="pc--sessaoInput pc--sessaoInput1">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="pesoTotal">Peso
                    do Produto</label>
                <input
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                    type="number" name="pesoTotal" id="pesoTotal" placeholder="Peso" wire:model='pesoTotal' required
                    disabled value="">
            </div>

            <div class="pc--sessaoInput pc--sessaoInput1">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="totalFrete">Frete</label>
                <input
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                    type="text" name="totalFrete" id="totalFrete" placeholder="Frete" wire:model='totalFrete'
                    required>
            </div>

        </div>
    </section>

    {{-- Dados transportadora --}}
    <div class="grid px-5 text-right" id="dadosPagamento">
        <h3>Dados de Pagamento</h3>
    </div>

    <section class="w-full px-5 pc--dados">

        <div class="pc--dadosLinha">
            {{-- Porcentagem de desconto --}}
            <div class="pc--sessaoInput">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="descontoVendedor">Desconto</label>
                <input
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                    wire:model='descontoVendedor' type="number" name="descontoVendedor" id="descontoVendedor"
                    placeholder="Desconto do vendedor" max="15">
            </div>

            {{-- Parcelas pagamento --}}
            <div class="pc--sessaoInput">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="selecaoParcelas">Parcelas</label>

                <select
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                    @if ($this->podeParcelar != true && $this->selecaoParcelas > 0) disabled @endif id="selecaoParcelas" name="selecaoParcelas"
                    wire:model.debounce='selecaoParcelas' required>

                    <option selected>{{ $selecaoParcelas }}</option>

                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" wire:click="definirParcela({{ $i }})">
                            {{ $i }}</option>
                    @endfor

                </select>
            </div>
        </div>

        <table class="w-full">
            @if ($this->selecaoParcelas > 0 && $this->selecaoParcelas <= 12)
                @for ($c = 0; $c < $this->selecaoParcelas; $c++)
                    <div class="grid grid-cols-4 gap-2 truncate">
                        <div class="truncate">
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                                wire:model={{ 'parcelaDia' . $c }} type="number" name={{ 'parcelaDia' . $c }}
                                id={{ 'parcelaDia' . $c }} placeholder="Dias" required>
                        </div>
                        <div class="truncate">
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                                wire:model={{ 'parcelaValor' . $c }} type="text" name={{ 'parcelaValor' . $c }}
                                id={{ 'parcelaValor' . $c }}
                                placeholder="{{ number_format($valorParcelas[$c], 2, '.', '') }}"
                                value="{{ number_format($valorParcelas[$c], 2, '.', '') }}"
                                @if ($c != 0 || $selecaoParcelas == 1) disabled @endif>
                        </div>
                        <div class="truncate">
                            <select
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                                id={{ 'parcelaFormaPagamento' . $c }} name="{{ 'parcelaFormaPagamento' . $c }}"
                                wire:model={{ 'parcelaFormaPagamento' . $c }} class="formaPagamento"
                                wire:change='mudarFormaPagamento'>
                                <option selected class="text-gray-500" value="">Forma de pag...</option>
                                @foreach ($this->formaPagamento as $pagamento)
                                    <option value="{{ $pagamento->id_bling }}">{{ $pagamento->descricao }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="truncate">
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                                wire:model={{ 'parcelaDescricao' . $c }} type="text"
                                name={{ 'parcelaDescricao' . $c }} id={{ 'parcelaDescricao' . $c }}
                                placeholder="Descrição parcela">
                        </div>
                    </div>
                @endfor
            @endif
        </table>


        <div class="pc--sessaoInput w-100 ">
            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                for="observacaoVendedor ml-2">Observação</label>
            <input
                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded appearance-none bg-desicon-white focus:outline-none focus:bg-white"
                type="text" name="observacaoVendedor" id="observacaoVendedor"
                placeholder="Adicione alguma observação se necessário." wire:model='observacaoVendedor'>
        </div>

        <div class="px-3 py-2 border border-gray-500 rounded bg-desicon-white">
            <h2 class="text-center">Dados proposta</h2>
            <div class="flex justify-between gap-4 px-5 mt-2 text-center font-extralight">
                <div>
                    <p class="truncate">Total Bruto</p>
                    <p class="truncate">
                        R$ {{ number_format($this->calcTotalSemDesconto($produtos), 2, '.', '') }}
                    </p>
                </div>

                <div>
                    <p class="truncate">Desc. Vend.</p>
                    <p class="truncate">
                        {{ $this->descontoVendedor == null ? 0 : $this->descontoVendedor }}%
                    </p>
                </div>

                <div>
                    <p class="truncate">Frete</p>
                    <p class="truncate">R$ {{ $this->totalFrete }}</p>
                </div>

                <div>
                    <p class="truncate">Desc. Pagm.</p>
                    <p class="truncate">{{ $this->mudarFormaPagamento() }}%</p>
                </div>

                <div>
                    <p class="truncate">Total</p>
                    <p class="truncate">
                        {{ number_format($this->calcTotal($produtos, $this->descontoVendedor), 2, ',', '.') }}</p>
                </div>


            </div>
        </div>
    </section>

    @if ($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif

    {{-- BTN cadastrar proposta --}}
    <section class="grid w-full px-5 py-3 pc--dados">
        <button type="submit"
            class="px-4 py-2 font-light text-white duration-150 bg-blue-700 rounded hover:bg-blue-500 @error('title') is-invalid @enderror"
            id="enviardados">Cadastrar proposta</button>
    </section>
</form>
