<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $cast = [
        'categoria' => 'array',
        'estrutura' => 'array',
    ];

    protected $fillable = [
        'idProduto',
        'codigo',
        'descricao',
        'tipo',
        'situacao',
        'unidade',
        'preco',
        'precoCusto',
        'descricaoCurta',
        'descricaoComplementar',
        'dataInclusao',
        'dataAlteracao',
        'imageThumbnail',
        'urlVideo',
        'nomeFornecedor',
        'codigoFabricante',
        'marca',
        'class_fiscal',
        'cest',
        'origem',
        'idGrupoProduto',
        'linkExterno',
        'observacoes',
        'grupoProduto',
        'garantia',
        'descricaoFornecedor',
        'idFabricante',
        'categoria',
        'pesoLiq',
        'pesoBruto',
        'estoqueAtual',
        'estoqueMinimo',
        'estoqueMaximo',
        'gtin',
        'gtinEmbalagem',
        'larguraProduto',
        'alturaProduto',
        'profundidadeProduto',
        'unidadeMedida',
        'itensPorCaixa',
        'volumes',
        'localizacao',
        'crossdocking',
        'condicao',
        'freteGratis',
        'producao',
        'dataValidade',
        'spedTipoItem'
    ];

    public function pagamentos()
    {
        return $this->belongsTo(Pagamento::class);
    }

    public function desconto()
    {
        return $this->belongsTo(Desconto::class, 'id', 'produto_id');
    }

    public function propostaProdutos()
    {
        return $this->hasOne(PropostaProduto::class);
    }
}
