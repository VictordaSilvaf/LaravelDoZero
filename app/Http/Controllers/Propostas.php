<?php

namespace App\Http\Controllers;

use App\Models\Proposta;
use Illuminate\Http\Request;

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
                $propostas = Proposta::where('status', 'aceita')->simplePaginate(10);
                break;

            case 'pendentes':
                $status = 'pendentes';
                $propostas = Proposta::where('status', 'pendente')->simplePaginate(10);
                break;

            case 'recusadas':
                $status = 'recusadas';
                $propostas = Proposta::where('status', 'recusada')->simplePaginate(10);
                break;
        }

        return view('livewire.pages.proposta.show', compact('propostas', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
