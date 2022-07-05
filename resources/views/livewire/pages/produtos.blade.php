@extends('.livewire.layouts.dashboard-layout')
@section('content')

    {{-- Mesagens de erro --}}
    @if (session('msgErro'))
        <div class="w-full p-2 mb-2 bg-red-600 rounded-lg text-desicon-white">
            <p class="msg" style="text-align: center;">{{ session('msgErro') }}</p>
        </div>
    @endif
    @if (session('msg'))
        <div class="w-full p-2 mb-2 rounded-lg bg-desicon-green text-desicon-white">
            <p class="msg" style="text-align: center;">{{ session('msg') }}</p>
        </div>
    @endif
    <h1 class="text-lg font-light">Produtos</h1>

    <div class="grid grid-cols-6">
        <div class="flex flex-row col-span-4">
            <form action="{{ route('produtos.importar') }}" method="POST" class="flex" enctype="multipart/form-data">
                @csrf
                <input
                    class="block w-full pr-4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                    id="file_input" name="file_input" type="file" required>

                @error('file_input')
                    <span class="error">{{ $message }}</span>
                @enderror

                <button type="submit"
                    class="h-full px-2 ml-2 rounded-lg bg-desicon-blue text-desicon-white">Importar</button>
            </form>

            <form action="{{ route('produtos.exportar') }}" method="GET">
                @csrf
                <button type="submit"
                    class="h-full px-2 ml-4 rounded-lg bg-desicon-blue text-desicon-white ">Exportar</button>
            </form>
        </div>

        <form action="{{ route('dashboard.produtos.adicionar') }}" wire:submit.prevent='adicionarProduto'
            class="col-span-2" method="POST">
            @csrf
            <div class="flex justify-end w-full">
                <div class="mr-1">
                    <input type="text" name="skuProduto" id="skuProduto" class="rounded-lg"
                        placeholder="Adicionar produto" wire:model='skuProduto' required>
                </div>

                <button href="" type="submit" class="p-2 rounded-lg bg-desicon-blue text-desicon-white">
                    <x-ri-add-fill class="w-6 h-6" />
                </button>
            </div>
        </form>
    </div>

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
                        <td class="px-2 py-1 font-light text-center text-gray-600 border border-slate-300">
                            {{ mb_strimwidth($produto->codigo, 0, 14, '...') }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300" maxlength="10">
                            {{ mb_strimwidth($produto->descricao, 0, 40, '...') }}
                        </td>
                        <td class="px-2 py-1 font-light text-center text-gray-600 border border-slate-300">
                            {{ $produto->estoqueAtual }}
                        </td>
                        <td class="px-2 py-1 font-light text-center text-gray-600 truncate border border-slate-300">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </td>
                        <td class="font-light text-center text-gray-600 border jstify-center border-slate-300">
                            @isset($produto->desconto)
                                <a href="{{ route('descontos.update', ['id' => $produto->desconto->id]) }}"
                                    class="flex justify-center p-1 duration-100 rounded-lg hover:opacity-50">
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
