@extends('adminlte::page')

@section('title', 'Feedback form')


@section('content')
    <div id="preloader"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">All of bids</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Theme</th>
                            <th>Message</th>
                            <th>User name</th>
                            <th>User mail</th>
                            <th>File</th>
                            <th>Time to create</th>
                            <th>Delivered</th>
                        </tr>
                        @foreach($data as $dib)
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$dib->theme}}</td>
                                <td>{!! strlen($dib->message)>200?substr($dib->message,0,200) . ' <a href="#" class="readMore" data-id="' . $dib->id . '">read more...</a>':$dib->message !!}</td>
                                <td>{{$dib->name}}</td>
                                <td><a href="mailto:{{$dib->email }}">{{$dib->email}}</a></td>
                                <td>
                                    <a href="{{url('/download?file=' . urlencode($dib->file))}}"><i class="fa fa-download" aria-hidden="true"></i> Download user file</a>
                                </td>
                                <td>{{$dib->created_at}}</td>
                                <td>
                                    <label class="contain">
                                        <input name="read" data-id="{{$dib->id}}" type="checkbox" {{$dib->readed == '1'?'checked':''}}>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{$data->links()}}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    Modal body..
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('js')
    <script src="{{asset('js/script.js')}}"></script>
@stop