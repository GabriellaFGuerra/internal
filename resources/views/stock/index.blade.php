@extends('layout.index', ['title' => 'Estoque', 'action' => 'Estoque', 'button' => 'Novo item', 'route' => 'createStock'])

@section('content')
    <div class="container min-h-screen">
        <div class="overflow-x-auto w-full">
            <table
                class="mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg overflow-hidden sm:shadow-lg my-5 overflow-hidden">
                <thead class="bg-white text-dark-blue">
                    <tr class="rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                        <th class="p-3 text-left">Item</th>
                        <th class="p-3 text-left">Categoria</th>
                        <th class="p-3 text-left">Quantidade</th>
                        <th class="p-3 text-left">Preço total</th>
                        <th class="p-3 text-left">Fornecedor</th>
                        <th class="p-3 text-left">Chave</th>
                        <th class="p-3 text-left" width="110px">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white opacity-50 text-dark-blue">
                    @foreach ($purchases as $purchase)
                        <tr class="mb-2 sm:mb-0">
                            <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $purchase->item }}</td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">
                                @if ($purchase->category === null)
                                    {{ 'Sem categoria' }}
                                @else
                                    {{ $purchase->category->category }}
                                @endif
                            </td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $purchase->quantity }}</td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $purchase->total_value }}</td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $purchase->provider }}</td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $purchase->invoice_key }}</td>
                            <td
                                class="border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer">
                                Deletar</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
