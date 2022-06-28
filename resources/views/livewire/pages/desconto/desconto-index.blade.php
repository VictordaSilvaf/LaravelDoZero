{{ dd($this->faker->unique()) }}

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

    <div class="flex mt-4">

        <div class="items-center w-1/3">
            <h2 class="items-center">Descontos</h2>
        </div>

        <div class="flex flex-row">
            <form action="{{ route('descontos.importar') }}" method="POST" class="flex" enctype="multipart/form-data">
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

            <form action="{{ route('descontos.exportar') }}" method="GET">
                @csrf
                <button type="submit"
                    class="h-full px-2 ml-4 rounded-lg bg-desicon-blue text-desicon-white ">Exportar</button>
            </form>
        </div>

    </div>

    {{-- <form action="{{ route('desconto.search') }}" method="post" class="d-flex"> --}}
    <form action="#" method="post" class="flex items-center w-full gap-4 mt-2">
        @csrf

        @if (isset($filters) && $filters['busca'] != '')
            <input type="text" placeholder="{{ $filters['busca'] }}" class="w-full rounded" name="busca"
                id="busca" required>
        @else
            <input type="text" placeholder="Buscar desconto" class="w-full rounded" name="busca" id="busca"
                required>
        @endif

        <button type="submit"
            class="button bg-desicon-blue rounded p-1.5 text-desicon-white hover:opacity-80 duration-100">
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

    <table class="w-full mt-2 text-sm border table-auto border-slate-400 bg-desicon-white">
        <thead class="">
            <tr class="">
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">ID</th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">SKU</th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">Descrição</th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">Descontos</th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300"></th>
            </tr>
        </thead>

        <tbody>
            @isset($descontos)
                @foreach ($descontos as $id => $item)
                    {{-- {{ dd($item->produto) }} --}}

                    <tr class="">
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $item->id }}</td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $item->produto->codigo }}</td>

                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            <p data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Disabled popover"
                                id="popUp">
                                {{ mb_strimwidth($item->produto->descricao, 0, 20, '...') }}
                            </p>
                        </td>
                        <td class="text-gray-600 border font-extralight border-slate-300">
                            <div class="grid grid-cols-5">
                                <div class="flex flex-col px-2 text-center truncate ">
                                    @isset($item->quantidade0)
                                        <p>{{ $item->quantidade0 }}</p>
                                        <p>{{ $item->porcentagem0 }}%</p>
                                    @endisset
                                </div>
                                <div class="flex flex-col px-2 text-center truncate">
                                    @isset($item->quantidade1)
                                        <p>{{ $item->quantidade1 }}</p>
                                        <p>{{ $item->porcentagem1 }}%</p>
                                    @endisset
                                </div>
                                <div class="flex flex-col px-2 text-center truncate">
                                    @isset($item->quantidade2)
                                        <p>{{ $item->quantidade2 }}</p>
                                        <p>{{ $item->porcentagem2 }}%</p>
                                    @endisset
                                </div>
                                <div class="flex flex-col px-2 text-center truncate">
                                    @isset($item->quantidade3)
                                        <p>{{ $item->quantidade3 }}</p>
                                        <p>{{ $item->porcentagem3 }}%</p>
                                    @endisset
                                </div>
                                <div class="flex flex-col px-2 text-center truncate">
                                    @isset($item->quantidade4)
                                        <p>{{ $item->quantidade4 }}</p>
                                        <p>{{ $item->porcentagem4 }}%</p>
                                    @endisset
                                </div>
                            </div>
                        </td>

                        <td class="justify-center px-2 py-1 font-light text-gray-600 border border-slate-300">
                            <div class="flex justify-center">
                                <a href="{{ route('descontos.update', $item->id) }}" class="duration-100 hover:opacity-50"
                                    id='adicionarDesconto'>
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
