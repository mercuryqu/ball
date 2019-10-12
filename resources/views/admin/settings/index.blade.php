@extends('layouts.admin.app')

@section('content-header')
    <!-- Breadcrumb -->
    <section class="content-header">
        <h1>
            <p>编辑
                @if(empty($filter_platform))
                    全局
                @elseif($filter_platform == 1)
                    PC
                @elseif($filter_platform == 2)
                    WAP
                @elseif($filter_platform == 3)
                    API
                @endif 系统设置</p>
            @foreach($filter_platform_configs as $filter)
                <a href="{{ $filter['url'] or '' }}" class="btn @if(request()->fullUrl() == $filter['url']) btn-success @else btn-primary @endif">
                    {{ $filter['title'] or '' }}</a>
            @endforeach
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.settings.index') }}"><i class="fa fa-dashboard"></i> 系统设置</a></li>
            <li class="active">编辑系统设置</li>
        </ol>
</section>
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::open(['url' => route('admin.settings.update'), 'method' => 'put']) !!}
                {!! Form::hidden('platform', $filter_platform) !!}
                <div class="box-body">
                    @forelse($settings as $setting)
                        <div class="form-group @if($errors->has("value.$setting->key")) has-error @endif">
                            {!! Form::hidden('id[]', $setting->id) !!}
                            {!! Form::label("value[$setting->key]", $setting->keyDisplay) !!}
                            {!! Form::text("value[$setting->key]", old("value.$setting->key", $setting->value), ['class' => 'form-control']) !!}
                            {!! $errors->first("value.$setting->key", show_error_html()) !!}
                        </div>
                    @empty
                        <p class="text-center">暂无数据！</p>
                    @endforelse
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    @if($settings->count() > 0)
                        {!! Form::submit('修改', ['class' => 'btn btn-success pull-right']) !!}
                    @endif
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box -->

        </div>
        <!--/.col (left) -->
    </div>
    <!-- /.row -->
@endsection