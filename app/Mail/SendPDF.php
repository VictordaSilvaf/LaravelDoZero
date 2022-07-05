<?php

namespace App\Mail;

use App\Models\Cliente;
use App\Models\Proposta;
use App\Models\PropostaComercial;
use Barryvdh\DomPDF\PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SendPDF extends Mailable
{
    use Queueable, SerializesModels;

    private $propostaComercial;
    private $cliente;
    private $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Proposta $propostaComercial)
    {
        $this->propostaComercial = $propostaComercial;
        // $this->cliente = $cliente;
        // $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        dd($this->propostaComercial);
        $address = $this->cliente->email;
        $subject = 'PDF Proposta Comercial Desicon';
        $name = $this->cliente->nome;

        // gerando um nome para o arquivo
        $fileName = uniqid();
        $pathToFile = 'temp/' . $fileName . '.pdf';

        // dados proposta
        $propostaComercial = $this->propostaComercial;
        $cliente = $this->cliente;

        // salvando o pdf em uma tabela temporaria
        Storage::put($pathToFile, $this->pdf->output());
        return $this->from($address, 'Desicon Proposta Comercial')
            ->view('propostaComercial.email', compact('propostaComercial', 'cliente'))
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with(['test_message' => $this->cliente])
            ->attachData(Storage::get($pathToFile), ($fileName . '.pdf'), [
                'as' => $fileName,
                'mime' => 'application/pdf',
            ]);

        // excluindo o arquivo da pasta temporária
        Storage::delete($pathToFile);
    }
}
