@extends('.livewire.layouts.dashboard-layout')
@section('content')
    @if (session('msgErro'))
        <div class="w-full p-3 rounded-lg bg-desicon-red text-desicon-white">
            <p class="msg" style="text-align: center;">{{ session('msgErro') }}</p>
        </div>
    @endif
    @if (session('msg'))
        <div class="w-full p-3 rounded-lg bg-desicon-green text-desicon-white">
            <p class="msg" style="text-align: center;">{{ session('msg') }}</p>
        </div>
    @endif

    <div class="flex col-lg-12">

        <div class="w-full">
            <h2>Descontos</h2>
        </div>
        @can('admin')
            <div class="col-lg-2">
                <form action="{{ route('exportModeloDescontoEsc') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-success"> Modelo Excel</button>
                </form>
            </div>

            <div class="col-lg-2">
                <form action="{{ route('importDescontoEsc') }}" method="POST" id="formImporteDescontoEsc"
                    enctype="multipart/form-data">
                    @csrf
                    <label for="fileDescontoEsc" class="btn" style="background: #198754; color:#fff">
                        Importar dados </label>
                    <input type='file' id="fileDescontoEsc" accept=".xlsx" name="fileDescontoEsc"
                        onchange="document.getElementById('formImporteDescontoEsc').submit();" style="visibility:hidden;">
                </form>
            </div>
        @endcan

    </div>

    {{-- <form action="{{ route('desconto.search') }}" method="post" class="d-flex"> --}}
    <form action="#" method="post" class="flex items-center w-full gap-4 mt-2">
        @csrf

        @if (isset($filters) && $filters['busca'] != '')
            <input type="text" placeholder="{{ $filters['busca'] }}" class="w-full rounded" name="busca" id="busca">
        @else
            <input type="text" placeholder="Buscar desconto" class="w-full rounded" name="busca" id="busca">
        @endif

        <button type="submit" class="button bg-desicon-blue rounded p-1.5 text-desicon-white hover:opacity-80 duration-100">
            <x-heroicon-o-search class="w-6 h-6" />
        </button>
        {{-- @can('admin') --}}
        <a href={{ route('descontos.create') }}
            class="button bg-desicon-blue rounded p-1.5 text-desicon-white hover:opacity-80 duration-100"
            id='adicionarDesconto'>
            <x-ri-add-fill class="w-6 h-6" />
        </a>
        {{-- @endcan --}}
    </form>

    <table class="w-full mt-2 border table-auto border-slate-400 bg-desicon-white">
        <thead class="">
            <tr class="">
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">ID</th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">SKU</th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">Descrição</th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">Descontos</th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">

                </th>
            </tr>
        </thead>

        <tbody>
            @isset($descontos)

                @foreach ($descontos as $id => $item)
                    {{-- {{ dd($item->produto) }} --}}

                    <tr>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $item->id }}</td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $item->produto->codigo }}</td>

                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            <p data-bs-toggle="popover" data-bs-trigger="hover focus"
                                data-bs-content="Disabled popover" id="popUp">
                                {{ mb_strimwidth($item->produto->descricao, 0, 35, '...') }}
                            </p>
                        </td>
                        <td class="font-light text-gray-600 border border-slate-300">
                            <div class="grid grid-cols-5">
                                @for ($cont2 = 0; $cont2 < 5; ++$cont2)
                                    <div class="flex flex-col px-2 text-center">
                                        @isset($item->dados[0]['quantidade' . $cont2])
                                            <p>{{ $item->dados[0]['quantidade' . $cont2] }}</p>
                                            <p>{{ $item->dados[0]['porcentagem' . $cont2] }}%</p>
                                        @endisset
                                    </div>
                                @endfor
                            </div>
                        </td>

                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            <div class="flex">
                                <a href="{{ route('descontos.update', $item->id) }}" class="duration-100 hover:opacity-50" id='adicionarDesconto'>
                                    <x-feathericon-edit class="w-5 h-5" />
                                </a>

                                <form action="{{ route('descontos.destroy', $item->id) }}" method="POST" class="ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="duration-100 hover:opacity-50">
                                        <x-heroicon-o-trash class="w-5 h-5" />
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
    <div class="w-full">
        @isset($descontos)
            {{ $descontos->onEachSide(1)->links() }}
        @endisset
    </div>
@endsection
