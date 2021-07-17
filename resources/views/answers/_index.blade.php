@if($answersCount > 0)
    <div class="w-full lg:max-w-full" v-cloak>
        <div class="shadow-md mb-4 bg-white rounded-lg p-4 flex flex-col justify-between leading-normal">
            <div class="mb-8">
                <p class="text-sm flex items-center text-gray-900 font-bold mb-2">
                    {{ $answersCount." ".Str::plural('Answer',$answersCount) }}
                    <hr>
                    @include('layouts._messages')
                </p>
                @foreach($answers as $answer)
                    @include('answers._answer')
                @endforeach
            </div>
        </div>
    </div>
@endif