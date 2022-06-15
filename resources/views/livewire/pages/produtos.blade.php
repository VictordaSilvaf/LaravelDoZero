@extends('.livewire.layouts.dashboard-layout')
@section('content')
    <h1 class="text-lg font-light">Produtos</h1>

    <table class="w-full mt-2 border table-auto border-slate-400 bg-desicon-white">
        <thead>
            <tr>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    SKU
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Descrição
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Estoque
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Preço
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Desconto
                </th>
            </tr>
        </thead>
        <tbody>
            @isset($produtos)
                @foreach ($produtos as $produto)
                    <tr>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300 text-center">
                            {{ mb_strimwidth($produto->codigo, 0, 14, '...') }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300" maxlength="10">
                            {{ mb_strimwidth($produto->descricao, 0, 40, '...') }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300 text-center">
                            {{ $produto->estoqueAtual }}
                        </td>
                        <td class="px-2 py-1 font-light text-center text-gray-600 truncate border border-slate-300">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </td>
                        <td class="font-light text-gray-600 border border-slate-300 text-center">
                            @isset($produto->desconto)
                                <a href="#" class="p-1 rounded-lg flex justify-center hover:opacity-50 duration-100">
                                    <x-tabler-discount-2 h='5' w='5' />
                                </a>
                            @endisset
                        </td>

                    </tr>
                @endforeach
            @endisset

        </tbody>
    </table>
    <div class="w-full">
        @isset($produtos)
            {{ $produtos->onEachSide(1)->links() }}
        @endisset
    </div>
@endsection
