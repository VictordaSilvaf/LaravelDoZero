<?php

namespace App\Imports;

use App\Models\Produto;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProdutosImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $item) {
            if (count(Produto::all()->where('codigo', $item[0])->where('anuncio', true))) {
                $produto = Produto::where('codigo', $item[0])->first();
                $produto->anuncio = false;
                $produto->save();
            }
        }
    }
}
