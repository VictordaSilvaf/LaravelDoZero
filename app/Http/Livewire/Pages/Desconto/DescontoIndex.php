<?php

namespace App\Http\Livewire\Pages\Desconto;

use App\Exports\DescontosExport;
use App\Imports\DescontosImport;
use App\Models\Desconto;
use Illuminate\Http\Request;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DescontoIndex extends Component
{
    public $busca;

    public function render()
    {
        if (isset($this->busca)) {
            $descontos = Desconto::whereHas('produto', function ($query) {
                $query->where('codigo', 'LIKE', "$this->busca%");
            })->paginate(10);
        } else {
            $descontos = Desconto::paginate(10);
        }

        return view('livewire.pages.desconto.desconto-index', compact('descontos'))
            ->extends('livewire.layouts.dashboard-layout');
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
