@extends('layouts.admin.app')

@section('content-header')
    <!-- Breadcrumb -->
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.comments.edit',
        'model' => $comment
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.comments.update', $comment), 'method' => 'put', 'files' => true]) !!}
                {!! Form::hidden('previous', old('previous', \URL::previous())) !!}
                {!! Form::hidden('id', $comment->id) !!}
                <div class="box-body">
                    <div class="form-group @if($errors->has('star')) has-error @endif">
                        {!! Form::label('star', '评分（1-5颗星）') !!}
                        {!! Form::number('star', old('star', $comment->star), ['class' => 'form-control', 'placeholder' => '评分（1-5颗星）']) !!}
                        {!! $errors->first('star', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('body')) has-error @endif">
                        {!! Form::label('body', '内容') !!}
                        {!! Form::textarea('body', old('body', $comment->body), ['class' => 'form-control', 'placeholder' => '内容']) !!}
                        {!! $errors->first('body', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('status')) has-error @endif">
                        {!! Form::label('status', '状态') !!}
                        {!! Form::select('status', $comment->status_display, old('status', $comment->status), ['class' => 'form-control']) !!}
                        {!! $errors->first('status', show_error_html()) !!}
                    </div>
                </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    {!! Form::button('取消', ['class' => 'btn btn-danger btn-cancel pull-left']) !!}
                    {!! Form::submit('提交', ['class' => 'btn btn-success pull-right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box -->

        </div>
        <!--/.col (left) -->
    </div>
    <!-- /.row -->
@endsection