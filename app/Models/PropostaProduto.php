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

    public function produtos()
    {
        return $this->hasOne(Produto::class);
    }

    public function propostaProdutos()
    {
        return $this->belongsTo(PropostaProduto::class);
    }
}
