@extends('layout.index', ['title' => 'Trash'])

@section('content')
    <div class="w-full m-auto">
        <div class="shadow-lg bg-white pb-6 pt-4 rounded-lg leading-normal">
            <table class="border-collapse w-full" id="table">
                <thead>
                <tr>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        ID
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Documento
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Tipo de documento
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Ações
                    </th>
                </tr>
                </thead>

                <tbody class="text-gray-600 text-sm divide-y divide-gray-300">
                @foreach ($documents as $document)
                    <tr cclass="bg-white font-medium text-sm divide-y divide-gray-200">
                        <td class="p-4 whitespace-nowrap">
                            {{ $document->id }}
                        </td>
                        <td cclass="p-4 whitespace-nowrap">
                            <a href="{{ route('downloadDoc', ['id' => $document->id]) }}">{{ $document->document_name }}</a>
                        </td>
                        <td cclass="p-4 whitespace-nowrap">
                            <span class="rounded bg-green-400 py-1 px-3 text-xs font-bold">Documento</span>
                        </td>
                        <td class="p-4 whitespace-nowrap space-x-5">
                            <a href="{{ route('restoreDoc', ['id' => $document->id])}}">
                                Restaurar
                            </a>
                            <a onclick="document.getElementById('confirm').showModal();"
                               class="text-red-600 hover:text-red-600">
                                Remover permanentemente
                            </a>
                        </td>
                    </tr>
                    <style>
                        dialog[open] {
                            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
                        }

                        dialog::backdrop {
                            background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
                            backdrop-filter: blur(3px);
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

                    <dialog id="confirm" class="p-5 bg-white rounded-md">
                        <div class="flex flex-col">
                            <div class="flex w-full h-auto justify-center items-center">
                                <div
                                    class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                                    Confirme sua ação
                                </div>
                                <div onclick="document.getElementById('confirm').close();"
                                     class="flex w-1/12 h-auto justify-center cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="#000000" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="feather feather-x">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </div>
                            </div>

                            <div class="md:w-full px-3 mb-6 md:mb-0">
                                <p>Tem certeza de que deseja deletar o arquivo {{ $document->name }}?</p>
                                <p>Esta ação não poderá ser desfeita.</p>
                            </div>


                            <div class="flex justify-end">
                                <button onclick="document.getElementById('confirm').close();"
                                        class="focus:outline-none text-black-600 text-sm py-2.5 px-5 rounded-full border border-black-600 hover:bg-black-50">
                                    Cancelar
                                </button>
                                <form action="{{ route('permadeleteDoc', ['id' => $document->id])}}">
                                    @csrf
                                    <button type="submit"
                                            class="focus:outline-none text-red-600 text-sm py-2.5 px-5 rounded-full border border-red-600 hover:bg-red-50">
                                        Deletar
                                    </button>
                                </form>
                            </div>


                        </div>
                    </dialog>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json'
                },
                responsive: true
            })
        })
    </script>
@endsection
