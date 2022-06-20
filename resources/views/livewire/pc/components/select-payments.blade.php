<div class="pc--sessaoInput">
    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="selecaoPagamento">
        Modo de pagamento</label>
    <select
        class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none focus:bg-white"
        id="selecaoPagamento" name="selecaoPagamento" wire:model='identificacaoFormaPagamento' class="formaPagamento"
        wire:change="changePayment">
        <option selected value="">Forma de pagamento</option>
        @foreach ($this->formaPagamento as $pagamento)
            <option value="{{ $pagamento->id }}">{{ $pagamento->descricao }}</option>
        @endforeach
    </select>
</div>
