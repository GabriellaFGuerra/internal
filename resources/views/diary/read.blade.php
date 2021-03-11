@extends('layout.index', ['title' => 'Read mode'])

@section('content')
    <!-- Flickity -->
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <!-- Slick -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>


    <style>
        .flickity-viewport {
            height: 500px !important;
        }

        .slider {
            display: flex;
        }

        .slides {
            display: flex;
            justify-content: center;
        }


    </style>
    <div class="flex flex-col px-5 md:px-10 py-10">
        <div class="flex w-full h-auto justify-center items-center">
            <div
                class="w-full h-auto text-center py-3 font-bold text-lg md:text-2xl">
                {{ date('d/m/Y H:i:s', strtotime($diary->entry_datetime)) }}

                <a
                    href="{{ route('editEntryForm', ['id' => $project->id, 'name' => $project->project, 'entry' => $diary->id]) }}"
                    class="text-blue-800 text-sm py-2.5 px-2">
                    Editar
                </a>
            </div>
        </div>

        <div>{!! $diary->entry_text !!}</div>

        <main class="flex items-center justify-center w-full hidden md:block px-10" x-data="carouselFilter()">
            <div class="container grid grid-cols-1">
                <div class="row-start-2 col-start-1"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-90"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-90"
                >
                    <div class="grid grid-cols-1 grid-rows-1" x-data="carousel()" x-init="init()">
                        <div class="carousel col-start-1 row-start-1 focus:outline-none" x-ref="carousel">
                            @foreach ($images as $image)
                                <div class="w-3/5 px-2 flex items-center justify-center">
                                    <img
                                        src="{{ route('showImage', ['image_id' => $image->id]) }}"
                                        loading="lazy">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="block md:hidden">
            <div class="slider">
                @foreach ($images as $image)
                    <div>
                        <img
                            src="{{ route('showImage', ['image_id' => $image->id]) }}"
                            loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>
        <script>
            $('.slider').slick({
                infinite: true,
                speed: 700,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false,
                slidesToScroll: 1
            });

            function carousel() {
                return {
                    active: 0,
                    init() {
                        var flkty = new Flickity(this.$refs.carousel, {
                            wrapAround: true
                        });
                        flkty.on('change', i => this.active = i);
                    }
                }
            }

            function carouselFilter() {
                return {
                    active: 0,
                    changeActive(i) {
                        this.active = i;

                        this.$nextTick(() => {
                            let flkty = Flickity.data(this.$el.querySelectorAll('.carousel')[i]);
                            flkty.resize();

                            console.log(flkty);
                        });
                    }
                }
            }
        </script>

        <div class="flex flex-row gap-4">
            <!--<button type="button"
                    class="focus:outline-none text-red-800 text-sm py-2.5 px-2 rounded-full border border-red-800 hover:bg-red-100">
                Deletar
            </button>-->
        </div>
        <!-- Flickity -->
        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

        <!-- Slick -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


@endsection
