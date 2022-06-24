<?php

namespace App\Http\Livewire\Pages\Desconto;

use App\Exports\DescontosExport;
use App\Models\Desconto;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DescontoIndex extends Component
{
    public function render()
    {
        $descontos = Desconto::paginate(8);
        return view('livewire.pages.desconto.desconto-index', compact('descontos'));
    }

    public function export()
    {
        return Excel::download(new DescontosExport, 'users.xlsx');
    }

    public function destroy(Desconto $id)
    {
        $id->delete();
        return back()->with('msg', 'Desconto deletado com sucesso.');
    }

    public function collection()
    {
        return Desconto::all();
    }
}
