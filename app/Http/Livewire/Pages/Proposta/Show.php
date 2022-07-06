<?php

namespace App\Http\Livewire\Pages\Proposta;

use App\Mail\EnviarPDF;
use App\Models\Proposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use PDF;

class Show extends Component
{
    public function render(Request $request)
    {
        $proposta = Proposta::all()->find($request->id);

        $produto1 = $proposta->produtosProposta->first()->produtos;
        return view('livewire.pages.proposta.show', compact('proposta'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropostaComercial  $propostaComercial
     * @return \Illuminate\Http\Response
     * 
     */
    public function imprimirPDF($id)
    {
        $pdf = $this->gerarPDF($id);
        return $pdf->download('proposta.pdf');
    }

    public function gerarPDF($id)
    {
        $propostaComercial = Proposta::find($id);

        $pdf = PDF::loadView('pdf.proposta', compact('propostaComercial'));

        return $pdf;
    }

    public function enviarPDFEmail($id)
    {
        $pdf = $this->gerarPDF($id);
        $propostaComercial = Proposta::findOrFail($id);
        $localArquivo = 'temp/' . uniqid() . '.pdf';

        Storage::put($localArquivo, $pdf->output());
        Mail::to($propostaComercial->clientes->email)->send(new EnviarPDF($propostaComercial, $localArquivo, $pdf));
        Storage::delete($localArquivo);

        return redirect()->back()->with('msg', 'Email enviado com sucesso!');
    }
}
