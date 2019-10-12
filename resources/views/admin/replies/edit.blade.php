@extends('layouts.admin.app')

@section('content-header')
    <!-- Breadcrumb -->
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.replies.edit',
        'model' => $reply
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                <!-- form start -->
                {!! Form::open(['url' => route('admin.replies.update', $reply), 'method' => 'put', 'files' => true]) !!}
                {!! Form::hidden('comment_id', old('comment_id',$reply->comment_id)) !!}
                {!! Form::hidden('id', old('id',$reply->id)) !!}
                {!! Form::hidden('previous', old('previous', $previous)) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('app_name', '小程序名称') !!}
                        {!! Form::text('app_name', old('app_name', $reply->comment->app->name), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                        {!! $errors->first('app_name', show_error_html()) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('member_name', '评论用户名称') !!}
                        {!! Form::text('member_name', old('member_name', $reply->comment->member->name), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                        {!! $errors->first('member_name', show_error_html()) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('comment_body', '评论内容') !!}
                        {!! Form::textarea('comment_body', old('comment_body', $reply->comment->body), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                        {!! $errors->first('comment_body', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('body')) has-error @endif">
                        {!! Form::label('body', '回复内容') !!}
                        {!! Form::textarea('body', old('body', $reply->body), ['class' => 'form-control', 'placeholder' => '回复内容']) !!}
                        {!! $errors->first('body', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('status')) has-error @endif">
                        {!! Form::label('status', '状态') !!}
                        {!! Form::select('status', $reply->status_display, old('status', $reply->status), ['class' => 'form-control']) !!}
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