<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class getFrete implements ShouldQueue
{
  use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public $tries = 5;
  public $user_id;
  public $maxExceptions = 3;
  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($user_id)
  {
    $this->user_id = $user_id;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    try {
      $produtos = Cache::get('produtos_user_id_produtos' . $this->user_id);
      $frete = "fretes_produtos_user_id_cliente$this->user_id";
      if (isset($produtos)) {

        $data = json_decode($this->postMandae($produtos)->getContents());
        if (Cache::has($frete)) {
          Cache::forget($frete);
        }

        Cache::add($frete, ['data' => $data->data], 1200);
        return true;
      }
      return false;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function postMandae($produtos)
  {
    $body = array('items' => array());

    foreach ($produtos as $produto) {
      array_push($body['items'], [
        "declaredValue" => $produto[0]->preco,
        "weight" => $produto[0]->pesoBruto,
        "height" => $produto[0]->alturaProduto,
        "width" => $produto[0]->larguraProduto,
        "length" => $produto[0]->profundidadeProduto,
        "quantity" => $produto[1]
      ]);
    }
    $body = json_decode(json_encode($body));
    $body = json_encode($body, true);

    $client = new Client();

    $headers = [
      'Authorization' => env('API_TOKEN_MANDAE'),
      'Content-Type' => 'application/json'
    ];

    $request = new Request('POST', 'http://api.mandae.com.br/v3/postalcodes/04864100/rates?Authorization=' . env('API_TOKEN_MANDAE'), $headers, $body);

    $res = $client->sendAsync($request)->wait();

    return $res->getBody();
  }
}
