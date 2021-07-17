<div class="flex px-4 my-4 py-4 bg-white rounded-lg shadow-md mb-4">
    <div class="flex-initial px-4 py-2 m-2 counters">
        <div class="vote">
            <strong>{{ $question->votes_count }}</strong> {{ Str::plural('vote',$question->votes_count) }}
        </div>
        <div class="status {{ $question->status }}">
            <strong>{{ $question->answers_count }}</strong> {{ Str::plural('answer',$question->answers_count) }}
        </div>
        <div class="view">
            <strong>{{ $question->views }}</strong> {{ Str::plural('view',$question->views) }}
        </div>
    </div>
    <div class="flex-auto px-4 py-2 m-2">
        <div class="flex">
            <a class="text-2xl font-bold text-indigo-500 hover:text-blue-800" href="{{ $question->url }}">{{ $question->title }}</a>
            <div class="ml-auto">
                @can('update',$question)
                    <a href="{{ route('questions.edit',$question->id) }}" class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Editar</a>
                @endcan
                @can('delete',$question)
                    <form class="form-delete" method="POST" action="{{ route('questions.destroy',$question->id) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" onclick="return confirm('¿Estas seguro?')">Borrar</button>
                    </form>
                @endcan
            </div>
        </div>
        <p class="lead">
            Pregunta realizada por 
            <a href="{{ $question->user->url }}" class="text-indigo-500">{{ $question->user->name }}</a>
            <small>{{ $question->created_date }}</small>
        </p>
        <div class="mt-2 text-gray-600 excerpt">{{ $question->excerpt(350) }}</div>
    </div>
</div>