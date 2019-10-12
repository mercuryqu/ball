@extends('layouts.admin.app')

<!-- Model -->
@inject('category', 'App\Models\Category')

<!-- Breadcrumb -->
@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.categories.index',
        'create_name' => '添加分类',
        'create_url' => route('admin.categories.create')
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
            {!! Form::open(['route' => ['admin.categories.index'], 'method' => 'get']) !!}
            {!! Form::hidden('filter_parent_category_id', old('filter_parent_category_id')) !!}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">过滤条件</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
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
                                {!! Form::label('filter_name', '名称 (关键字)') !!}
                                {!! Form::text('filter_name', old('filter_name'), ['class' => 'form-control', 'placeholder' => '请输入名称']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_parent_category_name', '上级名称 (关键字)') !!}
                                {!! Form::text('filter_parent_category_name', old('filter_parent_category_name'), ['class' => 'form-control', 'placeholder' => '请输入上级名称']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_level', '层级') !!}
                                {!! Form::select('filter_level', $category->level_display, old('filter_level'), ['class' => 'form-control', 'placeholder' => '全部层级']) !!}
                            </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> 应用过滤条件</button>
                    <a class="btn btn-warning pull-right" href="{{ route('admin.categories.index') }}"><i class="fa fa-trash"></i> 清除过滤条件</a>
                </div>
            </div>
            {{ Form::close() }}

            <!-- Table index -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">分类列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="appTable" class="table table-bordered table-striped">
                        <thead>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '名称', '层级', '下级数量', '上级名称', '排序', '添加时间', '状态', '操作']])
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id or '' }}</td>
                                <td>
                                    @if($category->icon)
                                        <div class="user-panel">
                                            <div class="pull-left image">
                                                <img src="{{ $category->icon }}" class="img-circle" alt="{{ $category->name }}">
                                                <span>{{ $category->name or '' }}</span>
                                            </div>
                                        </div>
                                    @else
                                        {{ $category->name or '' }}
                                    @endif
                                </td>
                                <td>{{ $category->levelDisplay or '' }}</td>
                                <td>{{ $category->childCategories->count() }}</td>
                                <td>{{ $category->parentCategory->name or '' }}</td>
                                <td class="sort">{{ $category->sort or '' }}</td>
                                <td>{{ $category->created_at or '' }}</td>
                                <td>{{ $category->statusDisplay or '' }}</td>
                                <td>
                                    <a class="btn btn-primary btn-xs"
                                       href="{{ route('admin.categories.edit', $category->id) }}">查看 / 编辑</a>
                                    <a class="btn btn-success btn-xs"
                                       href="{{ route('admin.app_category.index', ['filter_category_id' => $category->id]) }}">查看分类下小程序</a>
                                    @if($category->childCategories->count() > 0)
                                    <a class="btn btn-info btn-xs"
                                       href="{{ route('admin.categories.index', ['filter_parent_category_id' => $category->id]) }}">查看下级分类</a>
                                    @endif
                                    {{--<a class="btn btn-danger btn-xs"--}}
                                       {{--data-toggle="modal"--}}
                                       {{--data-target="#confirm-delete-modal"--}}
                                       {{--data-name="{{ $category->name or '' }}"--}}
                                       {{--data-href="{{ route('admin.categories.destroy', $category->id) }}">删除--}}
                                    {{--</a>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '名称', '层级', '下级数量', '上级名称', '排序', '添加时间', '状态', '操作']])
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->

                <!-- Paginate -->
                @include('layouts.admin.common.pagination', ['model' => $categories, 'filters' => [
                    'filter_name' => old('filter_name', $filter_name),
                    'filter_parent_category_name' => old('filter_parent_category_name', $filter_parent_category_name),
                    'filter_level' => old('filter_level', $filter_level),
                ]])
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection