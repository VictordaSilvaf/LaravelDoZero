<?php

namespace App\Jobs;

use App\Models\Proposta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;

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
            /* if ($this->enviarXMLBling($xml)) {
                $this->proposta->status = 'aceita';
                $this->proposta->save();

                session()->flash('flash.banner', 'Proposta cadastrada com sucesso!');
            } else {
                session()->flash('flash.banner', 'Ocorreu algum erro na hora de enviar a proposta para o bling');
            } */
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
    public function enviarXMLBling($xml)
    {
        $url = 'https://bling.com.br/Api/v2/pedido/json/';

        $posts = array(
            "apikey" => env('API_KEY_BLING'),
            "xml" => rawurlencode($xml)
        );

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_POST, count($posts));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $posts);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        $jsonPedidoEnviado = json_decode($response, true);

        if (isset($jsonPedidoEnviado['retorno']['erros'])) {
            return false;
        } else {
            return true;
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
                        <tipoPessoa>' . $proposta->clientes->tipo . '</tipoPessoa>
                        <endereco>' . $proposta->clientes->endereco . '</endereco>
                        <cpf_cnpj>' . $proposta->clientes->cnpj . '</cpf_cnpj>
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
        foreach ($proposta->parcelas as $key => $parcela) {
            if ($parcela['status'] == true) {
                if ($parcela['dia'] != null) {

                    /*pegando data do json das parcelas e transformando em data no formato que o php entende */
                    $date = Carbon::createFromFormat("!Y-m-d", Carbon::now()->format('Y-m-d'))
                        ->addDays(30)->format('Y-m-d');

                    $xml .= '
                     <parcela>
                            <dias>' . $parcela['dia'] . '</dias>
                            <data>' . $date . '</data>
                            <vlr>' . $parcela['valor'] . '</vlr>
                            <forma_pagamento><id>' . $parcela['forma_pagamento'] . '</id></forma_pagamento>
                            <obs>' . $parcela['descricao'] . '</obs>
                     </parcela>
';
                }
            }
        }
        $xml .= '</parcelas>';


        return $xml;
    }
}
