@extends('.livewire.layouts.dashboard-layout')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/propostaComercial/create.css') }}">

    <div class="">

        {{-- Conteudo Formulario --}}
        <div class="text-center">
            <h2>Cadastro proposta comercial</h2>
        </div>

        {{-- Mesagens de erro --}}
        @if (session('msgErro'))
            <div class="alert alert-danger">
                <p class="msg" style="text-align: center;">{{ session('msgErro') }}</p>
            </div>
        @endif
        @if (session('msg'))
            <div class="alert alert-success">
                <p class="msg" style="text-align: center;">{{ session('msg') }}</p>
            </div>
        @endif

        {{-- Formulario de criação de proposta --}}
        {{-- <form class="w-full max-w-lg" action="{{ route('propostaComercial.store') }}" method="POST" --}}

        <div class="grid px-5 text-right">
            <h3>Dados do Cliente</h3>
        </div>

        {{-- Sessão busca --}}
        <livewire:pc.show-client />

        <div class="grid px-5 text-right">
            <h3>Lista de Produtos</h3>
        </div>

        {{-- Buscar produto --}}
        <livewire:pc.show-products />

        <div class="grid px-5 text-right">
            <h3>Dados da Transportadora</h3>
        </div>

        <livewire:pc.form-create />
    </div>

    <script>
        /* Masca CPF/CNPJ */
        function formatarCampo(campoTexto) {
            if (campoTexto.value.length <= 11) {
                campoTexto.value = mascaraCpf(campoTexto.value);
            } else {
                campoTexto.value = mascaraCnpj(campoTexto.value);
            }
        }

        function retirarFormatacao(campoTexto) {
            campoTexto.value = campoTexto.value.replace(/(\.|\/|\-)/g, "");
        }

        function mascaraCpf(valor) {
            return valor.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3\-\$4");
        }

        function mascaraCnpj(valor) {
            return valor.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3\/\$4\-\$5");
        }
    </script>
@endsection
