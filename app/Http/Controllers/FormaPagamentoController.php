<?php

namespace App\Http\Controllers;

use App\Models\FormaPagamento;
use App\Http\Requests\StoreFormaPagamentoRequest;
use App\Http\Requests\UpdateFormaPagamentoRequest;
use App\Models\Pagamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class FormaPagamentoController extends Controller
{


    public function getFormasPagamentoBling()
    {
        try {
            $response = Http::get("https://bling.com.br/Api/v2/formaspagamento/json&apikey=9e9423b85ebb62aac022e74a212a2fa643dd9704753fdfebe07457803cc475c0c78211b2");
            $formasPagamento = ($response->json());
            $formasPagamento = array_pop($formasPagamento);
            $formasPagamento = array_pop($formasPagamento);

            dd($formasPagamento[0]['formapagamento']);
            if (!isset($formasPagamento['erro'])) {
                $this->store($formasPagamento);
            }

            return redirect(route('dashboard.home'));
        } catch (\Throwable $th) {
            //mensagem ocorreu algum problema na busca das ofrmas de pagamento no bling
            return redirect(route('dashboard.home'));
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formaPagamento = new Pagamento;

        dd($formaPagamento);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePagamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($blingFormasPagamento)
    {
        // dd($blingFormasPagamento);
        for ($i = 0; $i < count($blingFormasPagamento); $i++) {

            if ($blingFormasPagamento[$i]['formapagamento']['situacao'] == "1") {
                try {
                    if (Pagamento::where('id_bling', '=', intval($blingFormasPagamento[$i]['formapagamento']['id']))) {

                        $formaPagamento = Pagamento::where('id_bling', '=', intval($blingFormasPagamento[$i]['formapagamento']['id']))->firstOrFail();

                        dd($formaPagamento->update([
                            'id_bling' => intval($blingFormasPagamento[$i]['formapagamento']['id']),
                            'descricao' => $blingFormasPagamento[$i]['formapagamento']['descricao'],
                            'codigoFiscal' => intval($blingFormasPagamento[$i]['formapagamento']['codigoFiscal']),
                            'padrao' => intval($blingFormasPagamento[$i]['formapagamento']['padrao']),
                            'situacao' => intval($blingFormasPagamento[$i]['formapagamento']['situacao']),
                            'fixa' => intval($blingFormasPagamento[$i]['formapagamento']['fixa']),
                        ]));
                    } else {
                        dd(db::insert([
                            'id_bling' => intval($blingFormasPagamento[$i]['formapagamento']['id']),
                            'descricao' => $blingFormasPagamento[$i]['formapagamento']['descricao'],
                            'codigoFiscal' => intval($blingFormasPagamento[$i]['formapagamento']['codigoFiscal']),
                            'padrao' => intval($blingFormasPagamento[$i]['formapagamento']['padrao']),
                            'situacao' => intval($blingFormasPagamento[$i]['formapagamento']['situacao']),
                            'fixa' => intval($blingFormasPagamento[$i]['formapagamento']['fixa']),
                        ]));
                    }
                } catch (\Throwable $th) {
                    dd($th);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormaPagamento  $formaPagamento
     * @return \Illuminate\Http\Response
     */
    public function show(Pagamento $formaPagamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagamento  $formaPagamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagamento $formaPagamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePagamentoRequest  $request
     * @param  \App\Models\Pagamento  $formaPagamento
     * @return \Illuminate\Http\Response
     */
    public function update($blingFormasPagamento)
    {
        DB::table('pagamentos')->where('id_bling', intval($blingFormasPagamento['formapagamento']['id']))->update([
            'descricao' => $blingFormasPagamento['formapagamento']['descricao'],
            'codigoFiscal' => intval($blingFormasPagamento['formapagamento']['codigoFiscal']),
            'padrao' => intval($blingFormasPagamento['formapagamento']['padrao']),
            'situacao' => intval($blingFormasPagamento['formapagamento']['situacao']),
            'fixa' => intval($blingFormasPagamento['formapagamento']['fixa']),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagamento  $formaPagamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagamento $formaPagamento)
    {
        //
    }
}
