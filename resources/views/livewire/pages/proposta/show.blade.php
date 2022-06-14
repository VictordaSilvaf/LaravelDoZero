@extends('.livewire.layouts.dashboard-layout')
@section('content')
    <div class="w-full">
        <h2>Visualizar proposta</h2>
    </div>
    <section class="grid grid-cols-3 gap-4 mt-4">
        <div class="bg-desicon-white rounded-lg py-2 px-4 col-span-2">
            <h3 class="font-light">Dados cliente</h3>
            <div class="font-extralight mx-2 mt-2">
                <h4 class="font-light">Identificação:</h4>
                <div class="grid grid-cols-3">
                    <p class="col-span-2">{{ $proposta->clientes->nome }}</p>
                    <p>{{ $proposta->clientes->cnpj }}</p>
                </div>

                <h4 class="font-light mt-2">Email:</h4>
                <p>{{ $proposta->clientes->email }}</p>

                <div class="grid grid-cols-2 mt-1">
                    <div>
                        <h4 class="font-light mt-1">Situação:</h4>
                        <p>{{ $proposta->clientes->situacao }}</p>
                    </div>
                    <div class="">
                        <h4 class="font-light mt-1">Gold:</h4>
                        <p>{{ $proposta->clientes->gold ? 'true' : 'false' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2">
                    <div>
                        <h4 class="font-light mt-1">Contribuente:</h4>
                        <p>{{ $proposta->clientes->contribuinte }}</p>
                    </div>

                    <div>
                        <h4 class="font-light mt-1 truncate">Limite de Crédito:</h4>
                        <p>{{ $proposta->clientes->limiteCredito }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 mt-1">
                    <div>
                        <h4 class="font-light mt-1">Contato:</h4>
                        <p>{{ isset($proposta->clientes->fone) ? $proposta->clientes->fone : $proposta->clientes->celular }}
                        </p>
                    </div>
                    <div>
                        <h4 class="font-light mt-1">Cliente desde:</h4>
                        <p>{{ $proposta->clientes->clienteDesde }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-desicon-white rounded-lg p-2 px-4 text-center">
            <h3 class="font-light mt-2">Dados vendedor</h3>
            <div class="w-full flex justify-center">
                <div class="w-36 h-36 bg-desicon-blue rounded-full mt-3">
                    {{-- FOTO --}}
                </div>
            </div>
            <div class="font-extralight mx-2 text-center mt-2">
                <div class="mt-1 ">
                    <h4 class="font-light">Nome:</h4>
                    <p>{{ $proposta->users->name }}</p>
                </div>

                <div class="mt-1">
                    <h4 class="font-light">Email:</h4>
                    <p>{{ $proposta->users->email }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full rounded-lg bg-desicon-white mt-4 px-4 py-2">
        <h3 class="font-light">Dados da proposta:</h3>
        <div class="ml-1 mt-2">
            <div class="grid grid-cols-4">
                <div class="font-light">
                    <h4>Tipo de venda:</h4>
                    <p class="font-extralight">{{ $proposta->consumo_revenda }}</p>
                </div>

                <div class="font-light mt-1">
                    <h4>Modo de envio:</h4>
                    <p class="font-extralight">{{ $proposta->modo_envio }}</p>
                </div>

                <div class="font-light mt-1">
                    <h4>Observação vendedor:</h4>
                    <p class="font-extralight pr-2 truncate">{{ $proposta->observacaoVendedor }}</p>
                </div>

                <div class="font-light mt-1">
                    <h4>Data da proposta:</h4>
                    <p class="font-extralight">{{ $proposta->created_at }}</p>
                </div>
            </div>

            <div class="grid grid-cols-5 mt-2">
                <div class="font-light mt-1">
                    <h4>Desconto vendedor:</h4>
                    <p class="font-extralight">{{ $proposta->desconto_vendedor }}</p>
                </div>

                <div class="font-light mt-1">
                    <h4>Desconto total:</h4>
                    <p class="font-extralight">{{ $proposta->desconto_total }}</p>
                </div>

                <div class="font-light mt-1">
                    <h4>Total proposta:</h4>
                    <p class="font-extralight">{{ $proposta->total }}</p>
                </div>

                <div class="font-light mt-1">
                    <h4>Frete:</h4>
                    <p class="font-extralight">{{ $proposta->frete }}</p>
                </div>

                <div class="font-light mt-1">
                    <h4>Peso total:</h4>
                    <p class="font-extralight">{{ $proposta->peso_total }}</p>
                </div>
            </div>

            <div class="font-light mt-2">
                <h4>Parcelas:</h4>
                {{-- <p class="font-extralight">{{ $proposta->parcelas }}</p> --}}
            </div>

        </div>
    </section>

    <section class="w-full rounded-lg bg-desicon-white mt-4 px-4 py-2">
        <h3 class="font-light">Produtos:</h3>
        <div class="mt-2">
            <table class="w-full mt-2 border table-auto border-slate-400 bg-desicon-white">
                <thead>
                    <tr>
                        <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                            SKU
                        </th>
                        <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                            Descrição
                        </th>
                        <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                            Quantidade
                        </th>
                        <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                            Estoque
                        </th>
                        <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                            Preço
                        </th>
                        <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                            Desconto
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proposta->produtosProposta as $produto)
                        <tr>
                            <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                                {{ mb_strimwidth($produto->produtos->codigo, 0, 14, '...') }}
                            </td>
                            <td class="px-2 py-1 font-light text-gray-600 border border-slate-300" maxlength="10">
                                {{ mb_strimwidth($produto->produtos->descricao, 0, 35, '...') }}
                            </td>
                            <td class="px-2 py-1 font-light text-gray-600 border border-slate-300 text-center">
                                {{ $produto->quantidade }}
                            </td>
                            <td class="px-2 py-1 font-light text-gray-600 border border-slate-300 text-center">
                                {{ $produto->produtos->estoqueAtual }}
                            </td>
                            <td class="px-2 py-1 font-light text-center text-gray-600 truncate border border-slate-300">
                                R$ {{ number_format($produto->produtos->preco, 2, ',', '.') }}
                            </td>
                            <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                                {{-- @isset(count($produtos->first()->descontos))
                                    <a href="#" class="p-1 rounded-lg bg-desicon-blue">
                                        Desconto
                                    </a>
                                @endisset --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
