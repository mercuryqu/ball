@extends('layouts.admin.app')

@section('content-header')
    <!-- Breadcrumb -->
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.members.edit',
        'model' => $member
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.members.update', $member), 'method' => 'put', 'files' => true]) !!}
                {!! Form::hidden('previous', old('previous', \URL::previous())) !!}
                {!! Form::hidden('id', $member->id) !!}
                {!! Form::hidden('avatar', $member->avatar) !!}
                <div class="box-body">
                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        {!! Form::label('name', '名称') !!}
                        {!! Form::text('name', old('name', $member->name), ['class' => 'form-control', 'placeholder' => '会员名称']) !!}
                        {!! $errors->first('name', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('username')) has-error @endif">
                        {!! Form::label('username', '用户名') !!}
                        {!! Form::text('username', old('username', $member->username), ['class' => 'form-control', 'placeholder' => '会员用户名']) !!}
                        {!! $errors->first('username', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('telephone')) has-error @endif">
                        {!! Form::label('telephone', '手机号') !!}
                        {!! Form::number('telephone', old('telephone', $member->telephone), ['class' => 'form-control', 'placeholder' => '会员手机号']) !!}
                        {!! $errors->first('telephone', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('email')) has-error @endif">
                        {!! Form::label('email', '邮箱') !!}
                        {!! Form::email('email', old('email', $member->email), ['class' => 'form-control', 'placeholder' => '会员邮箱']) !!}
                        {!! $errors->first('email', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('status')) has-error @endif">
                        {!! Form::label('status', '状态') !!}
                        {!! Form::select('status', $member->status_display, old('status', $member->status), ['class' => 'form-control']) !!}
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