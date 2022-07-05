{{-- {{ dd($propostaComercial->desconto_total) }} --}}

<!DOCTYPE html>
<html>

<head>
    <title>Proposta Comercial</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        * {
            font-family: sans-serif;
        }

        .pdf {
            padding: 2%;
        }

        table {
            width: 100%;
        }

        tr {
            width: 100%;
        }

        p {
            margin-left: 4%;
        }

        table {
            border-collapse: collapse;
            font-size: 14px;
            font-family: sans-serif;
        }

        th,
        td {
            border: solid 1px;
        }

        thead {
            background-color: lightgray;
        }

        tfoot {
            border: 0px solid;
            background-color: lightgray;
        }

    </style>
</head>

<body>
    <div class="border pdf">
        <h3>Cliente</h3>
        <table class="tabela1">
            <thead>
                <th>Identificação cliente</th>
                <th>Dados da entrega</th>
                <th>Dados contato</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p>Nome: {{ $propostaComercial->clientes->nome }}</p>
                        <p>CPF/CNPJ: {{ $propostaComercial->clientes->cnpj_cpf }}</p>
                    </td>
                    <td class="border bloco">
                        <p>{{ $propostaComercial->clientes->endereco }}, {{ $propostaComercial->clientes->numero }}.</p>
                        <p>{{ $propostaComercial->clientes->bairro }}</p>
                        <p>{{ $propostaComercial->clientes->cep }} - {{ $propostaComercial->clientes->cidade }}, {{ $propostaComercial->clientes->uf }}</p>
                    </td>
                    <td class="border bloco">
                        <p>{{ $propostaComercial->clientes->fone }}</p>
                        <p>Email: {{ $propostaComercial->clientes->email }}</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>Vendedor</h3>
        <table class="tabela1">
            <thead>
                <th>Dados vendedor</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p>Nome: {{ $propostaComercial->users->name}}</p>
                        <p>ID: {{ $propostaComercial->users->id }}</p>
                        <p>Data da venda: {{ $propostaComercial->created_at }}</p>
                        <p>Ultima Atualização: {{ $propostaComercial->updated_at }}</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>Produtos</h3>
        <table class="tabela2">
            <thead>
                <th style="width: 30px;"></th>
                <th>SKU</th>
                <th>Descrição do produto</th>
                <th>Desconto</th>
                <th>Valor Uni.</th>
                <th>Quant.</th>
                <th>Valor Total</th>
            </thead>

            <tbody>
                @foreach ($propostaComercial->produtosProposta as $produto)

                    <tr style="text-align: center">
                        <td style="padding: 2px 10px">{{ $loop->index }}</td>
                        <td style="padding: 2px 10px">{{ $produto->produtos->codigo }}</td>
                        <td style="padding: 2px 10px">{{ $produto->produtos->descricao }}</td>
                        <td style="padding: 2px 10px">{{ $produto->descontoFiscal }}</td>
                        <td style="white-space: nowrap; padding: 2px 10px;">R$ {{ number_format($produto->produtos->preco, 2, ',', '.') }}</td>
                        <td style="padding: 2px 10px">{{ $produto->quantidade }}</td>
                        <td style="padding: 2px 10px">{{ ($produto->produtos->preco * $produto->produtos->quantidade) - (($produto->produtos->preco * $produto->produtos->quantidade) / 100) * $produto->produtos->descontoFiscal }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Frete: R${{$propostaComercial->frete}}</td>
                    <td colspan="2">Desc. Total: R${{ $propostaComercial->desconto_total }}</td>
                    <td colspan="3">Total pedido: R${{ $propostaComercial->total }}</td>
                </tr>
            </tfoot>
        </table>
        <h3>Observação</h3>
        <p style="margin: 0">{{ $propostaComercial->observacaoVendedor }}</p>
    </div>
</body>

</html>
