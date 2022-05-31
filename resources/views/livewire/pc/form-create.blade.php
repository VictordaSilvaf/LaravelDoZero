<form action={{ route('proposta.create') }} method="POST" wire:submit.prevent='submit'>
    @csrf
    <section class="w-full px-5 py-2 pc--dados">
        <div class="grid pc--dadosLinha">
            <div class="pc--sessaoInput">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="clienteTransportadora">Nome da transportadora</label>
                <select
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
                    id="clienteTransportadora" name="clienteTransportadora" wire:model='clienteTransportadora' required>
                    <option selected>Nome da transportadora...</option>
                    <option value="JADLOG.COM">JADLOG.COM</option>
                    <option value="JADLOG.PACKAGE">JADLOG.PACKAGE</option>
                    <option value="SEDEX - EXPRESSO CORREIOS">SEDEX - EXPRESSO CORREIOS</option>
                    <option value="PAC - ECONÔMICO CORREIOS">PAC - ECONÔMICO CORREIOS</option>
                    <option value="JONAS VIEIRA">JONAS VIEIRA</option>
                    <option value="PEX">PEX</option>
                    <option value="RETIRAR">RETIRAR</option>
                    <option value="OUTROS">OUTROS</option>
                </select>
            </div>
            <div class="pc--sessaoInput pc--sessaoInput1">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="clienteEnvio">Modo
                    de
                    envio</label>
                <select
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
                    id="clienteEnvio" name="clienteEnvio" wire:model='clienteEnvio' required>
                    <option selected>Modo de envio...</option>
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
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
                    type="number" name="pesoTotal" id="pesoTotal" placeholder="Peso" wire:model='pesoTotal' required>
            </div>

            <div class="pc--sessaoInput pc--sessaoInput1">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="clienteFrete">Frete</label>
                <input
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
                    type="text" name="clienteFrete" id="clienteFrete" placeholder="Frete"
                    onchange="this.value = this.value.replace(/,/g, '.')" wire:model='clienteFrete' required>
            </div>

        </div>
    </section>

    {{-- Dados transportadora --}}
    <div class="grid px-5 text-right" id="dadosPagamento">
        <h3>Dados de Pagamento</h3>
    </div>

    <section class="w-full px-5 pc--dados">

        {{-- Modo de Pagamento --}}
        <livewire:pc.components.select-payments />

        <div class="pc--dadosLinha">
            {{-- Porcentagem de desconto --}}
            <div class="pc--sessaoInput">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="descontoVendedor">Desconto</label>
                <input
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
                    wire:model='descontoVendedor' type="number" name="descontoVendedor" id="descontoVendedor"
                    placeholder="Desconto do vendedor" max="15">
            </div>

            {{-- Parcelas pagamento --}}
            <div class="pc--sessaoInput">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="selecaoParcelas">Parcelas</label>
                <input
                    class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
                    wire:model='selecaoParcelas' type="number" min="1" max="12" name="selecaoParcelas"
                    id="selecaoParcelas" placeholder="Quantidade de parcelas (padrão 1)" required>

            </div>
        </div>

        <table class="w-full">
            @if ($this->selecaoParcelas > 0 && $this->selecaoParcelas <= 12)
                @for ($c = 0; $c < $this->selecaoParcelas; $c++)
                    <div class="flex flex-row justify-between">
                        <div class="p-1 ">
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
                                wire:model={{ 'parcelaDia' . $c }} type="number" name={{ 'parcelaDia' . $c }}
                                id={{ 'parcelaDia' . $c }} placeholder="Dias" required>
                        </div>

                        <div class="p-1">
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
                                wire:model={{ 'parcelaValor' . $c }} type="number" name={{ 'parcelaValor' . $c }}
                                id={{ 'parcelaValor' . $c }} placeholder="Valor da parcela" required>
                        </div>
                        <div class="p-1">
                            <select
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
                                id={{ 'parcelaFormaPagamento' . $c }}name="{{ 'parcelaFormaPagamento' . $c }}"
                                wire:model={{ 'parcelaFormaPagamento' . $c }} class="formaPagamento">
                                <option selected>Forma de pagamento</option>
                                @foreach ($this->formaPagamento as $pagamento)
                                    <option value="{{ $pagamento->id_bling }}">{{ $pagamento->descricao }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="p-1">
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
                                wire:model={{ 'parcelaDescricao' . $c }} type="text"
                                name={{ 'parcelaDescricao' . $c }} id={{ 'parcelaDescricao' . $c }}
                                placeholder="Descrição parcela" required>
                        </div>
                    </div>
                @endfor
            @endif
        </table>

        <div class="pc--sessaoInput">
            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                for="clienteConsumoRevenda">Tipo do
                pedido: </label>
            <select id="clienteConsumoRevenda" name="clienteConsumoRevenda"
                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
                wire:model='clienteConsumoRevenda'>
                <option id="inpConsumo" value="consumo" selected>
                    Consumo
                </option>
                <option id="inpRevenda" value="revenda">Revenda</option>
            </select>
        </div>

        <div class="pc--sessaoInput w-100 ">
            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                for="clienteFrete ml-2">Observação</label>
            <input
                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
                type="text" name="observacaoVendedor" id="observacaoVendedor"
                placeholder="Adicione alguma observação se necessário." wire:model='observacaoVendedor'>
        </div>

    </section>

    {{-- BTN cadastrar proposta --}}
    <section class="grid w-full px-5 py-3 pc--dados">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-light py-2 px-4 rounded duration-150"
            id="enviardados">Cadastrar Proposta</button>
    </section>
</form>