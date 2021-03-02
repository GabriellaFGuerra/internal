@extends('layout.index', ['title' => 'Login'])

@section('content')
    @if ($errors->any())
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
                    <ul class="list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center sm:py-12">
        <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
            <h1 class="font-bold text-center text-2xl mb-5">Grupo Reica</h1>
            <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
                <div class="px-5 py-7">
                    <form method="post" action="{{route('login.auth')}}">
                        @csrf
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">E-mail</label>
                        <input type="email" name="email" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"/>
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Senha</label>
                        <input type="password" name="password" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"/>
                        <button type="submit"
                                class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                            <span class="inline-block mr-2">Login</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="py-5">
                    <div class="grid grid-cols-2 gap-1">
                        <div class="text-center sm:text-left whitespace-nowrap">
                            <a href="{{route('forgotpassword')}}"
                               class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                                <span class="inline-block ml-1">Esqueci minha senha</span>
                            </a>
                        </div>
                        <div class="text-center sm:text-right  whitespace-nowrap">
                            <a href="{{route('register')}}"
                               class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                                <span class="inline-block ml-1">Registrar-se</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
