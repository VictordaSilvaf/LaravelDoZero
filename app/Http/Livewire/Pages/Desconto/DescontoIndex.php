<?php

namespace App\Http\Livewire\Pages\Desconto;

use App\Exports\DescontosExport;
use App\Imports\DescontosImport;
use App\Models\Desconto;
use App\Models\Transporte;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class DescontoIndex extends Component
{
    use WithFileUploads;

    public $photo;

    public function render()
    {
        $transportadoras = ["JADLOG.COM", "JADLOG.PACKAGE", "SEDEX - EXPRESSO CORREIOS", "PAC - ECONÔMICO CORREIOS", "JONAS VIEIRA", "PEX", "RETIRAR", "OUTROS"];
        $descontos = Desconto::paginate(8);
        return view('livewire.pages.desconto.desconto-index', compact('descontos'));
    }

    public function export(Request $request)
    {
        return Excel::download(new DescontosExport, 'descontos.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new DescontosImport, $request->file_input);
        return redirect()->back()->with('msg', 'Descontos adicionados com sucesso!');
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
