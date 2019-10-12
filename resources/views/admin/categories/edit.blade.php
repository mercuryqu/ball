@extends('layouts.admin.app')

@section('content-header')
    <!-- Breadcrumb -->
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.categories.edit',
        'model' => $category
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.categories.update', $category), 'method' => 'put', 'files' => true]) !!}
                {!! Form::hidden('id', old('id', $category->id)) !!}
                {!! Form::hidden('previous', old('previous', \URL::previous())) !!}
                <div class="box-body">
                    @if($category->level > 1)
                    <div class="form-group">
                        {!! Form::label('parent_category_id', '上级分类ID') !!}
                        {!! Form::text('parent_category_id', $category->parent_category_id, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('parent_category_name', '上级分类名称') !!}
                        {!! Form::text('parent_category_name', $category->parentCategory->name, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                    </div>
                    @endif
                    <div class="form-group">
                        {!! Form::label('level', '层级') !!}
                        {!! Form::text('level', $category->levelDisplay, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                    </div>
                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        {!! Form::label('name', '名称') !!}
                        {!! Form::text('name', old('name', $category->name), ['class' => 'form-control', 'placeholder' => '分类名称']) !!}
                        {!! $errors->first('name', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('icon_file')) has-error @endif">
                        {!! Form::label('icon_file', '图标(长宽比例为：' . config('custom.category_icons_width') . '*' . config('custom.category_icons_height') . '，最大不超过' . config('custom.category_icons_max_size') . 'kb)') !!}
                        {!! Form::file('icon_file', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                        @if($category->icon)
                            <p></p>
                            <img src="{{ $category->icon or '' }}" width="{{ config('custom.category_icons_width') }}">
                            <hr>
                        @endif
                        {!! $errors->first('icon_file', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('sort')) has-error @endif">
                        {!! Form::label('sort', '排序') !!}
                        {!! Form::number('sort', old('sort', $category->sort), ['class' => 'form-control']) !!}
                        {!! $errors->first('sort', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('status')) has-error @endif">
                        {!! Form::label('status', '状态') !!}
                        {!! Form::select('status', $category->status_display, old('status', $category->status), ['class' => 'form-control']) !!}
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