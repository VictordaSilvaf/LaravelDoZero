<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desconto extends Model
{
    use HasFactory;

    protected $casts = [
        'dados' => 'array', // Will convarted to (Array)
    ];

    protected $fillable = ['user_id', 'produto_id', 'dados'];

    public function produto()
    {
        return $this->hasOne(Produto::class, 'id', 'produto_id');
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }
}
