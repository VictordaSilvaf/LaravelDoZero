<?php

namespace App\Exports;

use App\Models\Produto;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProdutosExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Produto::all()->where('anuncio', false);
    }
}
