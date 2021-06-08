@extends('layout.index', ['title' => 'Password Reset'])

@section('content')
    <div class="w-full">
        <div class="flex items-center justify-center h-screen">
            <div class="container mx-24 bg-white rounded shadow-lg">
                <div class="px-12 py-6">
                    <div class="text-center">
                        <h1 class="font-normal text-3xl text-grey-darkest leading-loose my-3 w-full">Recuperar
                            senha</h1>
                        <div class="w-full text-center">
                            <form action="{{ route('getemail') }}" method="POST">
                                @csrf
                                <div class="max-w-sm mx-auto p-1 pr-0 flex items-center">
                                    <input
                                        name="email"
                                        class="rounded-l-lg p-4 border-t mr-0 border-b border-l text-gray-800 border-gray-800 bg-white focus:outline-none"
                                        placeholder="your@mail.com"/>
                                    <button
                                        class="px-8 rounded-r-lg bg-blue-400 text-gray-800 border-gray-800 border-t border-b border-r font-bold focus:outline-none p-4 uppercase">
                                        Recuperar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
