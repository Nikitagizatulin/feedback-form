@extends('adminlte::page')

@section('title', 'Feedback form')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Feedback form</h3>
                </div>
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        {{ session()->get('error') }}
                    </div>
                @endif
                @if(!empty($difTime))
                    <div class="timerBlock">
                        <p class="h1 text-danger text-center">
                            Time before the opportunity to send an application</p>
                        <div id="timer" data-timer="{{$difTime}}"></div>
                    </div>
                @endif
                <form role="form" method="POST" action="{{url('/fb')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('theme') ? ' has-error' : '' }}">
                            <label for="theme">Theme message:</label>
                            <input type="text" class="form-control" value="{{old('theme')}}" id="theme" name="theme" placeholder="The theme text">
                            @if ($errors->has('theme'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('theme') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message">Message:</label>
                            <textarea class="form-control" rows="5" name="message" id="message" placeholder="Enter message text">{{old('message')}}</textarea>
                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
                            <label for="file">File:</label>
                            <input type="file" id="file" name="file" value="{{old('file')}}">
                            @if ($errors->has('file'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                            <p class="help-block">Any file what you need to attach</p>
                        </div>
                    </div>

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Submit" {{empty($difTime)?'':'disabled'}}>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('css/TimeCircles.css')}}">
@stop
@section('js')
    <script src="{{asset('js/TimeCircles.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
@stop