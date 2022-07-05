<?php

namespace App\Http\Livewire\Pages;

use App\Models\Desconto;
use App\Models\Proposta;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $dadosMeses = $this->contagemPorMeses(now()->year);

        $dados = $this->montarDadosPorMeses($dadosMeses);
        $chartjs = $this->grafico($dados);
        $propostas = Proposta::all();
        $paginacaoPropostas = Proposta::take(2)->get();
        $descontos = Desconto::orderBy('updated_at', 'asc')->paginate(2);

        return view('livewire.pages.home', compact('chartjs', 'propostas', 'descontos', 'paginacaoPropostas'));
    }

    public function grafico($dados)
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
                    'data' => $dados[0][0]
                ],
                [
                    "label" => "Propostas Pendentes",
                    'backgroundColor' => ['rgba(255, 166, 0, 0.6)'],
                    'data' => $dados[0][2]
                ],
                [
                    "label" => "Propostas Recusadas",
                    'backgroundColor' => ['rgba(255, 86, 48, 0.6)'],
                    'data' => $dados[0][1]
                ]
            ])
            ->options([]);

        return $chartjs;
    }

    public function contagemPorMeses($ano)
    {
        $dadosMeses = array();


        for ($i = 1; $i <= 12; $i++) {
            $dados = Proposta::whereYear('created_at', '=', $ano)->whereMonth('created_at', '=', $i)->get();
            if (count($dados) == 0)
                array_push($dadosMeses, 0);
            else {
                array_push($dadosMeses, $dados);
            }
        }

        return $dadosMeses;
    }

    public function montarDadosPorMeses($dadosMeses)
    {
        $dados = array();

        $aceitas = array();
        $pendentes = array();
        $recusadas = array();

        foreach ($dadosMeses as $dadosMes) {
            if ($dadosMes === 0) {
                array_push($aceitas, 0);
                array_push($pendentes, 0);
                array_push($recusadas, 0);
            } else {
                array_push($aceitas, count($dadosMes->where('status', 'aceita')));
                array_push($pendentes, count($dadosMes->where('status', 'pendente')));
                array_push($recusadas, count($dadosMes->where('status', 'recusada')));
            }
        }
        array_push($dados, [$aceitas, $recusadas, $pendentes]);

        return $dados;
    }
}
