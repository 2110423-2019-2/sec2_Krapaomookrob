@extends('layouts.app')

@section('title', 'Chat')

@section('topic', 'Chat')

@section('content')
<chat-component userid={{auth()->user()->id}}></chat-component>
@endsection
