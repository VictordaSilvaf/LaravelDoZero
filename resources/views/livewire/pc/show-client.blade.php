{{-- Sessão busca --}}
<form class="grid px-5 pc--sessaoBusca" action="" method="POST" wire:submit.prevent='search'>
    @csrf
    <div class="pc--sessaoInput">
        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="clientCPF">CPF /
            CNPJ</label>
        <input
            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-desicon-white border rounded appearance-none focus:outline-none"
            type="text" id="clienteCPF" placeholder="CPF ou CNPJ" name="identificacaoCliente"
            wire:model='identificacaoCliente' required />
        @error('identificacaoCliente')
            <div class="" style="color: red; text-align: left; opacity: .65;">
                <span class="error">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <button type="submit"
        class="bg-blue-500 hover:bg-blue-700 text-white font-light py-2 px-4 rounded duration-150 mt-3 mb-3"
        id="btnBuscarCliente">Buscar cliente</button>

    {{-- Sessão dados cliente --}}
    @isset($cliente)
        <section class="w-full py-2 pc--dados">
            <div class="pc--dadosLinha">
                <div class="pc--sessaoInput">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="">Nome</label>
                    <input
                        class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border rounded appearance-none focus:outline-none focus:bg-white"
                        type="text" name="nome" id="nome" placeholder="Nome do cliente"
                        value="{{ $cliente->nome ?? old('clienteTel') }}" disabled />
                    @error('nome')
                        <div class="" style="color: red; text-align: left; opacity: .65;">
                            <span class="error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="pc--sessaoInput">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                        for="">Telefone</label>
                    <input
                        class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border rounded appearance-none focus:outline-none focus:bg-white"
                        type="text" name="clienteTel" id="clienteTel" placeholder="(11) 99999-9999"
                        value="{{ $cliente->fone ?? old('clienteTel') }}" disabled />
                    @error('clienteTel')
                        <div class="" style="color: red; text-align: left; opacity: .65;">
                            <span class="error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>
            <div class="pc--dadosLinha">
                <div class="pc--sessaoInput">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="">Email</label>
                    <input
                        class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border rounded appearance-none focus:outline-none focus:bg-white"
                        type="text" name="clienteEmail" id="clienteEmail" placeholder="EmailCliente@email.com "
                        value="{{ $cliente->email ?? old('clienteEmail') }}" disabled />
                    @error('clienteEmail')
                        <div class="" style="color: red; text-align: left; opacity: .65;">
                            <span class="error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="pc--sessaoInput">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="">CEP</label>
                    <input
                        class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border rounded appearance-none focus:outline-none focus:bg-white"
                        type="text" name="clienteCep" id="clienteCep" placeholder="000.000.000-00"
                        value="{{ $cliente->cep ?? old('clienteCep') }}" disabled />
                    @error('clienteCep')
                        <div class="" style="color: red; text-align: left; opacity: .65;">
                            <span class="error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="grid pc--dadosLinha">
                <div class="pc--sessaoInput">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="">Bairro</label>
                    <input
                        class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border rounded appearance-none focus:outline-none focus:bg-white"
                        type="text" name="clienteBairro" id="clienteBairro" placeholder="Nome do bairro"
                        value="{{ $cliente->bairro ?? old('clienteBairro') }}" disabled />
                    @error('clienteBairro')
                        <div class="" style="color: red; text-align: left; opacity: .65;">
                            <span class="error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="pc--sessaoInput">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="">Rua</label>
                    <input
                        class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border rounded appearance-none focus:outline-none focus:bg-white"
                        type="text" name="clienteRua" id="clienteRua" placeholder="Nome da rua"
                        value="{{ $cliente->endereco ?? old('clienteRua') }}" disabled />
                    @error('clienteRua')
                        <div class="" style="color: red; text-align: left; opacity: .65;">
                            <span class="error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="grid pc--dadosLinha">
                <div class="pc--sessaoInput">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="">Nº</label>
                    <input
                        class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border rounded appearance-none focus:outline-none focus:bg-white"
                        type="text" name="clienteNum" id="clienteNum" placeholder="000"
                        value="{{ $cliente->numero ?? old('clienteNum') }}" disabled>
                    @error('clienteNum')
                        <div class="" style="color: red; text-align: left; opacity: .65;">
                            <span class="error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="pc--sessaoInput">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="">UF</label>
                    <input
                        class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border rounded appearance-none focus:outline-none focus:bg-white"
                        type="text" name="clienteUF" id="clienteUF" placeholder="UF"
                        value="{{ $cliente->uf ?? old('clienteUF') }} " disabled>
                    @error('clienteUF')
                        <div class="" style="color: red; text-align: left; opacity: .65;">
                            <span class="error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="grid pc--dadosLinha">
                <div class="pc--sessaoInput">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                        for="">Contribuinte</label>
                    <input
                        class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border rounded appearance-none focus:outline-none focus:bg-white"
                        type="text" name="clienteContribuinte" id="clienteContribuinte" placeholder="Contribuinte"
                        value="{{ $cliente->contribuinte ?? old('clienteContribuinte') }}" disabled>
                    @error('clienteContribuinte')
                        <div class="" style="color: red; text-align: left; opacity: .65;">
                            <span class="error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="pc--sessaoInput">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="">Cidade</label>
                    <input
                        class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border rounded appearance-none focus:outline-none focus:bg-white"
                        type="text" name="clienteCidade" id="clienteCidade" placeholder="Cidade"
                        value="{{ $cliente->cidade ?? old('clienteCidade') }}" disabled>
                    @error('clienteCidade')
                        <div class="" style="color: red; text-align: left; opacity: .65;">
                            <span class="error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>
        @endisset

    </section>
</form>
