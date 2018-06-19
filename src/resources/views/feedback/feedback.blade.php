@extends('adminlte::page')

@section('title', 'Feedback form')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Feedback form</h3>
            </div>
            <form role="form" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Theme:</label>
                  <input type="text" class="form-control" id="theme" name="theme" placeholder="The theme text">
                </div>
                <div class="form-group">
                  <label>Message</label>
                  <textarea class="form-control" rows="3" placeholder="Enter message text"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">

                  <p class="help-block">Any file what you need to attach</p>
                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
    </div>
@stop