<?php

namespace App\Exports;

use App\Models\Desconto;
use Maatwebsite\Excel\Concerns\FromCollection;

class DescontosExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Desconto::all();
    }
}
