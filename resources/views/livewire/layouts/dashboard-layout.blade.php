@extends('layouts.base')
@section('body')
    <div class="min-h-screen lg:min-h-fit">
        <nav
            class="mt-0 w-full bg-desicon-blue border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-gray-900 block lg:hidden absolute z-10">

            <div class="container flex flex-wrap items-center justify-between mx-auto mdflex-col md:flex-col">
                <a href="https://flowbite.com/" class="flex items-center">
                    <span class="self-center text-xl font-semibold text-white whitespace-nowrap">DesiconPDV</span>
                </a>
                <button data-collapse-toggle="mobile-menu" type="button"
                    class="inline-flex items-center p-2 ml-3 text-sm text-white duration-75 duration-150 rounded-lg md:hidden hover:opacity-70 focus:outline-none focus:ring-2 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Abrir menu princpal</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg class="hidden w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                <div class="hidden w-full mt-2 md:block md:w-auto" id="mobile-menu">
                    <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                        <li>
                            <a href={{ route('dashboard.home') }} title="Dashboard"
                                class="block py-2 pl-3 md:px-2 pr-4 text-white duration-150 border-gray-100 hover:bg-gray-50 hover:bg-opacity-20 md:hover:bg-transparent md:border-0 md:hover:text-desicon-orange dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 {{ request()->is('dashboard/home') ? 'rounded-md bg-white bg-opacity-20 hover:bg-opacity-10 hover:text-desicon-orange p-0 md:p-2 sm:p-2' : '' }}">Dashboard</a>
                        </li>
                        {{-- <li>
                            <a href="#"
                                class="block py-2 pl-3 md:px-2 pr-4 text-white duration-150 border-gray-100 hover:bg-gray-50 hover:bg-opacity-20 md:hover:bg-transparent md:border-0 md:hover:text-desicon-orange dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 {{ request()->is('dashboard/mensagens') ? 'rounded-md bg-white bg-opacity-20 hover:bg-opacity-10 hover:text-desicon-orange' : 'md:hover:text-desicon-orange md:hover:bg-transparent ' }}">Mensagens</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pl-3 md:px-2 pr-4 text-white duration-150 border-b border-gray-100 hover:bg-gray-50 hover:bg-opacity-20 md:hover:bg-transparent md:border-0 md:hover:text-desicon-orange dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 {{ request()->is('dashboard/calendario') ? 'rounded-md bg-white bg-opacity-20 hover:bg-opacity-10 hover:text-desicon-orange' : 'md:hover:text-desicon-orange md:hover:bg-transparent ' }}">Calendário</a>
                        </li> --}}
                        <li>
                            <a href="{{ route('propostas.index') }}"
                                class="block py-2 pl-3 md:px-2 pr-4 md:text-center text-white duration-150 border-gray-100 hover:bg-gray-50 hover:bg-opacity-20 md:hover:bg-transparent md:border-0 md:hover:text-desicon-orange dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 {{ request()->is('dashboard/propostas') ? 'rounded-md bg-white bg-opacity-20 hover:bg-opacity-10 hover:text-desicon-orange' : 'md:hover:text-desicon-orange md:hover:bg-transparent ' }}">Propostas</a>
                        </li>
                        <li>
                            <a href={{ route('proposta.create') }}
                                class="block py-2 pl-3 md:px-2 pr-4 text-white duration-150 hover:bg-gray-50 hover:bg-opacity-20  md:border-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent truncate 
                                {{ request()->is('dashboard/proposta/cadastrar') ? 'rounded-md bg-white bg-opacity-20 hover:bg-opacity-10 hover:text-desicon-orange' : 'md:hover:text-desicon-orange md:hover:bg-transparent ' }}">Cadastrar
                                Proposta</a>
                        </li>
                        <li>
                            <a href={{ route('dashboard.produtos') }}
                                class="block py-2 pl-3 md:px-2 pr-4 text-white duration-150 border-gray-100 hover:bg-gray-50 hover:bg-opacity-20 md:hover:bg-transparent md:border-0 md:hover:text-desicon-orange dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 {{ request()->is('dashboard/produtos') ? 'rounded-md bg-white bg-opacity-20 hover:bg-opacity-10 hover:text-desicon-orange' : 'md:hover:text-desicon-orange md:hover:bg-transparent ' }}">Produtos</a>
                        </li>
                        <li>
                            <a href={{ route('descontos.index') }}
                                class="block py-2 pl-3 md:px-2 pr-4 text-white duration-150 border-gray-100 hover:bg-gray-50 hover:bg-opacity-20 md:hover:bg-transparent md:border-0 md:hover:text-desicon-orange dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 {{ request()->is('dashboard/descontos') ? 'rounded-md bg-white bg-opacity-20 hover:bg-opacity-10 hover:text-desicon-orange' : 'md:hover:text-desicon-orange md:hover:bg-transparent ' }}">Descontos</a>
                        </li>
                        {{-- <li>
                            <a href="#"
                                class="disabled block py-2 pl-3 md:px-2 pr-4 text-white duration-150 border-gray-100 hover:bg-gray-50 hover:bg-opacity-20 md:hover:bg-transparent md:border-0 md:hover:text-desicon-orange dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 {{ request()->is('dashboard/analise') ? 'rounded-md bg-white bg-opacity-20 hover:bg-opacity-10 hover:text-desicon-orange' : 'md:hover:text-desicon-orange md:hover:bg-transparent ' }}">Margem</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>

        <div class="grid grid-cols-5 overflow-hidden overflow-x-hidden">
            <div class="hidden h-screen max-h-screen px-2 py-5 overflow-hidden bg-desicon-white lg:block">
                @livewire('components.left-menu')
            </div>

            <div
                class="mt-11 sm:mt-12 md:mt-12 lg:mt-0 max-h-screen lg:min-h-screen lg:max-h-screen lg:col-span-3 col-span-5 bg-[#F5F6FA] px-7 py-5 overflow-y-auto w-full overflow-x-hidden">
                @yield('content')
            </div>

            <div class="hidden h-screen max-h-screen overflow-x-hidden overflow-y-auto bg-desicon-white lg:block">
                @livewire('components.right-menu')
            </div>
        </div>
    </div>
@endsection
