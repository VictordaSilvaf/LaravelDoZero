<?php

namespace App\Observers;

use App\Jobs\EnviarPropostaBling;
use App\Models\Proposta;

class PropostaObserver
{
    /**
     * Handle the Proposta "created" event.
     *
     * @param  \App\Models\Proposta  $proposta
     * @return void
     */
    public function created(Proposta $proposta)
    {
        //
    }

    /**
     * Handle the Proposta "accepted" event.
     *
     * @param  \App\Models\Proposta  $proposta
     * @return void
     */
    public function accepted(Proposta $proposta)
    {
    }

    /**
     * Handle the Proposta "updated" event.
     *
     * @param  \App\Models\Proposta  $proposta
     * @return void
     */
    public function updated(Proposta $proposta)
    {
    }

    /**
     * Handle the Proposta "deleted" event.
     *
     * @param  \App\Models\Proposta  $proposta
     * @return void
     */
    public function deleted(Proposta $proposta)
    {
        //
    }

    /**
     * Handle the Proposta "restored" event.
     *
     * @param  \App\Models\Proposta  $proposta
     * @return void
     */
    public function restored(Proposta $proposta)
    {
        //
    }

    /**
     * Handle the Proposta "force deleted" event.
     *
     * @param  \App\Models\Proposta  $proposta
     * @return void
     */
    public function forceDeleted(Proposta $proposta)
    {
        //
    }
}
