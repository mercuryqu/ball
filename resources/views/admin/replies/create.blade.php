@extends('layouts.admin.app')

@inject('reply', 'App\Models\Reply')

@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.replies.create'
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.replies.store'), 'method' => 'post', 'files' => true]) !!}
                {!! Form::hidden('comment_id', old('comment_id', $comment->id)) !!}
                {!! Form::hidden('previous', old('previous', $previous)) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('', '小程序名称') !!}
                            {!! Form::text('', old('', $comment->app->name), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                            {!! $errors->first('', show_error_html()) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('', '评论用户名称') !!}
                            {!! Form::text('', old('', $comment->member->name), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                            {!! $errors->first('', show_error_html()) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('', '评论内容') !!}
                            {!! Form::textarea('', old('', $comment->body), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                            {!! $errors->first('', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('body')) has-error @endif">
                            {!! Form::label('body', '回复内容') !!}
                            {!! Form::textarea('body', old('body'), ['class' => 'form-control', 'placeholder' => '回复内容']) !!}
                            {!! $errors->first('body', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('status')) has-error @endif">
                            {!! Form::label('status', '状态') !!}
                            {!! Form::select('status', $reply->status_display, old('status'), ['class' => 'form-control']) !!}
                            {!! $errors->first('status', show_error_html()) !!}
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