@extends('.livewire.layouts.dashboard-layout')
@section('content')
    <h1 class="text-lg font-light">Propostas {{ $status }}</h1>

    <table class="w-full mt-4 border table-auto border-slate-400 bg-desicon-white">
        <thead>
            <tr>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    ID
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Vendedor
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    CPF Cliente
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    Total
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">
                    data
                </th>
                <th class="px-2 py-2 font-normal bg-gray-200 border border-slate-300">

                </th>
            </tr>
        </thead>
        <tbody>
            @isset($propostas)
                @foreach ($propostas as $proposta)
                    <tr>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $proposta->id }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $proposta->users_id }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $proposta->clientes_id }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $proposta->total }}
                        </td>
                        <td class="px-2 py-1 font-light text-gray-600 border border-slate-300">
                            {{ $proposta->updated_at }}
                        </td>
                        <td class="px-2 py-1 font-light text-center text-gray-600 duration-150 border border-slate-300 hover:opacity-80">
                            <button class="p-3 rounded-lg bg-desicon-blue"></button>
                        </td>
                    </tr>
                @endforeach
            @endisset

        </tbody>
    </table>
@endsection
