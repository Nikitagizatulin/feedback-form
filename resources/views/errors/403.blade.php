@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        403 Error Page
    </h1>
@stop

@section('content')
    <div class="error-page">
        <h2 class="headline text-yellow"> 403</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! {{ $exception->getMessage() }}</h3>
        </div>
    </div>
@stop
