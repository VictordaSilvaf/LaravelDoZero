<?php

namespace App\Exports;

use App\Models\Proposta;
use Maatwebsite\Excel\Concerns\FromCollection;

class PdfExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Proposta::all();
    }
}
