<div class="p-2">
    {{-- top menu --}}
    <div class="flex justify-end w-full gap-3 pr-3">
        <a class="flex items-center justify-center p-1.5 rounded-full bg-desicon-natural5 text-desicon-white opacity-50 {{-- hover:opacity-100 --}} duration-100 disabled"
            disabled>
            <x-entypo-help-with-circle class="w-4 h-4" />
        </a>
        <a class="flex items-center justify-center p-1.5 rounded-full bg-desicon-natural5 text-desicon-white opacity-50 {{-- hover:opacity-100 --}} duration-100 disabled"
            disabled>
            <x-fas-bell class="w-4 h-4" />
        </a>

        <div
            class="flex items-center justify-center duration-100 rounded-full opacity-50 bg-desicon-natural5 w-7 h-7 {{-- hover:opacity-100 --}}">
            <div class="relative w-5 h-5 overflow-hidden rounded-full">
                <svg class="absolute w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg" style="">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd">
                    </path>
                </svg>
            </div>
        </div>

        <!-- Dropdown menu -->
        <div id="userDropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                <div>{{ Auth()->User()->name }}</div>
                <div class="font-medium truncate">{{ Auth()->User()->email }}</div>
            </div>
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformationButton">
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Perfil</a>
                </li>
            </ul>
            <div class="py-1">
                <form action={{ route('logout') }} method="GET"
                    class="block text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                    @csrf
                    <button type="submit"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        Deslogar
                    </button>
                </form>
            </div>
        </div>

    </div>

    {{-- Profile --}}
    <div class="flex flex-col justify-center mt-5 text-center">
        <div class="flex flex-col content-center justify-center w-full ">
            <div style="margin: 0 auto;"
                class="flex items-center justify-center p-2 duration-100 rounded-full opacity-50 bg-desicon-natural5 hover:opacity-60 w-[170px] h-[170px]">
                <div class="w-[130px] h-[130px] rounded-full m-auto bg-desicon-natural5 opacity-50">
                    <svg class="absolute w-[130px] h-[130px] text-white" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" style="">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <p class="mt-1 font-light">{{ Auth()->User()->name }}</p>
        <p class="font-light text-desicon-natural">
            {{ auth()->user()->roles[0]->name == 'admin' ? 'Administrador' : 'Vendedor' }}</p>
    </div>

    {{-- Last actions --}}
    <div class="flex flex-col px-1 mt-8">
        <h2 class="font-medium text-center">Histórico de propostas</h2>

        @isset($propostas)
            @foreach ($propostas as $proposta)
                <a href={{ route('proposta.show', ['id' => $proposta->id]) }}
                    class="flex items-center p-2 mt-2 rounded-lg bg-opacity-80 bg-desicon-natural7">
                    <div class="p-5 ml-1 rounded-full bg-slate-400">

                    </div>
                    <div class="w-full ml-3 ">
                        <h3 class="w-full text-sm truncate">
                            {{ mb_strimwidth($proposta->clientes->nome, 0, 20, '...') }}
                        </h3>
                        <p class="text-sm font-extralight lg:truncate">
                            R$ {{ number_format($proposta->total, 2, ',', '.') }}
                        </p>
                    </div>
                    <div class="flex justify-end w-full pr-4 ">
                        @if ($proposta->status == 'aceita')
                            <div class="w-5 h-5 ml-2 rounded-full bg-desicon-green">

                            </div>
                        @elseif ($proposta->status == 'pendente')
                            <div class="w-5 h-5 ml-2 rounded-full bg-desicon-yellow">

                            </div>
                        @elseif ($proposta->status == 'recusada')
                            <div class="w-5 h-5 ml-2 rounded-full bg-desicon-red">

                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        @endisset

    </div>

</div>
