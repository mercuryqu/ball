@extends('layouts.admin.app')

@inject('ad_position', 'App\Models\AdPosition')

@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.ad_positions.create'
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.ad_positions.store'), 'method' => 'post', 'files' => true]) !!}
                    <div class="box-body">
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('name', '名称') !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '广告位名称']) !!}
                            {!! $errors->first('name', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('platform')) has-error @endif">
                            {!! Form::label('platform', '平台') !!}
                            {!! Form::select('platform', $ad_position->platform_display, old('platform'), ['class' => 'form-control', 'placeholder' => '请选择平台']) !!}
                            {!! $errors->first('platform', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('position')) has-error @endif">
                            {!! Form::label('position', '位置') !!}
                            {!! Form::select('position', $ad_position->position_display, old('position'), ['class' => 'form-control', 'placeholder' => '请选择位置']) !!}
                            {!! $errors->first('position', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('status')) has-error @endif">
                            {!! Form::label('status', '状态') !!}
                            {!! Form::select('status', $ad_position->status_display, old('status'), ['class' => 'form-control']) !!}
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