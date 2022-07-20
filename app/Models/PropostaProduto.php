<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropostaProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'propostas_id', 'quantidade', 'users_id', 'produtos_id'
    ];

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(User::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produtos_id', 'id');
    }

    public function proposta()
    {
        return $this->belongsTo(Proposta::class, 'propostas_id', 'id');
    }
}
