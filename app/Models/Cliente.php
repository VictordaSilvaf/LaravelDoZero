<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $casts = [
        'cliente' => 'array'
    ];

    public function propostaComerciais()
    {
        return $this->hasMany(PropostaComercial::class);
    }
}
