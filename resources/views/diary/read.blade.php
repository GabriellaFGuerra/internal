@extends('layout.index', ['title' => 'Read mode'])

@section('content')
    <div class="flex flex-col">
        <div class="flex w-full h-auto justify-center items-center">
            <div
                class="w-full h-auto text-center py-3 font-bold text-lg md:text-2xl">
                {{ date('d/m/Y H:i:s', strtotime($diary->entry_datetime)) }}
            </div>
        </div>

        <div>{!! $diary->entry_text !!}</div>

        @foreach ($images as $image)

        @endforeach
    </div>
    <div class="flex justify-end flex-row gap-4">
        <a
            href="{{ route('editEntry', ['id' => $project->id, 'name' => $project->project, 'entry' => $diary->id]) }}"
            type="button"
            class="focus:outline-none text-blue-800 text-sm py-2.5 px-2 rounded-full border border-blue-800 hover:bg-blue-100">
            Editar
        </a>
        <!--<button type="button"
                class="focus:outline-none text-red-800 text-sm py-2.5 px-2 rounded-full border border-red-800 hover:bg-red-100">
            Deletar
        </button>-->
    </div>
@endsection
