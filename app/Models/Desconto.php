<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desconto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produto_id',
        'dados',
        'quantidade0',
        'porcentagem0',
        'quantidade1',
        'porcentagem1',
        'quantidade2',
        'porcentagem2',
        'quantidade3',
        'porcentagem3',
        'quantidade4',
        'porcentagem4',
    ];

    public function produto()
    {
        return $this->hasOne(Produto::class, 'id', 'produto_id');
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }
}
