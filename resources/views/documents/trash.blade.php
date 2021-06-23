@extends('layout.index', ['title' => 'Lixeira', 'action' => 'Documentos'])

@section('content')
<div class="container">
    <table class="w-full rounded-lg overflow-hidden sm:shadow-lg my-5">
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
                    <td class="border-grey-light border hover:bg-gray-100 p-3">Documento</td>
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
@endsection
