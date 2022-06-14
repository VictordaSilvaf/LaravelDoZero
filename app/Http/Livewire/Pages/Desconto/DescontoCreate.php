<?php

namespace App\Http\Livewire\Pages\Desconto;

use App\Models\Desconto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DescontoCreate extends Component
{
    public $quantidadeParcelas = 5;

    public $identificacaoProduto;
    public $quantidadeProduto0;
    public $porcentagemProduto0;
    public $quantidadeProduto1;
    public $porcentagemProduto1;
    public $quantidadeProduto2;
    public $porcentagemProduto2;
    public $quantidadeProduto3;
    public $porcentagemProduto3;
    public $quantidadeProduto4;
    public $porcentagemProduto4;

    public function render()
    {
        return view('livewire.pages.desconto.desconto-create');
    }

    public function store(Request $request)
    {
        $formData = array();
        //função para impedir cadastrar 2 skus iguais
        $verificar_sku_duplicado = $this->verificarSkuDuplicado($request->identificacaoProduto);

        if ($verificar_sku_duplicado === 0) {
            $desconto = new Desconto();
            array_push($formData, ['sku' => $request->get('identificacaoProduto')]);
            for ($i = 0; $i < 5; $i++) {
                array_push($formData, [
                    'quantidade' . $i => $request->get('quantidade' . $i),
                    'porcentagem' . $i => $request->get('porcentagem' . $i)
                ]);
            }

            dd($formData);


            $desconto->usuario_id = Auth::id();
            $desconto->sku_produto = $request->identificacaoProduto;

            $desconto->quantidade_produto1 = $dadosOrganizados[0][0];
            $desconto->porcentagem_desconto_produto1 = $dadosOrganizados[1][0];
            $desconto->quantidade_produto2 = $dadosOrganizados[0][1];
            $desconto->porcentagem_desconto_produto2 = $dadosOrganizados[1][1];
            $desconto->quantidade_produto3 = $dadosOrganizados[0][2];
            $desconto->porcentagem_desconto_produto3 = $dadosOrganizados[1][2];
            $desconto->quantidade_produto4 = $dadosOrganizados[0][3];
            $desconto->porcentagem_desconto_produto4 = $dadosOrganizados[1][3];
            $desconto->quantidade_produto5 = $dadosOrganizados[0][4];
            $desconto->porcentagem_desconto_produto5 = $dadosOrganizados[1][4];


            try {
                $desconto->save();
                return redirect()->route('desconto.index')->with('msg', 'Desconto adicionado com sucesso!');
            } catch (\Throwable $th) {
                dd($th);
                return redirect()->route('desconto.index')->with('msgErro', 'Não foi possivel adicionar o desconto');
            }
        } else {

            return redirect()->route('desconto.index')->with('msgErro', 'Esse produto já está cadastrado');
        }
    }

    public function verificarSkuDuplicado($sku)
    {
        $retorno = 1;
        try {
            $verificar = Desconto::where('sku_produto', $sku)->firstOrFail();
        } catch (\Throwable $th) {
            $retorno = 0;
        }

        return $retorno;
    }
}
