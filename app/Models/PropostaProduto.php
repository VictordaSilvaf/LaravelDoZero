<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropostaProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id', 'propostas_id', 'produtos_id', 'quantidade'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function produto()
    {
        return $this->hasOne(Produto::class);
    }
}
