@extends('layout.index', ['title' => 'Plantas'])

@section('content')
    <div
        class="px-0 md:px-0.5 lg:px-48 overflow-x-hidden justify-center items-center flex flex-row flex-wrap w-auto md:grid md:grid-cols-3 md:grid-flow-row gap-10 md:gap-0 sm:gap-1">
        @foreach ($projects as $project)
            <div
                class="w-64 cursor-pointer border b-gray-400 rounded flex flex-col justify-center items-center text-center p-3 bg-white">
                <div class="w-32 h-32 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                              d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                </div>
                <a href="{{route('blueprint', ['id_project' => $project->id, 'project_name' => $project->project])}}">
                    <p class="text-2xl uppercase sm:text-2xl md:text-xl">{{ str_replace('_', ' ', $project->project) }}</p>
                </a>
            </div>
        @endforeach
    </div>


@endsection
