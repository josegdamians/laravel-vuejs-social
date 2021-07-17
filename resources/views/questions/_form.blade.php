@csrf

<x-ui.input label="titulo de la pregunta" name="title" :value="old('title',$question->title)" />

<x-ui.input label="Descripción" name="body" :value="old('body',$question->body)" />

<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3"></div>
    <div class="md:w-2/3">
        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
            {{ $buttonText }}
        </button>
    </div>
</div>