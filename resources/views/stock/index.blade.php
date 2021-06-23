@extends('layout.index', ['title' => 'Estoque', 'action' => 'Estoque', 'button' => 'Novo item', 'route' =>
'createStock'])

@section('content')
    <div class="container min-h-screen">
        <div class="overflow-x-auto w-full">
            <table
                class="mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg overflow-hidden sm:shadow-lg my-5 overflow-hidden">
                <thead class="bg-white text-dark-blue">
                    <tr class="rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                        <th class="p-3 text-left">Item</th>
                        <th class="p-3 text-left">Categoria</th>
                        <th class="p-3 text-left">Retirado em</th>
                        <th class="p-3 text-left">Devolvido em</th>
                        <th class="p-3 text-left">Quantidade</th>
                        <th class="p-3 text-left" width="110px">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white opacity-50 text-dark-blue">
                    @foreach ($items as $item)
                        <tr class="mb-2 sm:mb-0">
                            <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $item->item }}</td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">
                                @if ($item->category === null)
                                    {{ 'Sem categoria' }}
                                @else
                                    {{ $item->category->category }}
                                @endif
                            </td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $item->withdrawn_datetime }}
                            </td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $item->returned_datetime }}</td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $item->quantity }}</td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">
                                <a href="{{ route('editItem', $item->id) }}" class="hover:no-underline">
                                    <span
                                        class="text-blue-400 hover:text-blue-600 hover:font-medium cursor-pointer px-2">Editar</span></a>
                                <a href="{{ route('deleteItem', $item->id) }}" class="hover:no-underline">
                                    <span
                                        class="text-red-400 hover:text-red-600 hover:font-medium cursor-pointer px-2">Deletar</span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
