<?php

namespace App\Http\Livewire\Pages\Desconto;

use App\Models\Desconto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DescontoCreate extends Component
{
    public $quantidadeParcelas = 5;

    public $identificacaoProduto;
    public $idProduto;
    public $busca;

    public $produto;

    public $quantidadeProduto0;
    public $porcentagemDesconto0;
    public $quantidadeProduto1;
    public $porcentagemDesconto1;
    public $quantidadeProduto2;
    public $porcentagemDesconto2;
    public $quantidadeProduto3;
    public $porcentagemDesconto3;
    public $quantidadeProduto4;
    public $porcentagemDesconto4;

    public $update = false;

    protected $rules = [
        'quantidadeProduto0' => 'min:1|max:4|gt:0',
        'porcentagemDesconto0' => 'nullable|required:quantidadeProduto0|min:1|max:2',

        'porcentagemDesconto1' => 'min:1|max:2|required:quantidadeProduto1',
        'quantidadeProduto1' => 'min:1|max:4',
        'porcentagemDesconto2' => 'min:1|max:2|required:quantidadeProduto2',
        'quantidadeProduto2' => 'min:1|max:4',
        'porcentagemDesconto3' => 'min:1|max:2|required:quantidadeProduto3',
        'quantidadeProduto3' => 'min:1|max:4',
        'porcentagemDesconto4' => 'min:1|max:2|required:quantidadeProduto4',
        'quantidadeProduto4' => 'min:1|max:4',
    ];


    protected $messages = [
        'required' => 'O campo não pode ser nulo.',
        'max' => 'Você passou o numero máximo de caracteres.',
        'max' => 'Você não digitou o numero minimo de caracteres.',
        'gt' => 'O campo precisa ser maior que 0.'
    ];


    public function render(Request $request)
    {
        if (isset($request->id)) {
            $desconto = Desconto::all()->find($request->id);
            $produto = $desconto->produto;

            $this->idProduto = $produto->id;
            $this->quantidadeProduto0 = $desconto->quantidade0;
            $this->porcentagemDesconto0 = $desconto->porcentagem0;
            $this->quantidadeProduto1 = $desconto->quantidade1;
            $this->porcentagemDesconto1 = $desconto->porcentagem1;
            $this->quantidadeProduto2 = $desconto->quantidade2;
            $this->porcentagemDesconto2 = $desconto->porcentagem2;
            $this->quantidadeProduto3 = $desconto->quantidade3;
            $this->porcentagemDesconto3 = $desconto->porcentagem3;
            $this->quantidadeProduto4 = $desconto->quantidade4;
            $this->porcentagemDesconto4 = $desconto->porcentagem4;

            $this->identificacaoProduto = $produto->codigo;

            $this->update = true;
        }

        return view('livewire.pages.desconto.desconto-create')
            ->extends('livewire.layouts.dashboard-layout');
    }

    public function store()
    {
        $this->validate();

        if (!isset($this->idProduto)) {
            $this->idProduto = Produto::where('codigo', $this->identificacaoProduto)->first()->id;
        }

        $salvarDesconto = Desconto::updateOrCreate([
            'produto_id' => $this->idProduto,
        ], [
            'user_id' => Auth::id(),
            'produto_id' => $this->idProduto,
            'quantidade0' => intval($this->quantidadeProduto0),
            'porcentagem0' => intval($this->porcentagemDesconto0),
            'quantidade1' => intval($this->quantidadeProduto1),
            'porcentagem1' => intval($this->porcentagemDesconto1),
            'quantidade2' => intval($this->quantidadeProduto2),
            'porcentagem2' => intval($this->porcentagemDesconto2),
            'quantidade3' => intval($this->quantidadeProduto3),
            'porcentagem3' => intval($this->porcentagemDesconto3),
            'quantidade4' => intval($this->quantidadeProduto4),
            'porcentagem4' => intval($this->porcentagemDesconto4),
        ]);

        try {
            if ($salvarDesconto->save()) {
                if ($this->update) {
                    return redirect()->route('descontos.index')->with('msg',  'Desconto editado com sucesso!');
                } else {
                    return redirect()->route('descontos.index')->with('msg',  'Desconto adicionado com sucesso!');
                }
            } else {
                return redirect()->route('descontos.index')->with('msgErro', 'Não foi possivel adicionar o desconto');
            }
        } catch (\Throwable $th) {
            return redirect()->route('descontos.index')->with('msgErro', 'Não foi possivel adicionar o desconto');
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

    public function buscarProduto()
    {

        if ($this->identificacaoProduto != null) {
            $this->busca = $this->identificacaoProduto;

            if (count(Produto::all()->where('codigo', $this->identificacaoProduto)) == 1) {
                $this->produto  = Produto::all()->where('codigo', $this->identificacaoProduto)->first();
            } else {
                $produtos = Produto::where('codigo', "LIKE",  "%" . $this->identificacaoProduto . "%")->paginate(6);

                if (count($produtos) > 0) {
                    return view('livewire.pages.desconto.desconto-create', compact('produtos', 'busca'))
                        ->extends('livewire.layouts.dashboard-layout');
                } else {
                    $erro = "Produto Não encontrado.";
                    return view('livewire.pages.desconto.desconto-create', compact('erro'))
                        ->extends('livewire.layouts.dashboard-layout');
                }
            }


            return view('livewire.pages.desconto.desconto-create')
                ->extends('livewire.layouts.dashboard-layout');
        }
    }
}
