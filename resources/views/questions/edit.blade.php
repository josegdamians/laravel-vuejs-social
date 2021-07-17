@extends('layouts.main')

@section('content')
    <div class="px-4 my-3 py-3 bg-white rounded-lg shadow-md mb-4">
        <div class="flex">
            <h2>Editar pregunta</h2>
            <div class="ml-auto">
                <a href="{{ route('questions.index') }}" class="bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">Regresar</a>
            </div>
        </div>
    </div>
        <div class="px-4 my-4 py-4 bg-white rounded-lg shadow-md mb-4">
            <div class="mb-8">
                Realiza tu pregunta
            </div>
            <form class="w-full " action="{{ route('questions.update',$question->id) }}" method="POST">
                @method("PUT")
                @include("questions._form",['buttonText' => 'Actualizar pregunta'])
            </form>
        </div>
@endsection