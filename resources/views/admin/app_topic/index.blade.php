@extends('layouts.admin.app')

<!-- Breadcrumb -->
@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.app_topic.index'
     ])
@endsection

<!-- Delete Modal -->
@section('modals')
    @include('layouts.admin.common.modals', [
        'modal_type' => 'delete',
        'show_delete_msg' => true,
        'delete_msg' => '删除后可在回收站恢复！',
    ])
@endsection

@section('content')
    <!-- content -->
    <div class="row">
        <div class="col-xs-12">
            {!! Form::open(['route' => ['admin.app_topic.index'], 'method' => 'get']) !!}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">过滤条件</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        {{--<div class="col-md-3">--}}
                            {{--<div class="form-group">--}}
                                {{--{!! Form::label('filter_date_range', '创建时间') !!}--}}
                                {{--<div class="input-group">--}}
                                    {{--<div class="input-group-addon">--}}
                                        {{--<i class="fa fa-calendar"></i>--}}
                                    {{--</div>--}}
                                    {{--{!! Form::text('filter_date_range', old('filter_date_range'), ['class' => 'form-control', 'placeholder' => '请选择时间段']) !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_topic_id', '专题ID') !!}
                                {!! Form::number('filter_topic_id', old('filter_topic_id'), ['class' => 'form-control', 'placeholder' => '专题ID']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_app_id', '小程序ID') !!}
                                {!! Form::number('filter_app_id', old('filter_app_id'), ['class' => 'form-control', 'placeholder' => '小程序ID']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_topic_name', '专题名称 (关键字)') !!}
                                {!! Form::text('filter_topic_name', old('filter_topic_name'), ['class' => 'form-control', 'placeholder' => '请输入专题名称']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_app_name', '小程序名称 (关键字)') !!}
                                {!! Form::text('filter_app_name', old('filter_app_name'), ['class' => 'form-control', 'placeholder' => '请输入小程序名称']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> 应用过滤条件</button>
                    <a class="btn btn-warning pull-right" href="{{ route('admin.app_topic.index') }}"><i class="fa fa-trash"></i> 清除过滤条件</a>
                </div>
            </div>
            {{ Form::close() }}

            <!-- Table index -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">模块列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="appTable" class="table table-bordered table-striped">
                        <thead>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '专题名称', '小程序名称', '排序', '添加时间', '操作']])
                        </thead>
                        <tbody>
                        @foreach($app_topics as $app_topic)
                            <tr>
                                <td>{{ $app_topic->id or '' }}</td>
                                <td>{{ $app_topic->topic->title or '' }}</td>
                                <td>{{ $app_topic->app->name or '' }}</td>
                                <td class="sort">{{ $app_topic->sort or '' }}</td>
                                <td>{{ $app_topic->created_at or '' }}</td>
                                <td>
                                    <a class="btn btn-danger btn-xs"
                                       data-toggle="modal"
                                       data-target="#confirm-delete-modal"
                                       data-name="ID为{{ $app_topic->id or '' }}的关联关系"
                                       data-href="{{ route('admin.app_topic.destroy', $app_topic->id) }}">删除
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '专题名称', '小程序名称', '排序', '添加时间', '操作']])
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->

                <!-- Paginate -->
                @include('layouts.admin.common.pagination', ['model' => $app_topics, 'filters' => [
                    'filter_app_id' => old('filter_app_id', $filter_app_id),
                    'filter_topic_id' => old('filter_topic_id', $filter_topic_id),
                    'filter_app_name' => old('filter_app_name', $filter_app_name),
                    'filter_topic_name' => old('filter_topic_name', $filter_topic_name),
                ]])
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection