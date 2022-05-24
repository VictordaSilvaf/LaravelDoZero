<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desconto extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'sku_produto', 'quantidade_produto', 'porcentagem_desconto_produto', 'quantidade_produto1', 'porcentagem_desconto_produto1', 'quantidade_produto2', 'porcentagem_desconto_produto2', 'quantidade_produto3', 'porcentagem_desconto_produto3', 'quantidade_produto4', 'porcentagem_desconto_produto4', 'quantidade_produto5', 'porcentagem_desconto_produto5'];

    public function produto()
    {
        return $this->hasOne(Produto::class);
    }
}
