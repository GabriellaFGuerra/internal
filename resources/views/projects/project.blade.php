@extends('layout.index', ['title' => str_replace('_', ' ', ucfirst($name)), 'action' => 'Projetos'])

@section('content')
    <main class="px-3">
        <div class="text-3xl sm:text-5xl text-center my-4">
            {{ str_replace('_', ' ', ucwords($project->project, '_')) }}
        </div>

        <div class="grid md:grid-cols-3 gap-8 m-5 max-w-5xl m-auto">
            <div class="bg-white">
                <div class="px-10 py-2 mb-10 text-center">
                    <div class="text-2xl font-bold text-dark-blue mb-4">Documentos</div>
                    @foreach ($project->documents as $document)
                        <p>
                            <a
                                href="{{ route('downloadDoc', ['id' => $document->id]) }}">{{ $document->document_name }}</a>
                        </p>
                    @endforeach
                </div>
            </div>

            <div class="bg-white">
                <div class="px-10 py-2 mb-10 text-center">
                    <div class="text-2xl font-bold text-dark-blue mb-4">Plantas</div>
                    @foreach ($project->blueprints as $blueprint)
                        <p>
                            <a
                                href="{{ route('downloadBlueprint', ['id_project' => $project->id, 'project_name' => $project->project, 'id' => $blueprint->id]) }}">{{ $blueprint->blueprint }}</a>
                        </p>
                    @endforeach
                </div>
            </div>

            <div class="bg-white">
                <div class="px-10 py-2 mb-10 text-center">
                    <div class="text-2xl font-bold text-dark-blue mb-4">Diário
                        <a type="button" href="{{ route('newEntry', ['id' => $project->id, 'name' => $name]) }}"
                            class="focus:outline-none mt-0.5 text-dark-blue hover:text-light-blue">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </a>
                    </div>
                    @foreach ($project->diaries as $entry)
                        <p>
                            <a class="uk-link focus:outline-none"
                                href="{{ route('readEntry', ['id' => $project->id, 'name' => $project->project, 'entry_id' => $entry->id]) }}">
                                {{ date('d/m/Y H:i:s', strtotime($entry->entry_datetime)) }}
                            </a>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="text-3xl sm:text-5xl text-center my-4">
            Custos do projeto
        </div>
        <div class="container">
            <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                <thead class="text-white">
                    <tr
                        class="bg-dark-blue flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                        <th class="p-3 text-left">Item</th>
                        <th class="p-3 text-left">Categoria</th>
                        <th class="p-3 text-left">Preço total</th>
                    </tr>
                </thead>
                <tbody class="flex-1 sm:flex-none">
                    @foreach ($project->purchases as $purchase)
                        <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                            <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $purchase->item }}</td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">
                                @if ($purchase->category === null)
                                    {{ 'Sem categoria' }}
                                @else
                                    {{ $purchase->category->category }}
                                @endif
                            </td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $purchase->total_value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>
@endsection
