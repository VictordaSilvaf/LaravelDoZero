<div class="p-2">
    {{-- top menu --}}
    <div class="flex justify-end w-full gap-3 pr-3">
        <a href="#" class="flex items-center justify-center w-6 h-6 rounded-full bg-desicon-blue">
            <span></span>
        </a>
        <a href="#" class="flex items-center justify-center w-6 h-6 rounded-full bg-desicon-blue">
            <span></span>
        </a>
        <a href="#" class="flex items-center justify-center w-6 h-6 rounded-full bg-desicon-blue">
            <span></span>
        </a>
    </div>

    {{-- Profile --}}
    <div class="flex flex-col justify-center mt-5 text-center">
        <div class="w-[150px] h-[150px] bg-desicon-blue rounded-full opacity-30 m-auto">

        </div>
        <p class="mt-1 font-light">Victor da Silva</p>
        <p class="font-light text-desicon-natural">Vendedor</p>
    </div>

    {{-- Last actions --}}
    <div class="flex flex-col px-1 mt-8">
        <h2 class="font-medium text-center">Histórico de propostas</h2>

        @isset($propostas)
            @foreach ($propostas as $proposta)
                <a href="#" class="flex items-center p-2 mt-2 rounded-lg bg-opacity-80 bg-desicon-natural7">
                    <div class="p-5 ml-1 rounded-full bg-slate-400">

                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm">
                            {{ $proposta->clientes_id }}
                        </h3>
                        <p class="text-sm font-extralight">
                            R$ {{ $proposta->total }}
                        </p>

                    </div>
                    <div class=" w-full flex justify-end pr-4">
                        @if ($proposta->status == 'aceita')
                            <div class="w-5 h-5 ml-2 rounded-full bg-desicon-green">

                            </div>
                        @endif
                        @if ($proposta->status == 'pendente')
                            <div class="w-5 h-5 ml-2 rounded-full bg-desicon-yellow">

                            </div>
                        @endif
                        @if ($proposta->status == 'recusada')
                            <div class="w-5 h-5 ml-2 rounded-full bg-desicon-red">

                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        @endisset

    </div>

</div>
