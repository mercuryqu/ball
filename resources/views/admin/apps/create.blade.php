@extends('layouts.admin.app')

@inject('app', 'App\Models\App')

@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.apps.create'
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.apps.store'), 'method' => 'post', 'files' => true]) !!}
                    <div class="box-body">
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('name', '名称') !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '小程序名称']) !!}
                            {!! $errors->first('name', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('slogan')) has-error @endif">
                            {!! Form::label('slogan', '口号') !!}
                            {!! Form::text('slogan', old('slogan'), ['class' => 'form-control', 'placeholder' => '小程序口号']) !!}
                            {!! $errors->first('slogan', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('keyword')) has-error @endif">
                            {!! Form::label('keyword', '关键词') !!}
                            {!! Form::text('keyword', old('keyword'), ['class' => 'form-control', 'placeholder' => '小程序关键词']) !!}
                            {!! $errors->first('keyword', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('instruction')) has-error @endif">
                            {!! Form::label('instruction', '简介') !!}
                            {!! Form::textarea('instruction', old('instruction'), ['class' => 'form-control', 'placeholder' => '小程序简介']) !!}
                            {!! $errors->first('instruction', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('member_id')) has-error @endif">
                            {!! Form::label('member_id', '会员ID') !!}
                            {!! Form::number('member_id', old('member_id', 1), ['class' => 'form-control', 'placeholder' => '会员ID']) !!}
                            {!! $errors->first('member_id', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('logo_file')) has-error @endif">
                            {!! Form::label('logo_file', 'Logo(长宽比例为：' . config('custom.app_logos_width') . '*' . config('custom.app_logos_height') . '，最大不超过' . config('custom.app_logos_max_size') . 'kb)') !!}
                            {!! Form::file('logo_file', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                            {!! $errors->first('logo_file', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('code_file')) has-error @endif">
                            {!! Form::label('code_file', '二维码(长宽比例为：' . config('custom.app_codes_width') . '*' . config('custom.app_codes_height') . '，最大不超过' . config('custom.app_codes_max_size') . 'kb)') !!}
                            {!! Form::file('code_file', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                            {!! $errors->first('code_file', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('images_files.*') || $errors->has('images_files')) has-error @endif">
                            {!! Form::label('images_files[]', '展示图(支持选择上传，长宽比例为：' . config('custom.app_images_width') . '*' . config('custom.app_images_height') . '，每张图最大不超过' . config('custom.app_images_max_size') . 'kb)') !!}
                            {!! Form::file('images_files[]', ['class' => 'form-control', 'multiple' => 'multiple', 'accept' => 'image/*']) !!}
                            {!! $errors->first('images_files', show_error_html()) !!}
                            {!! $errors->first('images_files.*', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('categories')) has-error @endif">
                            {!! Form::label('categories', '分类ID') !!}
                            {!! Form::textarea('categories', old('categories'), ['class' => 'form-control', 'placeholder' => '关联分类ID(多个用英文状态下逗号隔开)']) !!}
                            {!! $errors->first('categories', show_error_html()) !!}
                        </div>
                        <div class="form-group @if($errors->has('status')) has-error @endif">
                            {!! Form::label('status', '状态') !!}
                            {!! Form::select('status', $app->status_display, old('status', 1), ['class' => 'form-control']) !!}
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