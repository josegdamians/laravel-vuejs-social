@extends('layouts.main')

@section('content')
    <question-page :question="{{ $question }}"></question-page>
@endsection