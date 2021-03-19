@extends('layout.index', ['title' => str_replace('_', ' ', ucwords($project_name, '_'))])



@section('content')
    @isset ($no_blueprint)
        <div class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300">
            <div
                class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
				<span class="text-red-500">
					<svg fill="currentColor"
                         viewBox="0 0 20 20"
                         class="h-6 w-6">
						<path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
					</svg>
				</span>
            </div>
            <div class="alert-content ml-4">
                <div class="alert-title font-semibold text-lg text-red-800">
                    Erro
                </div>
                <div class="alert-description text-sm text-red-600">
                    {{ $no_blueprint }}
                </div>
            </div>
        </div>
    @endisset
    <div class="flex flex-row flex-wrap md:grid md:grid-cols-3 md:grid-flow-row">
        @foreach ($blueprints as $blueprint)
            <div class="flex justify-center items-center w-full">
                <div
                    class="w-64 cursor-pointer border b-gray-400 rounded flex flex-col justify-center items-center text-center p-3 bg-white">
                    <div class="w-32 h-32 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <a href="{{ route('downloadBlueprint', ['id_project' => $id_project, 'project_name' => $project_name, 'id' => $blueprint->id]) }}">
                        <p
                            class="uppercase text-xl">{{ $blueprint->blueprint }}</p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <button onclick="document.getElementById('add_planta').showModal()"
            class="fixed bottom-1 right-0 p-0 w-16 h-16 mx-5 bg-gray-800 rounded-full hover:bg-gray-700 active:shadow-lg mouse shadow transition ease-in duration-200 focus:outline-none">
        <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-6 h-6 inline-block">
            <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z"/>
        </svg>
    </button>

    <style>
        dialog[open] {
            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
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

    <dialog id="add_planta" class="p-5 bg-white rounded-md">
        <div class="flex flex-col">
            <form
                action="{{route('uploadBlueprint', ['id_project' => $id_project, 'project_name' => $project_name])}}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex w-full h-auto justify-center items-center">
                    <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                        Nova planta
                    </div>
                    <div onclick="document.getElementById('add_planta').close();"
                         class="flex w-1/12 h-auto justify-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                </div>

                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                           for="grid-name">
                        Nome da planta
                    </label>
                    <input
                        name="name"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                        id="grid-name" type="text" placeholder="Nome">
                </div>

                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                           for="grid-project">
                        Projeto
                    </label>
                    <input
                        disabled
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                        id="grid-name" type="text" value="{{ str_replace('_', ' ', ucwords($project_name, '_')) }}">
                </div>

                <div class="bg-white p-7 rounded mx-auto">
                    <div x-data="dataFileDnD()"
                         class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                        <div x-ref="dnd"
                             class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                            <input accept="*"
                                   name="blueprint"
                                   type="file" multiple
                                   class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                                   @change="addFiles($event)"
                                   @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
                                   @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                   @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                   title=""/>

                            <div class="flex flex-col items-center justify-center py-10 text-center">
                                <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="m-0">Arraste seus arquivos ou clique nesta área</p>
                            </div>
                        </div>

                        <template x-if="files.length > 0">
                            <div class="grid grid-cols-2 gap-4 mt-4" @drop.prevent="drop($event)"
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
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                        <template x-if="files[index].type.includes('audio/')">
                                            <svg
                                                class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                            </svg>
                                        </template>
                                        <template
                                            x-if="files[index].type.includes('application/') || files[index].type === ''">
                                            <svg
                                                class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
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

                <div class="flex justify-end">
                    <button type="submit"
                            class="focus:outline-none text-blue-600 text-sm py-2.5 px-5 rounded-full border border-blue-600 hover:bg-blue-50">
                        Enviar
                    </button>
                </div>
            </form>
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
    </dialog>

@endsection