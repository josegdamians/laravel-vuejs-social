<div class="md:flex md:items-center mb-6" {{ $attributes }}>
    <div class="md:w-1/3">
        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" >
            {{ $label }}
        </label>
    </div>
    <div class="md:w-2/3">
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error($name) border-red-500 @enderror" id="{{ $name }}" type="{{ $type ?? 'text' }}" name="{{ $name }}" value="{{ $value }}">
        @error($name)
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>
</div>