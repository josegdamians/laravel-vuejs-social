@extends('layouts.main')

@section('content')
    <div class="px-4 my-3 py-3 bg-white rounded-lg shadow-md mb-4">
        <div class="flex">
            <h2>Todas las preguntas</h2>
            <div class="ml-auto">
                <a href="{{ route('questions.create') }}" class="bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">Pregunta</a>
            </div>
        </div>
    </div>
    @include('layouts._messages')
    @forelse($questions as $question)
        @include('questions._excerpt')
    @empty
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                <p class="font-bold">Lo sentimos</p>
                <p class="text-sm">No hay preguntas disponibles.</p>
                </div>
            </div>
        </div>
    @endforelse
    {{ $questions->links() }}
@endsection