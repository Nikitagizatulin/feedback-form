@extends('adminlte::page')

@section('title', 'Feedback form')


@section('content')
    <p>{{ Auth::user()->user_role }}</p>
@stop