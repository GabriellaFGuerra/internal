@extends('layout.index', ['title' => 'Lixeira', 'action' => 'Documentos'])

@section('content')
    <div class="container min-h-screen">
        <div class="overflow-x-auto w-full">
            <table class="mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg overflow-hidden sm:shadow-lg my-5">
                <thead class="bg-white text-gray-900">
                    <tr class="rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                        <th class="p-3 text-left">Documento</th>
                        <th class="p-3 text-left" width="110px">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white opacity-50 text-gray-900">
                    @foreach ($documents as $document)
                        <tr class="">
                            <td class="border-grey-light border hover:bg-gray-100 p-3">
                                <a href="{{ route('downloadDoc', ['id' => $document->id]) }}">
                                    {{ $document->document_name }}
                                </a>
                            </td>
                            <td
                                class="border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer">
                                <a href="{{ route('permadeleteDoc', ['id' => $document->id]) }}">
                                    Deletar permanentemente
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
