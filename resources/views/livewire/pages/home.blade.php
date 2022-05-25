@extends('.livewire.layouts.dashboard-layout')
@section('content')
    <div class="flex flex-col">
        <div class="">
           <h2>Dashboard</h2>
           <h3 class="font-light text-desicon-natural">Olá, Victor. Seja bem vindo ao PDV Desicon</h3>
        </div>
        <div class="grid grid-cols-3 gap-1 mt-5">
            <div class="flex p-3 font-light bg-desicon-white rounded-xl">
                <div class="flex flex-col w-2/3 flex-nowrap">
                    <h2 class="text-[.8rem]">Propostas Aceitas</h2>
                    <p class="text-desicon-natural">5672</p>
                    <p class="text-[.8rem] text-desicon-natural">+14% Inc</p>
                </div>
                <div class="flex items-center justify-center w-1/3">
                    <div class="w-12 h-12 rounded-full bg-desicon-green"></div>
                </div>
            </div>
            <div class="flex p-3 font-light bg-desicon-white rounded-xl">
                <div class="flex flex-col w-2/3 flex-nowrap">
                    <h2 class="text-[.8rem]">Propostas Aceitas</h2>
                    <p class="text-desicon-natural">5672</p>
                    <p class="text-[.8rem] text-desicon-natural">+14% Inc</p>
                </div>
                <div class="flex items-center justify-center w-1/3">
                    <div class="w-12 h-12 rounded-full bg-desicon-yellow"></div>
                </div>
            </div>
            <div class="flex p-3 font-light bg-desicon-white rounded-xl">
                <div class="flex flex-col w-2/3 flex-nowrap">
                    <h2 class="text-[.8rem] whitespace-nowrap">Propostas Aceitas</h2>
                    <p class="text-desicon-natural">5672</p>
                    <p class="text-[.8rem] text-desicon-natural">+14% Inc</p>
                </div>
                <div class="flex items-center justify-center w-1/3">
                    <div class="w-12 h-12 rounded-full bg-desicon-red"></div>
                </div>
            </div>
            
            <div class="flex flex-col col-span-3 p-3 mt-3 mb-3 font-light bg-desicon-white rounded-xl">
                <div class="flex flex-row">
                    <div class="flex">
                        <h2 class="whitespace-nowrap">Gráfico Status Propostas Comerciais</h2>
                    </div>
                    <div class="flex justify-end w-full">
                        <div>a</div>
                    </div>
                </div>
                <div class="mt-4 bg-red-600">
                    a
                </div>
            </div>

            <div class="flex flex-col col-span-2 p-3 mr-2 font-light bg-desicon-white rounded-xl">
                <h2 class="whitespace-nowrap">Atividades Recentes</h2>
                <a href="#" class="flex flex-row items-center p-1 mt-2 rounded hover:bg-desicon-natural7 hover:bg-opacity-50">
                    <div class="">
                        <div class="w-8 h-8 bg-gray-500 rounded-full"></div>
                    </div>
                    
                    <div class="flex flex-col w-full px-2">
                        <h2 class="text-sm font-extralight">Marvin McKinney aceitou a proposta de Arthur Freitas</h2>
                        <p class="mt-1 text-xs font-thin">10 mins ago</p>
                    </div>
                    
                    <div class="">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-opacity-30 bg-desicon-green text-desicon-green">
                            +
                        </div>
                    </div>
                </a>

                <a href="#" class="flex flex-row items-center p-1 mt-2 rounded hover:bg-desicon-natural7 hover:bg-opacity-50">
                    <div class="">
                        <div class="w-8 h-8 bg-gray-500 rounded-full"></div>
                    </div>
                    
                    <div class="flex flex-col w-full px-2">
                        <h2 class="text-sm font-extralight">Thiago recusou a proposta de Edinaldo</h2>
                        <p class="mt-1 text-xs font-thin">10 mins ago</p>
                    </div>
                    
                    <div class="">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-opacity-30 bg-desicon-red text-desicon-red">
                            -
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="flex flex-col p-3 font-light bg-desicon-white rounded-xl">
                <h2 class="whitespace-nowrap">Útimos Descontos</h2>
                <a href="#" class="flex flex-col p-1 mt-2 rounded hover:bg-desicon-natural7 hover:bg-opacity-50">
                    <div class="flex flex-col w-full ">
                        <h2 class="text-sm font-extralight">Rodízios</h2>
                        <p class="text-xs font-thin">10 mins ago</p>
                    </div>
                </a>

                <a href="#" class="flex flex-col p-1 mt-2 rounded hover:bg-desicon-natural7 hover:bg-opacity-50">
                    <div class="flex flex-col w-full ">
                        <h2 class="text-sm font-extralight">Prolongador</h2>
                        <p class="text-xs font-thin">25 mins ago</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
    
@endsection
