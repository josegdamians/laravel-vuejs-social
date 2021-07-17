<div class="text-xs float-right">
    {{ $label.' '.$model->created_date }}
    <div class="md:flex mt-2">
        <a href="{{ $model->user->url }}" class="pr-2"><img class="rounded-full" src="{{ $model->user->avatar }}"></a>
        <a class="mt-1" href="{{ $model->user->url }}">{{ $model->user->name }}</a>
    </div>
</div>