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
