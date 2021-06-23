@extends('layout.index', ['title' => 'Plantas', 'action' => 'Plantas'])

@section('content')
    <div class="flex flex-row flex-wrap text-white grid md:grid-cols-3">
        @foreach ($projects as $project)
            <div class="py-6 px-3 text-white w-full">
                <div class="shadow-xl rounded-lg overflow-hidden bg-dark-blue ">
                    <div class="p-4">
                        <p class="text-3xl">
                            <a class="hover:no-underline link" href="{{ route('blueprint', ['id_project' => $project->id, 'project_name' => $project->project]) }}
                                ">{{ str_replace('_', ' ', ucwords($project->project, '_')) }}</a>
                        </p>
                        <p>
                            Clique para ver as plantas do projeto
                        </p>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

@endsection
