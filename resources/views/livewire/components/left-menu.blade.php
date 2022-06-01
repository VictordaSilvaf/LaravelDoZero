<div class="flex flex-col justify-center">
    <div class="flex items-center justify-center">
        <span>Desicon</span>
    </div>
    <div class="flex flex-col mt-3">
        <div class="flex flex-col">
            <h2 class="px-5 py-3 text-sm font-medium rounded-xl">Menu</h2>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl  {{ (request()-> is('dashboard/home')) ? 'text-white bg-desicon-blue hover:bg-opacity-50' : 'text-desicon-natural5 hover:bg-slate-100' }}" href={{ route('dashboard.home') }} title="Dashboard">
                Dashboard
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl  {{ (request()-> is('dashboard/mensagens')) ? 'text-white bg-desicon-blue hover:bg-opacity-50' : 'text-desicon-natural5 hover:bg-slate-100' }}" href="#" data-bs-toggle="tooltip"
            data-bs-placement="left" title="Mensagens">
                Mensagens
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl  {{ (request()-> is('dashboard/calendario')) ? 'text-white bg-desicon-blue hover:bg-opacity-50' : 'text-desicon-natural5 hover:bg-slate-100' }}" href="#" data-bs-toggle="tooltip"
            data-bs-placement="left" title="Calendario">
                Calendário
            </a>
        </div>
        <div class="flex flex-col mt-3">
            <h2 class="px-5 py-3 text-sm font-medium rounded-xl">Proposta Comercial</h2>

            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl  {{ (request()-> is('dashboard/proposta/cadastrar')) ? 'text-white bg-desicon-blue hover:bg-opacity-50' : 'text-desicon-natural5 hover:bg-slate-100' }}" href={{ route('proposta.create') }} title="Cadastrar Proposta">
                {{ __('Cadastrar Proposta') }}
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl  {{ (request()-> is('dashboard/propostas?stats=aceitas')) ? 'text-white bg-desicon-blue hover:bg-opacity-50' : 'text-desicon-natural5 hover:bg-slate-100' }}"
                href="/dashboard/propostas?stats=aceitas">
                Propostas Aceitas
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl  {{ (request()-> is('dashboard/propostas?stats=pendentes')) ? 'text-white bg-desicon-blue hover:bg-opacity-50' : 'text-desicon-natural5 hover:bg-slate-100' }}"
                href="/dashboard/propostas?stats=pendentes">
                Propostas Pendentes
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl  {{ (request()-> is('dashboard/propostas?stats=recusadas')) ? 'text-white bg-desicon-blue hover:bg-opacity-50' : 'text-desicon-natural5 hover:bg-slate-100' }}"
                href="/dashboard/propostas?stats=recusadas">
                Propostas Recusadas
            </a>

        </div>
        <div class="flex flex-col mt-3">
            <h2 class="px-5 py-3 text-sm font-medium rounded-xl">Outros</h2>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl  {{ (request()-> is('dashboard/produtos')) ? 'text-white bg-desicon-blue hover:bg-opacity-50' : 'text-desicon-natural5 hover:bg-slate-100' }}" href={{ route('dashboard.produtos') }}>
                Produtos
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl  {{ (request()-> is('dashboard/descontos')) ? 'text-white bg-desicon-blue hover:bg-opacity-50' : 'text-desicon-natural5 hover:bg-slate-100' }}" href={{ route('dashboard.descontos') }}>
                Descontos
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl  {{ (request()-> is('dashboard/analise')) ? 'text-white bg-desicon-blue hover:bg-opacity-50' : 'text-desicon-natural5 hover:bg-slate-100' }}" href="#">
                Análise de Margem
            </a>
        </div>
    </div>
</div>
