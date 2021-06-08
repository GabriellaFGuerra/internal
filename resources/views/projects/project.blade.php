@extends('layout.index', ['title' => str_replace('_', ' ', ucfirst($name))])

@section('content')
    <main class="px-3">
        <div class="text-4xl sm:text-5xl text-center my-10">{{str_replace('_', ' ', ucwords($project->project, '_'))}}</div>

        <div class="grid md:grid-cols-3 gap-8 m-5 max-w-5xl m-auto">
            <div class="bg-white">
                <div class="px-10 py-2 mb-10 text-center">
                    <div class="text-2xl font-bold text-purple-500 mb-4">Documentos</div>
                    @foreach($project->documents as $document)
                        <p>
                            <a href="{{route('downloadDoc', ['id' => $document->id])}}">{{ $document->document_name }}</a>
                        </p>
                    @endforeach
                </div>
            </div>

            <div class="bg-white">
                <div class="px-10 py-2 mb-10 text-center">
                    <div class="text-2xl font-bold text-blue-500 mb-4">Plantas</div>
                    @foreach($project->blueprints as $blueprint)
                        <p>
                            <a href="{{route('downloadBlueprint', ['id_project' => $project->id, 'project_name' => $project->project, 'id' => $blueprint->id])}}">{{ $blueprint->blueprint }}</a>
                        </p>
                    @endforeach
                </div>
            </div>

            <div class="bg-white">
                <div class="px-10 py-2 mb-10 text-center">
                    <div class="text-2xl font-bold text-green-500 mb-4">Diário de obras
                        <a type="button"
                           href="{{route('newEntry', ['id' => $project->id, 'name' => $name])}}"
                           class="focus:outline-none mt-0.5 text-green-500 hover:text-green-700">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </a>
                    </div>
                    @foreach($project->diaries as $entry)
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

        <p class="text-4xl sm:text-5xl text-center my-10">Custos do projeto</p>
        <table class="overflow-x-auto w-full" id="table">
            <thead class="border-b border-gray-300">
                <tr>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">ID</th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">Descrição</th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">Valor
                        unitário
                    </th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">Quantidade</th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">Valor total
                    </th>
                </tr>
            </thead>
            <tbody class="text-gray-600 divide-y divide-gray-300">
                @foreach ($project->purchases as $purchase)
                    <tr class="bg-white font-medium divide-y divide-gray-200">
                        <td class="p-4 whitespace-nowrap">{{$purchase->id}}</td>
                        <td class="p-4 whitespace-nowrap">{{$purchase->item}}</td>
                        <td class="p-4 whitespace-nowrap">R${{$purchase->unit_value}}</td>
                        <td class="p-4 whitespace-nowrap">{{$purchase->quantity}}</td>
                        <td class="p-4 whitespace-nowrap">R${{$purchase->total_value}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    <style>
        dialog[open] {
            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
            z-index: -1;
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

    <dialog id="new_entry" class="p-5 bg-white rounded-md w-full">
        <div class="flex flex-col">
            <div class="flex w-full h-auto justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center font-bold text-lg md:text-2xl">
                    Nova entrada - {{date('d/m/Y H:i')}}
                </div>
                <div onclick="document.getElementById('new_entry').close();"
                     class="flex w-1/12 h-auto justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </div>
            </div>

            <div id="editor" style="height: 130px;"></div>

            <div class="bg-white p7 rounded w-9/12 mx-auto">
                <div x-data="dataFileDnD()"
                     class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                    <div x-ref="dnd"
                         class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                        <input accept="*" type="file" multiple
                               class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                               @change="addFiles($event)"
                               @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
                               @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                               @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                               title=""/>

                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="m-0">Arraste suas imagens para cá ou clique aqui.</p>
                        </div>
                    </div>

                    <template x-if="files.length > 0">
                        <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-6" @drop.prevent="drop($event)"
                             @dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
                            <template x-for="(_, index) in Array.from({ length: files.length })">
                                <div
                                        class="relative flex flex-col items-center overflow-hidden text-center bg-gray-100 border rounded cursor-move select-none"
                                        style="padding-top: 100%;" @dragstart="dragstart($event)"
                                        @dragend="fileDragging = null"
                                        :class="{'border-blue-600': fileDragging == index}" draggable="true"
                                        :data-index="index">
                                    <button
                                            class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none"
                                            type="button" @click="remove(index)">
                                        <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                                             fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                    <template x-if="files[index].type.includes('audio/')">
                                        <svg
                                                class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                        </svg>
                                    </template>
                                    <template
                                            x-if="files[index].type.includes('application/') || files[index].type === ''">
                                        <svg
                                                class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </template>
                                    <template x-if="files[index].type.includes('image/')">
                                        <img
                                                class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                                                x-bind:src="loadFile(files[index])"/>
                                    </template>
                                    <template x-if="files[index].type.includes('video/')">
                                        <video
                                                class="absolute inset-0 object-cover w-full h-full border-4 border-white pointer-events-none preview">
                                            <fileDragging x-bind:src="loadFile(files[index])"
                                                          type="video/mp4"></fileDragging>
                                        </video>
                                    </template>

                                    <div
                                            class="absolute bottom-0 left-0 right-0 flex flex-col p-2 text-xs bg-white bg-opacity-50">
                        <span class="w-full font-bold text-gray-900 truncate"
                              x-text="files[index].name">Loading</span>
                                        <span class="text-xs text-gray-900"
                                              x-text="humanFileSize(files[index].size)">...</span>
                                    </div>

                                    <div class="absolute inset-0 z-40 transition-colors duration-300"
                                         @dragenter="dragenter($event)"
                                         @dragleave="fileDropping = null"
                                         :class="{'bg-blue-200 bg-opacity-80': fileDropping == index && fileDragging != index}">
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
            <script src="https://unpkg.com/create-file-list"></script>
            <script>
                function dataFileDnD() {
                    return {
                        files: [],
                        fileDragging: null,
                        fileDropping: null,
                        humanFileSize(size) {
                            const i = Math.floor(Math.log(size) / Math.log(1024));
                            return (
                                (size / Math.pow(1024, i)).toFixed(2) * 1 +
                                " " +
                                ["B", "kB", "MB", "GB", "TB"][i]
                            );
                        },
                        remove(index) {
                            let files = [...this.files];
                            files.splice(index, 1);

                            this.files = createFileList(files);
                        },
                        drop(e) {
                            let removed, add;
                            let files = [...this.files];

                            removed = files.splice(this.fileDragging, 1);
                            files.splice(this.fileDropping, 0, ...removed);

                            this.files = createFileList(files);

                            this.fileDropping = null;
                            this.fileDragging = null;
                        },
                        dragenter(e) {
                            let targetElem = e.target.closest("[draggable]");

                            this.fileDropping = targetElem.getAttribute("data-index");
                        },
                        dragstart(e) {
                            this.fileDragging = e.target
                                .closest("[draggable]")
                                .getAttribute("data-index");
                            e.dataTransfer.effectAllowed = "move";
                        },
                        loadFile(file) {
                            const preview = document.querySelectorAll(".preview");
                            const blobUrl = URL.createObjectURL(file);

                            preview.forEach(elem => {
                                elem.onload = () => {
                                    URL.revokeObjectURL(elem.src); // free memory
                                };
                            });

                            return blobUrl;
                        },
                        addFiles(e) {
                            const files = createFileList([...this.files], [...e.target.files]);
                            this.files = files;
                            this.form.formData.files = [...files];
                        }
                    };
                }
            </script>

        </div>
        <div class="flex justify-end py-3">
            <button type="button"
                    class="focus:outline-none text-blue-800 text-sm py-2.5 px-2 rounded-full border border-blue-800 hover:bg-blue-100">
                Salvar
            </button>
        </div>
    </dialog>

    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json'
                }
            });


        })
        ;
    </script>
@endsection
