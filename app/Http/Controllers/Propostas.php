<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Proposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Propostas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        switch ($request->stats) {
            case 'aceitas':
                $status = 'aceitas';
                $propostas = Proposta::where('status', 'aceita')->paginate(10);
                break;

            case 'pendentes':
                $status = 'pendentes';
                $propostas = Proposta::where('status', 'pendente')->paginate(10);
                break;

            case 'recusadas':
                $status = 'recusadas';
                $propostas = Proposta::where('status', 'recusada')->paginate(10);
                break;
        }

        return view('livewire.pages.proposta.index', compact('propostas', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        switch ($request->stats) {
            case 'aceitas':
                $status = 'aceitas';
                $propostas = Proposta::where('status', 'aceita');
                break;

            case 'pendentes':
                $status = 'pendentes';
                $propostas = Proposta::where('status', 'pendente');
                break;

            case 'recusadas':
                $status = 'recusadas';
                $propostas = Proposta::where('status', 'recusada');
                break;
        }

        if (isset($request->search)) {
            $search = $request->search;

            $propostas = $propostas->join("clientes", "cnpj", "LIKE", intval($search))->get();
        }

        $propostas = $propostas->paginate(10);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mudarEstadoPC($id, $estado)
    {
        $proposta = Proposta::all()->find($id);

        if ($estado == 1) {
            $proposta->status = 'aceita';
        } else if ($estado == 2) {
            $proposta->status = 'recusada';
        }

        $proposta->save();

        return redirect()->back();
    }
}
