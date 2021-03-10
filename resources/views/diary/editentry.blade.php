@extends('layout.index', ['title' => 'New Entry'])

@section('content')
    <div class="p-5 bg-white rounded-md w-full">
        <form method="post" action="{{route('editEntry', ['id' => $id, 'name' => $name, 'entry' => $entry])}}"
              enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col">
                <div class="flex w-full h-auto justify-center items-center">
                    <div class="flex w-10/12 h-auto py-3 justify-center items-center font-bold text-lg md:text-2xl">
                        Editar entrada - {{date('d/m/Y H:i', strtotime($data->entry_datetime))}}
                    </div>
                </div>


                <textarea name="entry_text">{!! $data->entry_text !!}</textarea>

                <div class="bg-white p7 rounded w-9/12 mx-auto">
                    <div x-data="dataFileDnD()"
                         class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                        <div x-ref="dnd"
                             class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                            <input accept="*" type="file" multiple
                                   name="images[]"
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
                <button type="submit"
                        class="focus:outline-none text-blue-800 text-sm py-2.5 px-2 rounded-full border border-blue-800 hover:bg-blue-100">
                    Salvar
                </button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {

            tinymce.init({
                selector: 'textarea',
                plugins: 'print preview paste autolink directionality fullscreen link table charmap hr nonbreaking toc insertdatetime advlist lists textpattern help charmap',
                menubar: 'file edit view insert format table help',
                toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | charmap | fullscreen  preview print | link',
                toolbar_sticky: true,
                height: 600,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quicktable',
                toolbar_mode: 'sliding',
                contextmenu: 'link table',
                fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
                content_style: '@import url(https://fonts.googleapis.com/css2?family=Rubik&display=swap); body { font-family:Rubik; font-size:14px }'
            });


        });
    </script>
@endsection
