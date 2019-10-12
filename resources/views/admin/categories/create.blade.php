@extends('layouts.admin.app')

@inject('category', 'App\Models\Category')

@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.categories.create'
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.categories.store'), 'method' => 'post', 'files' => true]) !!}
                    <div class="box-body">
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('name', '名称') !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '分类名称']) !!}
                            {!! $errors->first('name', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('parent_category_id')) has-error @endif">
                            {!! Form::label('parent_category_id', '上级分类ID') !!}
                            {!! Form::number('parent_category_id', old('parent_category_id'), ['class' => 'form-control', 'placeholder' => '温馨提示：一级分类上级ID为0']) !!}
                            {!! $errors->first('parent_category_id', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('icon_file')) has-error @endif">
                            {!! Form::label('icon_file', '图标(长宽比例为：' . config('custom.category_icons_width') . '*' . config('custom.category_icons_height') . '，最大不超过' . config('custom.category_icons_max_size') . 'kb)') !!}
                            {!! Form::file('icon_file', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                            {!! $errors->first('icon_file', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('sort')) has-error @endif">
                            {!! Form::label('sort', '排序') !!}
                            {!! Form::number('sort', old('sort', config('custom.default_sort')), ['class' => 'form-control', 'placeholder' => '排序']) !!}
                            {!! $errors->first('sort', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('status')) has-error @endif">
                            {!! Form::label('status', '状态') !!}
                            {!! Form::select('status', $category->status_display, old('status'), ['class' => 'form-control']) !!}
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