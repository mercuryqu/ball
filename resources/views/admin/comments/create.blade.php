@extends('layouts.admin.app')

@inject('comment', 'App\Models\Comment')

@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.comments.create'
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.comments.store'), 'method' => 'post', 'files' => true]) !!}
                    <div class="box-body">
                        <div class="form-group @if($errors->has('app_id')) has-error @endif">
                            {!! Form::label('app_id', '小程序ID') !!}
                            {!! Form::number('app_id', old('app_id'), ['class' => 'form-control', 'placeholder' => '小程序ID']) !!}
                            {!! $errors->first('app_id', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('member_id')) has-error @endif">
                            {!! Form::label('member_id', '会员ID') !!}
                            {!! Form::number('member_id', old('member_id'), ['class' => 'form-control', 'placeholder' => '会员ID']) !!}
                            {!! $errors->first('member_id', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('star')) has-error @endif">
                            {!! Form::label('star', '评分（1-5颗星）') !!}
                            {!! Form::number('star', old('star'), ['class' => 'form-control', 'placeholder' => '评分（1-5颗星）']) !!}
                            {!! $errors->first('star', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('body')) has-error @endif">
                            {!! Form::label('body', '内容') !!}
                            {!! Form::textarea('body', old('body'), ['class' => 'form-control', 'placeholder' => '内容']) !!}
                            {!! $errors->first('body', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('status')) has-error @endif">
                            {!! Form::label('status', '状态') !!}
                            {!! Form::select('status', $comment->status_display, old('status'), ['class' => 'form-control']) !!}
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