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

    public function descontos()
    {
        return $this->hasOne(Desconto::class);
    }

    public function propostaProdutos()
    {
        return $this->hasOne(PropostaProduto::class);
    }
}
