@extends('layouts.admin.app')

@section('content-header')
    <!-- Breadcrumb -->
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.topics.edit',
        'model' => $topic
     ])
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.topics.update', $topic), 'method' => 'put', 'files' => true]) !!}
                {!! Form::hidden('previous', old('previous', \URL::previous())) !!}
                <div class="box-body">
                    <div class="form-group @if($errors->has('title')) has-error @endif">
                        {!! Form::label('title', '标题') !!}
                        {!! Form::text('title', old('title', $topic->title), ['class' => 'form-control', 'placeholder' => '专题标题']) !!}
                        {!! $errors->first('title', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('body')) has-error @endif">
                        {!! Form::label('body', '内容') !!}
                        <div id="content"></div>
                        <textarea id="body" name="body" style="display: none;">{{ old('body', $topic->body) }}</textarea>
                        {!! $errors->first('body', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('banner_file')) has-error @endif">
                        {!! Form::label('banner_file', 'Banner图(长宽比例为：670*827)') !!}
                        {!! Form::file('banner_file', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                        @if($topic->banner)
                            <p></p>
                            <img src="{{ $topic->banner }}" width="300">
                            <hr>
                        @endif
                        {!! $errors->first('banner_file', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('app_ids')) has-error @endif">
                        {!! Form::label('app_ids', '关联小程序ID') !!}
                        {!! Form::textarea('app_ids', old('app_ids', $topic->apps->pluck('id')->implode(',')), ['class' => 'form-control', 'placeholder' => '关联小程序ID']) !!}
                        {!! $errors->first('app_ids', show_error_html()) !!}
                    </div>
                    <div class="form-group @if($errors->has('title')) has-error @endif">
                        {!! Form::label('status', '状态') !!}
                        {!! Form::select('status', $topic->status_display, old('status', $topic->status), ['class' => 'form-control']) !!}
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

@section('js')
    <script type="text/javascript">
        var E = window.wangEditor;
        var editor = new E('#content');
        // 配置服务器端地址
        editor.customConfig.uploadFileName = 'picture';
        editor.customConfig.uploadImgMaxLength = 1;
        editor.customConfig.uploadImgServer = '{{ route('helper.image.upload') }}';
        editor.customConfig.uploadImgHooks = {
            // 如果服务器端返回的不是 {errno:0, data: [...]} 这种格式，可使用该配置
            // （但是，服务器端返回的必须是一个 JSON 格式字符串！！！否则会报错）
            customInsert: function (insertImg, result, editor) {
                // 图片上传并返回结果，自定义插入图片的事件（而不是编辑器自动插入图片！！！）
                // insertImg 是插入图片的函数，editor 是编辑器对象，result 是服务器端返回的结果
                // 举例：假如上传图片成功后，服务器端返回的是 {url:'....'} 这种格式，即可这样插入图片：
                var url = result.data.image_url;
                insertImg(url)
            }
        };
        var $text1 = $('#body');
        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $text1.val(html)
        };
        editor.create();
        // 初始化 textarea 的值
        editor.txt.html();
        editor.txt.html('{!! old('body', $topic->body) !!}')
        $text1.val('{!! old('body', $topic->body) !!}');
    </script>
@endsection