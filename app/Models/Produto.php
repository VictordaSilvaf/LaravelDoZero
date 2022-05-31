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

    public function pagamento()
    {
        return $this->belongsTo(Pagamento::class);
    }

    public function desconto()
    {
        return $this->hasOne(Desconto::class);
    }

    public function propostaProduto()
    {
        return $this->belongsTo(PropostaProduto::class);
    }
}
