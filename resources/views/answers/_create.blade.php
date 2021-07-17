<div class="w-full lg:max-w-full">
    <div class="shadow-md mb-4 bg-white rounded-lg p-4 flex flex-col justify-between leading-normal">
        <div class="mb-8">
            <p class="text-sm flex items-center text-gray-900 font-bold mb-2">
                <h3>Tu respuesta</h3>
                <hr>
            </p>
            <form action="{{ route('questions.answers.store',$question) }}" method="POST">
                @csrf
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-2/3">
                        <textarea class="@error('body') border-red-500 @enderror bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('body') border-red-500 @enderror" name="body" id="question-body" rows="7">{{ old('body') }}</textarea>
                        @error('body')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>