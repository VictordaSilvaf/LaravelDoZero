<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id', 'clientes_id', 'pagamentos_id', 'consumo_revenda', 'observacaoVendedor', 'transportadora', 'modo_envio', 'frete', 'peso_total', 'parcelas', 'desconto_vendedor', 'desconto_total', 'total'
    ];

    protected $casts = [
        'parcelas' => 'array'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function produtosProposta()
    {
        return $this->hasMany(PropostaProduto::class, 'propostas_id', 'id');
    }
}
