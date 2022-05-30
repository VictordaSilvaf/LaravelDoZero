<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $chartjs = $this->grafico();
        return view('livewire.pages.home', compact('chartjs'));
    }

    public function grafico()
    {
        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 140])
            ->labels([
                'Janeiro',
                'Fevereiro',
                'Março',
                'Abril',
                'Maio',
                'Junho',
                'Julho',
                'Agosto',
                'Setembro',
                'Outubro',
                'Novembro',
                'Dezembro'
            ])

            ->datasets([
                [
                    "label" => "Propostas Aceitas",
                    'backgroundColor' => ['rgba(56, 203, 137, 0.6)'],
                    'data' => [15, 5, 8, 2, 7, 4, 6, 8, 8, 3, 1, 7]
                ],
                [
                    "label" => "Propostas Pendentes",
                    'backgroundColor' => ['rgba(255, 166, 0, 0.6)'],
                    'data' => [11, 12, 6, 8, 8, 3, 1, 5, 2, 2, 7, 6]
                ],
                [
                    "label" => "Propostas Recusadas",
                    'backgroundColor' => ['rgba(255, 86, 48, 0.6)'],
                    'data' => [2, 12, 8, 3, 1, 11, 12, 6, 5, 8, 1, 3]
                ]
            ])
            ->options([]);

        return $chartjs;
    }
}
