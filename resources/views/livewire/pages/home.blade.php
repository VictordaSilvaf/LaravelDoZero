    <div class="flex flex-col w-full">

        <div class="w-full">
            <h2 class="font-medium">Dashboard</h2>
            <h3 class="font-light text-desicon-natural">Olá, Victor. Seja bem vindo ao PDV Desicon</h3>
        </div>

        <div class="flex justify-between w-full mt-5">
            <div class="flex w-1/3 p-3 font-light bg-desicon-white rounded-xl">
                <div class="flex flex-col w-2/3 flex-nowrap">
                    <h2 class="text-[.8rem] lg:whitespace-nowrap">Propostas Aceitas</h2>
                    <p class="text-desicon-natural">{{ $propostas->where('status', 'aceita')->count() }}</p>
                    <p class="text-[.8rem] text-desicon-natural">+14% Inc</p>
                </div>
                <div class="flex items-center justify-center w-1/3">
                    <div class="w-6 h-6 rounded-full lg:w-8 lg:h-8 bg-desicon-green"></div>
                </div>
            </div>

            <div class="flex w-1/3 p-3 ml-3 font-light bg-desicon-white rounded-xl">
                <div class="flex flex-col w-2/3 flex-nowrap">
                    <h2 class="text-[.8rem] lg:whitespace-nowrap">Propostas Pendentes</h2>
                    <p class="text-desicon-natural">
                        {{ $propostas->where('status', 'pendente')->count() }}
                    </p>
                    <p class="text-[.8rem] text-desicon-natural">+14% Inc</p>
                </div>
                <div class="flex items-center justify-center w-1/3">
                    <div class="w-6 h-6 rounded-full lg:w-8 lg:h-8 bg-desicon-yellow"></div>
                </div>
            </div>

            <div class="flex w-1/3 p-3 ml-3 font-light bg-desicon-white rounded-xl ">
                <div class="flex flex-col w-2/3">
                    <h2 class="text-[.8rem] lg:whitespace-nowrap">Propostas Recusadas</h2>
                    <p class="text-desicon-natural">
                        {{ $propostas->where('status', 'recusada')->count() }}
                    </p>
                    <p class="text-[.8rem] text-desicon-natural">+14% Inc</p>
                </div>
                <div class="flex items-center justify-center w-1/3">
                    <div class="w-6 h-6 rounded-full lg:w-8 lg:h-8 bg-desicon-red"></div>
                </div>
            </div>
        </div>

        {{-- Gráfico --}}
        <div class="flex flex-col w-full col-span-3 p-3 mt-3 mb-3 font-light bg-desicon-white rounded-xl">
            <div class="flex flex-row">
                <div class="flex">
                    <h2 class="font-medium whitespace-nowrap">Análise mensal</h2>
                </div>
                <div class="flex justify-end w-full pr-2">
                    <div>{{ now()->year }}</div>
                </div>
            </div>

            <div class="w-full mt-4">
                {!! $chartjs->render() !!}
            </div>

        </div>

        <div class="grid w-full grid-cols-5 gap-4">

            <div class="col-span-3 p-3 font-light truncate bg-desicon-white rounded-xl">
                <h2 class="text-sm font-medium sm:text-base">Atividades recentes</h2>
                @foreach ($paginacaoPropostas as $p)
                    <a href="{{ route('proposta.show', $p->id) }}"
                        class="flex flex-row items-center p-1 mt-2 rounded hover:bg-desicon-natural7 hover:bg-opacity-50">
                        <div class="flex flex-col w-full px-2">
                            <div class="relative flex w-6/8 ">
                                <p class="block text-sm break-normal whitespace-normal font-extralight">
                                    {{ $p->users->name }}
                                    aceitou a proposta de
                                    {{ $p->clientes->nome }}
                                </p>
                            </div>
                            <div class="w-2/8">
                                <p class="mt-1 text-xs font-thin">10 mins ago</p>
                            </div>
                        </div>

                        <div class="">
                            <div
                                class="flex items-center justify-center w-8 h-8 rounded-lg bg-opacity-30 bg-desicon-green text-desicon-green">
                                +
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="col-span-2 p-3 font-light truncate bg-desicon-white rounded-xl">
                <h2 class="text-sm font-medium sm:text-base">Útimos descontos</h2>
                @foreach ($descontos as $desconto)
                    <a href="#" class="flex flex-col rounded hover:bg-desicon-natural7 hover:bg-opacity-50">
                        <div class="flex flex-col w-full py-1 ">
                            <div class="w-full px-2 truncate">
                                <h2 class="text-xs break-normal whitespace-normal sm:text-sm font-extralighttruncate">
                                    {{ $descontos->first()->produto->descricao }}</h2>
                            </div>

                            <div class="w-full px-2 py-1 truncate">
                                <p class="w-full text-xs font-thin truncate">
                                    {{ $descontos->first()->produto->updated_at }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    </div>
