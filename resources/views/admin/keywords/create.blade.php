@extends('layouts.admin.app')

@inject('keyword', 'App\Models\Keyword')

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
                {!! Form::open(['url' => route('admin.keywords.store'), 'method' => 'post']) !!}
                    <div class="box-body">
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('name', '名称') !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '名称']) !!}
                            {!! $errors->first('name', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('sort')) has-error @endif">
                            {!! Form::label('sort', '排序') !!}
                            {!! Form::number('sort', old('sort', config('custom.default_sort')), ['class' => 'form-control', 'placeholder' => '排序']) !!}
                            {!! $errors->first('sort', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('status')) has-error @endif">
                            {!! Form::label('status', '状态') !!}
                            {!! Form::select('status', $keyword->status_display, old('status'), ['class' => 'form-control']) !!}
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