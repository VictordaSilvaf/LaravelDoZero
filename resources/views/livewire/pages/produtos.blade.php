@extends('.livewire.layouts.dashboard-layout')
@section('content')
    <h1 class="text-lg font-light">Produtos</h1>

    <table class="w-full mt-4 border table-auto border-slate-400 bg-desicon-white">
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
                    <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                      {{ $produto->codigo }}
                    </td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $produto->descricao }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $produto->estoqueAtual }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                          {{ $produto->preco }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                          arrumar
                        </td>
                    </tr>
                @endforeach
            @endisset

        </tbody>
    </table>
@endsection
