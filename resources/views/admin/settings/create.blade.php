@extends('layouts.admin.app')

@inject('setting', 'App\Models\Setting')

@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.keywords.create'
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => route('admin.settings.store'), 'method' => 'post']) !!}
                    <div class="box-body">
                        <div class="form-group @if($errors->has('platform')) has-error @endif">
                            {!! Form::label('platform', '平台') !!}
                            {!! Form::select('platform', $setting->platform_display, old('platform'), ['class' => 'form-control', 'placeholder' => '请选择平台']) !!}
                            {!! $errors->first('platform', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('key')) has-error @endif">
                            {!! Form::label('key', 'Key（前缀：global_：全局，pc_：PC端，wap_：WAP端，api_：API端）') !!}
                            {!! Form::text('key', old('key'), ['class' => 'form-control', 'placeholder' => '配置Key']) !!}
                            {!! $errors->first('key', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('value')) has-error @endif">
                            {!! Form::label('value', 'Value') !!}
                            {!! Form::text('value', old('value'), ['class' => 'form-control', 'placeholder' => '配置Value']) !!}
                            {!! $errors->first('value', show_error_html()) !!}
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