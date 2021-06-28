@extends('layout.index', ['title' => 'Read mode', 'action' => 'Projetos'])

@section('content')
    <div class="flex flex-col px-5 md:px-10 py-10">
        <div class="flex w-full h-auto justify-center items-center">
            <div class="w-full h-auto text-center text-white py-3 font-bold text-lg md:text-2xl">
                {{ date('d/m/Y H:i:s', strtotime($diary->entry_datetime)) }}

                <a href="{{ route('editEntryForm', ['id' => $project->id, 'name' => $project->project, 'entry' => $diary->id]) }}"
                    class="text-blue-800 text-sm py-2.5 px-2">
                    Editar
                </a>
            </div>
        </div>

        <div class="text-white">{!! $diary->entry_text !!}</div>

        <div class="flex flex-row flex-wrap grid md:grid-cols-2 gap-2">
            @foreach ($images as $image)

                <div class="flex justify-center items-center w-full">
                    <div
                        class="w-full cursor-pointer border b-gray-400 rounded flex flex-col justify-center items-center text-center p-3 bg-white div-img">
                        <div class="w-full h-full flex items-center justify-center ">
                            <a
                                href="{{ route('deleteImage', ['id' => $project->id, 'name' => $project->project, 'entry' => $diary->id, 'id_image' => $image->id]) }}">
                                <i class="fas fa-trash-alt fa-2x delete h-9 w-9 text-red-700 hover:text-red-900"></i>
                            </a>
                            <img src="{{ asset('storage/app/public/' . $image->image_path) }}">
                        </div>
                        <a href="{{ route('downloadImage', ['id' => $project->id, 'name' => $project->project, 'entry' => $diary->id, 'id_image' => $image->id]) }}"
                            class="hover:no-underline">
                            <p class="uppercase hover:underline">{{ date('d/m/Y H:i', strtotime($diary->entry_datetime)) }}</p>
                        </a>
                    </div>
                </div>

            @endforeach
        </div>
        <div class="flex flex-row gap-4">
            <!--<button type="button"
                    class="focus:outline-none text-red-800 text-sm py-2.5 px-2 rounded-full border border-red-800 hover:bg-red-100">
                    Deletar
                </button>-->
        </div>
    @endsection
