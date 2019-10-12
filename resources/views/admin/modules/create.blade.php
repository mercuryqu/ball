@extends('layouts.admin.app')

@inject('module', 'App\Models\Module')

@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.modules.create'
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.modules.store'), 'method' => 'post', 'files' => true]) !!}
                    <div class="box-body">
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('name', '名称') !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '模块名称']) !!}
                            {!! $errors->first('name', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('type')) has-error @endif">
                            {!! Form::label('type', '类型（注意：专题模块和图片加侧滑模块只能关联专题ID,侧滑加点跳模块只能关联小程序ID）') !!}
                            {!! Form::select('type', $module->type_display, old('type'), ['class' => 'form-control', 'placeholder' => '请选择类型']) !!}
                            {!! $errors->first('type', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('modulegable_ids')) has-error @endif">
                            {!! Form::label('modulegable_ids', '关联对象ID') !!}
                            {!! Form::textarea('modulegable_ids', old('modulegable_ids'), ['class' => 'form-control', 'placeholder' => '关联对象ID(多个用英文状态下逗号隔开)']) !!}
                            {!! $errors->first('modulegable_ids', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('sort')) has-error @endif">
                            {!! Form::label('sort', '排序') !!}
                            {!! Form::number('sort', old('sort', config('custom.default_sort')), ['class' => 'form-control', 'placeholder' => '排序']) !!}
                            {!! $errors->first('sort', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('status')) has-error @endif">
                            {!! Form::label('status', '状态') !!}
                            {!! Form::select('status', $module->status_display, old('status'), ['class' => 'form-control']) !!}
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