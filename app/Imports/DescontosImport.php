<?php

namespace App\Imports;

use App\Models\Desconto;
use App\Models\Produto;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class DescontosImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $item) {
            if ($index > 0) {
                if ($this->verficarSeDescontoJaExiste($item[0])) {
                    $desconto = new Desconto();

                    $desconto->create([
                        'user_id' => Auth::id(),
                        'produto_id' => $item[0],
                        'quantidade0' => intval($item[1]),
                        'porcentagem0' => intval($item[2]),
                        'quantidade1' => intval($item[3]),
                        'porcentagem1' => intval($item[4]),
                        'quantidade2' => intval($item[5]),
                        'porcentagem2' => intval($item[6]),
                        'quantidade3' => intval($item[7]),
                        'porcentagem3' => intval($item[8]),
                        'quantidade4' => intval($item[9]),
                        'porcentagem4' => intval($item[10]),
                    ]);

                    $desconto->save();
                }
            }
        }
    }

    public function verficarSeDescontoJaExiste($sku)
    {
        if (count(Produto::all()->where('codigo', $sku)) > 0) {
            return false;
        }
        return true;
    }
}
