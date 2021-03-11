@extends('layout.index', ['title' => 'Estoque'])

@section('content')
    <table class="overflow-x-auto w-full" id="table">
        <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">
                ID
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">
                Item
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">
                Quantidade
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">
                Retirado em
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">
                Devolvido em
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">
                Categoria
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">
                Ações
            </th>
        </tr>
        </thead>
        <tbody class="text-gray-600 divide-y divide-gray-300">
        @foreach ($stocks as $stock)
            <tr class="bg-white font-medium divide-y divide-gray-200">
                <td class="p-4 whitespace-nowrap">
                    {{$stock->id}}
                </td>
                <td class="p-4 whitespace-nowrap">
                    {{$stock->item}}
                </td>
                <td class="p-4 whitespace-nowrap">
                    {{$stock->quantity}}
                </td>
                <td class="p-4 whitespace-nowrap">
                    {{$stock->withdrawn_datetime->format('d/m/Y H:i')}}
                </td>
                <td class="p-4 whitespace-nowrap">
                    {{$stock->returned_datetime->format('d/m/Y H:i')}}
                </td>
                <td class="p-4 whitespace-nowrap">
                    <span
                        class="rounded bg-green-400 py-1 px-3 text-xs font-bold">
                        {{$stock->category->category}}
                    </span>
                </td>
                <td class="p-4 whitespace-nowrap">
                    <button class="text-blue-500 hover:text-blue-600 hover:underline focus:outline-none"
                            onclick="document.getElementById('edit{{$stock->id}}').showModal()">Editar
                    </button>
                </td>
            </tr>
            <script>
                $(document).ready(function () {
                    $('#grid-category{{ $stock->id }}').select2({
                        dropdownParent: $('#edit{{ $stock->id }}')
                    });
                });
            </script>

            <dialog id="edit{{$stock->id}}" class="p-5 bg-white rounded-md md:w-1/2 sm:w-full h-auto">
                <form action="{{ route('editStock')}}" method="POST">
                    @csrf
                    <div class="flex flex-col">
                        <div class="flex w-full h-auto justify-center items-center">
                            <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                                Editar {{$stock->item}}
                            </div>
                            <div onclick="document.getElementById('edit{{$stock->id}}').close();"
                                 class="flex w-1/12 h-auto justify-center cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </div>
                        </div>

                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                            <div class="-mx-3 md:flex mb-6">
                                <div class="md:w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                           for="grid-name">
                                        Item
                                    </label>
                                    <input
                                        name="name"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                                        value="{{$stock->item}}"
                                        id="grid-name" type="text" placeholder="Item"
                                    >
                                </div>
                            </div>

                            <div class="md:w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                       for="grid-quantity">
                                    Quantidade
                                </label>
                                <input
                                    name="quantity"
                                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                                    value="{{$stock->quantity}}"
                                    id="grid-quantity" type="number" placeholder="Quantidade">
                            </div>

                            <div class="-mx-3 md:flex mb-6 flex-row">
                                <div class="md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                           for="grid-taken">
                                        Retirado em
                                    </label>
                                    <input
                                        name="withdrawn"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                        value="{{date('Y-m-d\TH:i', strtotime($stock->withdrawn_datetime))}}"
                                        id="grid-taken" type="datetime-local">
                                </div>

                                <div class="md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                           for="grid-returned">
                                        Devolvido em
                                    </label>
                                    <input
                                        name="returned"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                        value="{{date('Y-m-d\TH:i', strtotime($stock->returned_datetime))}}"
                                        id="grid-returned" type="datetime-local">
                                </div>
                            </div>

                            <div class="w-full px-3">
                                <label
                                    class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                    for="grid-category{{ $stock->id }}">
                                    Categoria
                                </label>
                                <select
                                    name="category_id"
                                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                    id="grid-category{{ $stock->id }}">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="flex justify-end">
                        <button type="submit"
                                value="{{$stock->id}}" name="stock_id"
                                class="focus:outline-none text-gray-800 text-sm py-2.5 px-5 rounded-full border border-gray-800 hover:bg-gray-100">
                            Fechar estoque
                        </button>
                    </div>
                </form>
            </dialog>
        @endforeach
        </tbody>
    </table>

    <button onclick="document.getElementById('novo_estoque').showModal()"
            class="fixed bottom-1 right-0 p-0 w-16 h-16 mx-5 bg-gray-800 rounded-full hover:bg-gray-700 active:shadow-lg mouse shadow transition ease-in duration-200 focus:outline-none">
        <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-6 h-6 inline-block">
            <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z"/>
        </svg>
    </button>

    <style>
        dialog[open] {
            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
        }

        dialog::backdrop {
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
            backdrop-filter: blur(3px);
        }

        .select2-container {
            width: 100% !important;
            padding: 0;
        }

        @keyframes appear {
            from {
                opacity: 0;
                transform: translateX(-3rem);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>

    <dialog id="novo_estoque" class="p-5 bg-white rounded-md md:w-1/2 sm:w-full h-auto">
        <form method="POST" action="{{route('newStock')}}">
            @csrf
            <div class="flex flex-col">
                <div class="flex w-full h-auto justify-center items-center">
                    <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                        Novo item
                    </div>
                    <div onclick="document.getElementById('novo_estoque').close();"
                         class="flex w-1/12 h-auto justify-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                   for="grid-name">
                                Item
                            </label>
                            <input
                                name="name"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                                id="grid-name" type="text" placeholder="Item">
                        </div>
                    </div>

                    <div class="md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                               for="grid-quantity">
                            Quantidade
                        </label>
                        <input
                            name="quantity"
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                            id="grid-quantity" type="number" placeholder="Quantidade">
                    </div>

                    <div class="-mx-3 md:flex mb-6 flex-row">
                        <div class="md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                   for="grid-taken">
                                Retirado em
                            </label>
                            <input
                                name="withdrawn"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                id="grid-taken" type="datetime-local">
                        </div>

                        <div class="md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                   for="grid-returned">
                                Devolvido em
                            </label>
                            <input
                                name="returned"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                id="grid-returned" type="datetime-local">
                        </div>
                    </div>

                    <div class="w-full px-3">
                        <label
                            class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                            for="grid-category-create">
                            Categoria
                        </label>
                        <select
                            name="category_id"
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                            id="grid-category-create">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <div class="flex justify-end">
                <button type="submit"
                        class="focus:outline-none text-gray-800 text-sm py-2.5 px-5 rounded-full border border-gray-800 hover:bg-gray-100">
                    Fechar estoque
                </button>
            </div>
        </form>
    </dialog>

    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json'
                },
                responsive: true
            });

            $('#grid-category-create').select2({
                dropdownParent: $('#novo_estoque')
            });
        });
    </script>
@endsection
