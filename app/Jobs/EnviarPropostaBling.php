<?php

namespace App\Jobs;

use App\Models\Proposta;
use App\Models\PropostaProduto;
use DateInterval;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class EnviarPropostaBling implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $proposta;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        Proposta $proposta
    ) {
        $this->proposta = $proposta;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $xml = $this->gerarXML($this->proposta);
            dd($xml);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function gerarXML(Proposta $proposta)
    {
        $xml =
            '<?xml version="1.0" encoding="UTF-8"?>
                <pedido>
                    <cliente>
                        <nome>' . $proposta->clientes->nome . '</nome>
                        <tipoPessoa>' . $proposta->clientes->tipoPessoa . '</tipoPessoa>
                        <endereco>' . $proposta->clientes->endereco . '</endereco>
                        <cpf_cnpj>' . $proposta->clientes->cnpj_cpf . '</cpf_cnpj>
                        <numero>' . $proposta->clientes->numero . '</numero>
                        <complemento>none</complemento>
                        <bairro>' . $proposta->clientes->bairro . '</bairro>
                        <cep>' . $proposta->clientes->cep . '</cep>
                        <cidade>' . $proposta->clientes->cidade . '</cidade>
                        <uf>' . $proposta->clientes->uf . '</uf>
                        <fone>' . $proposta->clientes->fone . '</fone>
                        <email>' . $proposta->clientes->email . '</email>
                    </cliente>
                    <transporte>
                        <transportadora>' . $proposta->transportadora . '</transportadora>
                        <tipo_frete>R</tipo_frete>
                        <servico_correios>' . $proposta->modo_envio . '</servico_correios>
                        <dados_etiqueta>
                            <nome>' . $proposta->clientes->nome . '</nome>
                            <endereco>' . $proposta->clientes->endereco . '</endereco>
                            <numero>' . $proposta->clientes->numero . '</numero>
                            <complemento></complemento>
                            <municipio>' . $proposta->clientes->cidade . '</municipio>
                            <uf>' . $proposta->clientes->uf . '</uf>
                            <cep>' . $proposta->clientes->cep . '</cep>
                            <bairro>' . $proposta->clientes->bairro . '</bairro>
                        </dados_etiqueta>
                        <volumes>
                            <volume>
                                <servico>' . $proposta->modo_envio . '</servico>
                                <codigoRastreamento></codigoRastreamento>
                            </volume>
                        </volumes>
                    </transporte>
                    <itens>
                        ' . $this->xmlProdutos($proposta) . ' 
                    </itens>
                    ' . $this->gerarParcelas($proposta) . '
                    <vlr_frete>' . floatval($proposta->frete) . '</vlr_frete>
                    <vlr_desconto>' . floatval($proposta->desconto_total) . '</vlr_desconto>
                    <intermediador>
                    <nomeUsuario>' . $proposta->users->name . '</nomeUsuario>
                    </intermediador>
                </pedido>';

        return $xml;

        /* ' . $this->xmlProdutos($proposta->produtos) . ' */
        /* ' . $this->gerarParcelas($proposta) . ' */
    }

    public function xmlProdutos(Proposta $proposta)
    {
        $xml = "";
        foreach ($proposta->produtosProposta as $produto) {
            $xml .= "<item>
                            <codigo>" . $produto->produto->codigo . "</codigo>
                            <descricao>" . $produto->produto->descricao . "</descricao>
                            <un>uni</un>
                            <qtde>" . $produto->quantidade . "</qtde>
                            <vlr_unit>" . (floatval(str_replace('R$ ', '', $produto->produto->preco))) . "</vlr_unit>
                        </item>
                        ";
        }
        return $xml;
    }

    public function gerarParcelas(Proposta $proposta)
    {
        $xml = '<parcelas>';
        foreach ($proposta->parcelas as $parcela) {
            dd(now()->date);
            /*pegando data do json das parcelas e transformando em data no formato que o php entende */
            $date = Carbon::createFromFormat("!Y-m-d", Carbon::now()->format('Y-m-d'))
                ->addDays(30)->format('Y-m-d');
            $xml .= '
                     <parcela>
                            <dias>' . $parcelas[$x]['parcela-dia'] . '</dias>
                            <data>' . $date . '</data>
                            <vlr>' . $parcelas[$x]['parcela-valor'] . '</vlr>
                            <forma_pagamento><id>' . $parcelas[$x]['parcela-modoPagamento'] . '</id></forma_pagamento>
                            <obs>' . $parcelas[$x]['parcela-obs'] . '</obs>
                     </parcela>
';
        }
        $xml .= '                   </parcelas>';

        return $xml;
    }
}
