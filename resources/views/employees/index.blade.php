@extends('layout.index', ['title' => 'Funcionários', 'action' => 'Funcionários'])

@section('content')
    <div class="container min-h-screen">
        <div class="overflow-x-auto w-full">
            <table
                class="mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg overflow-hidden sm:shadow-lg my-5 overflow-hidden">
                <thead class="bg-white text-dark-blue">
                    <tr class="rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                        <th class="p-3 text-left">
                            Nome Completo
                        </th>
                        <th class="p-3 text-left">
                            Cargo
                        </th>
                        <th class="p-3 text-left">
                            Email
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white opacity-50 text-dark-blue">
                    @foreach ($employees as $employee)
                        <tr class="mb-2 sm:mb-0">
                            <td class="border-grey-light border hover:bg-gray-100 p-3">
                                {{ ucwords($employee->firstname . ' ' . $employee->lastname, ' ') }}
                            </td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">
                                {{ $employee->role->role }}
                            </td>
                            <td class="border-grey-light border hover:bg-gray-100 p-3">
                                {{ $employee->email }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
