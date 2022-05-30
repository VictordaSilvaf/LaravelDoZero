<div class="flex flex-col justify-center">
    <div class="flex items-center justify-center">
        <span>Desicon</span>
    </div>
    <div class="flex flex-col mt-3">
        <div class="flex flex-col">
            <h2 class="px-5 py-3 text-sm rounded-xl font-medium">Menu</h2>
            <a class="px-5 py-2 text-sm text-white bg-desicon-blue rounded-xl" href="#">
                Dashboard
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl text-desicon-natural5 hover:bg-slate-100" href="#">
                Mensagens
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl text-desicon-natural5 hover:bg-slate-100" href="#">
                Calendário
            </a>
        </div>
        <div class="flex flex-col mt-3">
            <h2 class="px-5 py-3 text-sm rounded-xl font-medium">Proposta Comercial</h2>

            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl text-desicon-natural5 hover:bg-slate-100"
                href={{ route('proposta.create') }}>
                Cadastrar Proposta
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl text-desicon-natural5 hover:bg-slate-100"
                href="propostas?stats=aceitas">
                Propostas Aceitas
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl text-desicon-natural5 hover:bg-slate-100"
                href="propostas?stats=pendentes">
                Propostas Pendentes
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl text-desicon-natural5 hover:bg-slate-100"
                href="propostas?stats=recusadas">
                Propostas Recusadas
            </a>

        </div>
        <div class="flex flex-col mt-3">
            <h2 class="px-5 py-3 text-sm rounded-xl font-medium">Outros</h2>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl text-desicon-natural5 hover:bg-slate-100" href="#">
                Produtos
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl text-desicon-natural5 hover:bg-slate-100" href="#">
                Descontos
            </a>
            <a class="px-5 py-2 mt-1 text-sm duration-200 rounded-xl text-desicon-natural5 hover:bg-slate-100" href="#">
                Análise de Margem
            </a>
        </div>
    </div>
</div>
