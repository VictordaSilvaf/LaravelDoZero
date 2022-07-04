<div class="p-2">
    {{-- top menu --}}
    <div class="flex justify-end w-full gap-3 pr-3">
        <a href="#"
            class="flex items-center justify-center p-1.5 rounded-full bg-desicon-natural5 text-desicon-white opacity-50 hover:opacity-100 duration-100">
            <x-entypo-help-with-circle class="w-4 h-4" />
        </a>
        <a href="#"
            class="flex items-center justify-center p-1.5 rounded-full bg-desicon-natural5 text-desicon-white opacity-50 hover:opacity-100 duration-100">
            <x-fas-bell class="w-4 h-4" />
        </a>
        
        <img id="avatar" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="rounded-full cursor-pointer h-7 w-7"
        @if (Auth()->user()->avatar != 'default.jpg')
            src="{{ asset('storage/images/' . auth()->user()->avatar) }}"
        @else
            src="https://random.imagecdn.app/500/500"
        @endif
        alt="User dropdown">

        
        <!-- Dropdown menu -->
        <div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
            <div>{{ Auth()->User()->name }}</div>
            <div class="font-medium truncate">{{ Auth()->User()->email }}</div>
            </div>
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformationButton">
            <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Perfil</a>
            </li>
{{--             <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
            </li> --}}
{{--             <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
            </li> --}}
            </ul>
            <div class="py-1">
                <form action={{ route('logout') }} method="POST" class="block text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                    @csrf
                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        Deslogar
                    </button>
                </form>
            </div>
        </div>
        
    </div>

    {{-- Profile --}}
    <div class="flex flex-col justify-center mt-5 text-center">
        <div class="w-[150px] h-[150px] rounded-full m-auto">
            <img src="https://random.imagecdn.app/500/500" alt="" class="rounded-full">
        </div>
        <p class="mt-1 font-light">{{ Auth()->User()->name }}</p>
        <p class="font-light text-desicon-natural">{{ (auth()->user()->roles[0]->name == 'admin') ? "Administrador" : "Vendedor" }}</p>
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
                    <div class="ml-3">
                        <h3 class="text-sm truncate">
                            {{ mb_strimwidth($proposta->clientes->nome, 0, 20, '...') }}
                        </h3>
                        <p class="text-sm font-extralight ">
                            R$ {{ number_format($proposta->total, 2, ',', '.') }}
                        </p>
                    </div>
                    <div class="flex justify-end w-full pr-4 ">
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
