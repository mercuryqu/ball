@extends('layouts.admin.app')

<!-- Model -->
@inject('modulegable', 'App\Models\Modulegable')
@inject('module', 'App\Models\Module')

<!-- Breadcrumb -->
@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.modulegables.index'
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
            {!! Form::open(['route' => ['admin.modulegables.index'], 'method' => 'get']) !!}
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
                                {!! Form::label('filter_module_id', '模块ID') !!}
                                {!! Form::number('filter_module_id', old('filter_module_id'), ['class' => 'form-control', 'placeholder' => '模块ID']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_module_name', '模块名称 (关键字)') !!}
                                {!! Form::text('filter_module_name', old('filter_module_name'), ['class' => 'form-control', 'placeholder' => '请输入模块名称']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_module_type', '模块类型') !!}
                                {!! Form::select('filter_module_type', $module->type_display, old('filter_module_type'), ['class' => 'form-control', 'placeholder' => '全部模块类型']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> 应用过滤条件</button>
                    <a class="btn btn-warning pull-right" href="{{ route('admin.modulegables.index') }}"><i class="fa fa-trash"></i> 清除过滤条件</a>
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
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '模块ID', '模块名称', '模块类型', '模块关联类型', '关联对象名称', '排序', '添加时间', '操作']])
                        </thead>
                        <tbody>
                        @foreach($modulegables as $modulegable)
                            <tr>
                                <td>{{ $modulegable->id or '' }}</td>
                                <td>{{ $modulegable->module_id or '' }}</td>
                                <td>{{ $modulegable->module->name or '' }}</td>
                                <td>{{ $modulegable->module->typeDisplay or '' }}</td>
                                <td>{{ $modulegable->modulegableTypeDisplay or '' }}</td>
                                <td>{{ $modulegable->modulegable_type == 'topics' ? $modulegable->topic->title : $modulegable->app->name }}</td>
                                <td class="sort">{{ $modulegable->sort or '' }}</td>
                                <td>{{ $modulegable->created_at }}</td>
                                <td>
                                    <a class="btn btn-danger btn-xs"
                                       data-toggle="modal"
                                       data-target="#confirm-delete-modal"
                                       data-name="ID为{{ $item->id or '' }}的关联关系"
                                       data-href="{{ route('admin.modulegables.destroy', $modulegable->id) }}">删除
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '模块ID', '模块名称', '模块类型', '模块关联类型', '关联对象名称', '排序', '添加时间', '操作']])
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->

                <!-- Paginate -->
                @include('layouts.admin.common.pagination', ['model' => $modulegables, 'filters' => [
                    'filter_module_id' => old('filter_module_id', $filter_module_id),
                    'filter_module_name' => old('filter_module_name', $filter_module_name),
                    'filter_module_type' => old('filter_module_type', $filter_module_type),
                ]])
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection