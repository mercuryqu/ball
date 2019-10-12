@extends('layouts.admin.app')

@section('content-header')
    <!-- Breadcrumb -->
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.keywords.edit',
        'model' => $keyword
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.keywords.update', $keyword), 'method' => 'put']) !!}
                {!! Form::hidden('id', old('id', $keyword->id)) !!}
                {!! Form::hidden('previous', old('previous', \URL::previous())) !!}
                <div class="box-body">
                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        {!! Form::label('name', '名称') !!}
                        {!! Form::text('name', old('name', $keyword->name), ['class' => 'form-control', 'placeholder' => '名称']) !!}
                        {!! $errors->first('name', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('sort')) has-error @endif">
                        {!! Form::label('sort', '排序') !!}
                        {!! Form::number('sort', old('sort', $keyword->sort), ['class' => 'form-control', 'placeholder' => '排序']) !!}
                        {!! $errors->first('sort', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        {!! Form::label('status', '状态') !!}
                        {!! Form::select('status', $keyword->status_display, old('status', $keyword->status), ['class' => 'form-control']) !!}
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