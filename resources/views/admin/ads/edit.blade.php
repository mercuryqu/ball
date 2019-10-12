@extends('layouts.admin.app')

@section('content-header')
    <!-- Breadcrumb -->
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.ads.edit',
        'model' => $ad
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.ads.update', $ad), 'method' => 'put', 'files' => true]) !!}
                {!! Form::hidden('previous', old('previous', \URL::previous())) !!}
                {!! Form::hidden('id', $ad->id) !!}
                {!! Form::hidden('image_url', old('image_url', $ad->image_url)) !!}
                <div class="box-body">
                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        {!! Form::label('name', '名称') !!}
                        {!! Form::text('name', old('name', $ad->name), ['class' => 'form-control', 'placeholder' => '广告名称']) !!}
                        {!! $errors->first('name', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('instruction')) has-error @endif">
                        {!! Form::label('instruction', '描述') !!}
                        {!! Form::textarea('instruction', old('instruction', $ad->instruction), ['class' => 'form-control', 'placeholder' => '广告描述']) !!}
                        {!! $errors->first('instruction', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('platform')) has-error @endif">
                        {!! Form::label('platform', '平台') !!}
                        {!! Form::select('platform', $ad->platform_display, old('platform', $ad->platform), ['class' => 'form-control']) !!}
                        {!! $errors->first('platform', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('image_file')) has-error @endif">
                        {!! Form::label('image_file', '广告图(长宽比例为：' . config('custom.ad_images_width') . '*' . config('custom.ad_images_height') . '，最大不超过' . config('custom.ad_images_max_size') . 'kb)') !!}
                        {!! Form::file('image_file', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                        @if($ad->image_url)
                            <p></p>
                            <img src="{{ $ad->image_url or '' }}" width="{{ config('custom.ad_images_width') }}">
                            <hr>
                        @endif
                        {!! $errors->first('image_file', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('jump_type')) has-error @endif">
                        {!! Form::label('jump_type', '跳转类型') !!}
                        {!! Form::select('jump_type', $ad->jump_type_display, old('jump_type', $ad->jump_type), ['class' => 'form-control']) !!}
                        {!! $errors->first('jump_type', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('app_id')) has-error @endif" style="display: block;" id="app_id_div">
                        {!! Form::label('app_id', '小程序ID') !!}
                        {!! Form::text('app_id', old('app_id', $ad->app_id), ['class' => 'form-control', 'placeholder' => '小程序ID']) !!}
                        {!! $errors->first('app_id', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('jump_url')) has-error @endif" style="display: none;" id="jump_url_div">
                        {!! Form::label('jump_url', '跳转链接') !!}
                        {!! Form::text('jump_url', old('jump_url', $ad->jump_url), ['class' => 'form-control', 'placeholder' => '跳转链接']) !!}
                        {!! $errors->first('jump_url', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('ad_position_id')) has-error @endif">
                        {!! Form::label('ad_position_id', '广告位ID') !!}
                        {!! Form::text('ad_position_id', old('ad_position_id', $ad->ad_position_id), ['class' => 'form-control', 'placeholder' => '广告位ID']) !!}
                        {!! $errors->first('ad_position_id', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('start_at')) has-error @endif">
                        {!! Form::label('start_at', '开始时间') !!}
                        {!! Form::text('start_at', old('start_at', $ad->start_at), ['class' => 'form-control', 'placeholder' => '开始时间：时间格式为Y-m-d H:i:s']) !!}
                        {!! $errors->first('start_at', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('end_at')) has-error @endif">
                        {!! Form::label('end_at', '结束时间') !!}
                        {!! Form::text('end_at', old('end_at', $ad->end_at), ['class' => 'form-control', 'placeholder' => '结束时间：时间格式为Y-m-d H:i:s']) !!}
                        {!! $errors->first('end_at', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('sort')) has-error @endif">
                        {!! Form::label('sort', '排序') !!}
                        {!! Form::number('sort', old('sort', $ad->sort), ['class' => 'form-control', 'placeholder' => '排序']) !!}
                        {!! $errors->first('sort', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('status')) has-error @endif">
                        {!! Form::label('status', '状态') !!}
                        {!! Form::select('status', $ad->status_display, old('status', $ad->status), ['class' => 'form-control']) !!}
                        {!! $errors->first('status', show_error_html()) !!}
                    </div>
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

@section('js')
    <script type="text/javascript">
        $(function () {
            // control jump_url input form to display and hidden
            input_display_control();

            $('#jump_type').on('change', function () {
                input_display_control();
            });

            function input_display_control()
            {
                var jump_type = $('#jump_type').val();
                if (jump_type == 0) {
                    $('#app_id_div').css('display', 'block').css('disabled');
                    $('#jump_url_div').css('display', 'none').css('disabled');
                } else if (jump_type == 1) {
                    $('#app_id_div').css('display', 'none').css('disabled');
                    $('#jump_url_div').css('display', 'block').css('disabled');
                }
            }
        });
    </script>
@endsection