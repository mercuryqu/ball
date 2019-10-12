@extends('layouts.admin.app')

@section('content-header')
    <!-- Breadcrumb -->
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.apps.edit',
        'model' => $app
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.apps.update', $app), 'method' => 'put', 'files' => true]) !!}
                {!! Form::hidden('previous', old('previous', \URL::previous())) !!}
                {!! Form::hidden('id', $app->id) !!}
                <div class="box-body">
                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        {!! Form::label('name', '名称') !!}
                        {!! Form::text('name', old('name', $app->name), ['class' => 'form-control', 'placeholder' => '小程序名称']) !!}
                        {!! $errors->first('name', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('slogan')) has-error @endif">
                        {!! Form::label('slogan', '口号') !!}
                        {!! Form::text('slogan', old('slogan', $app->slogan), ['class' => 'form-control', 'placeholder' => '小程序口号']) !!}
                        {!! $errors->first('slogan', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('keyword')) has-error @endif">
                        {!! Form::label('keyword', '关键词') !!}
                        {!! Form::text('keyword', old('keyword', $app->keyword), ['class' => 'form-control', 'placeholder' => '小程序关键词']) !!}
                        {!! $errors->first('keyword', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('instruction')) has-error @endif">
                        {!! Form::label('instruction', '简介') !!}
                        {!! Form::textarea('instruction', old('instruction', $app->instruction), ['class' => 'form-control', 'placeholder' => '小程序简介']) !!}
                        {!! $errors->first('instruction', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('member_id')) has-error @endif">
                        {!! Form::label('member_id', '会员ID') !!}
                        {!! Form::number('member_id', old('member_id', $app->member_id), ['class' => 'form-control', 'placeholder' => '会员ID']) !!}
                        {!! $errors->first('member_id', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('logo_file')) has-error @endif">
                        {!! Form::label('logo_file', 'Logo(长宽比例为：' . config('custom.app_logos_width') . '*' . config('custom.app_logos_height') . '，最大不超过' . config('custom.app_logos_max_size') . 'kb)') !!}
                        {!! Form::file('logo_file', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                        @if($app->logo)
                        <p></p>
                        <img src="{{ $app->logo or '' }}" width="{{ config('custom.app_logos_width') }}">
                        <hr>
                        @endif
                        {!! $errors->first('logo_file', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('code_file')) has-error @endif">
                        {!! Form::label('code_file', '二维码(长宽比例为：' . config('custom.app_codes_width') . '*' . config('custom.app_codes_height') . '，最大不超过' . config('custom.app_codes_max_size') . 'kb)') !!}
                        {!! Form::file('code_file', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                        @if($app->code)
                            <p></p>
                            <img src="{{ $app->code }}" width="{{ config('custom.app_codes_width') }}">
                            <hr>
                        @endif
                        {!! $errors->first('code_file', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('images_files')) has-error @endif">
                        {!! Form::label('images_files[]', '展示图(支持选择上传，长宽比例为：' . config('custom.app_images_width') . '*' . config('custom.app_images_height') . '，每张图最大不超过' . config('custom.app_images_max_size') . 'kb)') !!}
                        {!! Form::file('images_files[]', ['class' => 'form-control', 'multiple' => 'multiple', 'accept' => 'image/*']) !!}
                        @if($app->images->count() > 0)
                            <p></p>
                            @foreach($app->images->pluck('url') as $image)
                                <img src="{{ $image }}" width="300">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @endforeach
                            <hr>
                        @endif
                        {!! $errors->first('images_files', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('category_name')) has-error @endif">
                        {!! Form::label('category_name', '分类名称') !!}
                        {!! Form::textarea('category_name', old('categories', $app->categories->pluck('name')->implode(' | ')), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                        {!! $errors->first('category_name', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('categories')) has-error @endif">
                        {!! Form::label('categories', '分类ID') !!}
                        {!! Form::textarea('categories', old('categories', $app->categories->pluck('id')->implode(',')), ['class' => 'form-control', 'placeholder' => '关联分类ID(多个用英文状态下逗号隔开)']) !!}
                        {!! $errors->first('categories', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('status')) has-error @endif">
                        {!! Form::label('status', '状态') !!}
                        {!! Form::select('status', $app->status_display, old('status', $app->status), ['class' => 'form-control']) !!}
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