<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $fillable = [
        'id',
        'codigo',
        'nome',
        'fantasia',
        'tipo',
        'cnpj',
        'ie_rg',
        'endereco',
        'numero',
        'bairro',
        'cep',
        'cidade',
        'complemento',
        'uf',
        'fone',
        'email',
        'situacao',
        'contribuinte',
        'site',
        'celular',
        'dataAlteracao',
        'dataInclusao',
        'sexo',
        'clienteDesde',
        'limiteCredito'
    ];

    protected $casts = [
        'cliente' => 'array'
    ];

    public function propostaComerciais()
    {
        return $this->hasMany(PropostaComercial::class);
    }
}
