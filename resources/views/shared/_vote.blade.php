@if($model instanceof \App\Models\Question)
    @php
        $name = 'question';
        $title = 'pregunta';
        $firstURISegment = 'questions';
    @endphp
@elseif($model instanceof \App\Models\Answer)
    @php
        $name = 'answer';
        $title = 'respuesta';
        $firstURISegment = 'answers';
    @endphp
@endif

@php
    $formId = $name."-".$model->id;
    $formAction = "/{$firstURISegment}/{$model->id}/vote";
@endphp

<div class="flex-initial p-4 vote-controls">
    <a title="Esta {{ $title }} es util" class="vote-up {{ Auth::guest() ? 'off' : '' }}" onclick="event.preventDefault(); document.getElementById('up-vote-{{ $formId }}').submit();">
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <form id="up-vote-{{ $formId }}" action="{{ $formAction }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-count">{{ $model->votes_count }}</span>
    <a title="Esta {{ $title }} no es util" class="vote-down {{ Auth::guest() ? 'off' : '' }}" onclick="event.preventDefault(); document.getElementById('down-vote-{{ $formId }}').submit();">
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form id="down-vote-{{ $formId }}" action="{{ $formAction }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>

    @if($model instanceof App\Models\Question)
        <favorite :question="{{ $model }}"></favorite>
    @elseif($model instanceof App\models\Answer)
        <accept :answer="{{ $model }}"></accept>  
    @endif
</div>