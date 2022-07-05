<?php

namespace App\Http\Livewire\Pages\Proposta;

use App\Models\Cliente;
use App\Models\Proposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $propostaComercial = Proposta::find($id);

        $pdf = PDF::loadView('pdf.proposta', compact('propostaComercial'));
        return $pdf->download('proposta.pdf');
    }

    public function enviarPDFEmail($id)
    {
        $pdf = $this->gerarPDF($id);

        $propostaComercial = Proposta::findOrFail($id);
        $cliente = Cliente::all()->where('cnpj', '=', $propostaComercial->cpf_cnpj)->first();
        return new \App\Mail\SendPDF($propostaComercial);
        
        Mail::to('victordasilvafernandes@gmail.com')->send(new \App\Mail\SendPDF($propostaComercial, $pdf, $cliente));
        return redirect()->route('propostaComercial.index')->with('msg', 'Email enviado com sucesso!');
    }
}
