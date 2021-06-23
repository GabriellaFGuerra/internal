@extends('layout.index', ['title' => 'Documentos', 'action' => 'Documentos', 'button' => 'Novo documento', 'route' =>
'createDoc'])

@section('content')
    <div class="container">
        <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
            <thead class="text-white">
                <tr class="bg-dark-blue flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <th class="p-3 text-left">Documento</th>
                    <th class="p-3 text-left">Tipo</th>
                    <th class="p-3 text-left" width="110px">Ações</th>
                </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
                @foreach ($documents as $document)
                    <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                        <td class="border-grey-light border hover:bg-gray-100 p-3">
                            <a href="{{ route('downloadDoc', ['id' => $document->id]) }}">
                                {{ $document->document_name }}
                            </a>
                        </td>
                        <td class="border-grey-light border hover:bg-gray-100 p-3">Documento</td>
                        <td
                            class="border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer">
                            <a href="{{ route('deleteDoc', ['id' => $document->id]) }}">
                                Deletar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
