@extends('layout.index', ['title' => 'Plantas'])

@section('content')
    <div class="px-0 md:px-0.5 lg:px-48 overflow-x-hidden justify-center items-center flex flex-row flex-wrap w-auto md:grid md:grid-cols-3 md:grid-flow-row gap-10 md:gap-0 sm:gap-2">
        @foreach ($projects as $project)
            <a href="{{route('blueprint', ['id_project' => $project->id, 'project_name' => $project->project])}}"
               class="hover:no-underline">
                <div class="w-64 cursor-pointer border b-gray-400 rounded flex flex-col justify-center items-center text-center p-3 bg-white my-5">
                    <div class="w-32 h-32 flex items-center justify-center">
                        <i class="far fa-folder fa-7x"></i>
                    </div>

                    <p class="text-2xl text-light-blue uppercase sm:text-2xl md:text-xl hover:underline">{{ str_replace('_', ' ', $project->project) }}</p>

                </div>
            </a>
        @endforeach
    </div>


@endsection
