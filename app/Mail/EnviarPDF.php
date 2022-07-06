<?php

namespace App\Mail;

use App\Models\Proposta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarPDF extends Mailable
{
    use Queueable, SerializesModels;

    private $propostaComercial;
    private $localArquivo;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Proposta $propostaComercial, $localArquivo, $pdf)
    {
        $this->propostaComercial = $propostaComercial;
        $this->localArquivo = $localArquivo;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('livewire.mail.EnviarPDF', ['proposta' => $this->propostaComercial])
            ->attachData($this->pdf->output(), $this->localArquivo)->subject("Proposta Comercial Desicon");
    }
}
