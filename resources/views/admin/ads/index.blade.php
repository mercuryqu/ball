@extends('layouts.admin.app')

<!-- Model -->
@inject('ad', 'App\Models\Ad')

<!-- Breadcrumb -->
@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.ads.index',
        'create_name' => '添加广告',
        'create_url' => route('admin.ads.create')
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
            {!! Form::open(['route' => ['admin.ads.index'], 'method' => 'get']) !!}
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
                                    {{--{!! Form::text('filter_date_range', old('filter_date_range'), ['class' => 'form-control date-range', 'placeholder' => '请选择时间段']) !!}--}}
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
                                {!! Form::label('filter_ad_position_id', '广告位ID') !!}
                                {!! Form::number('filter_ad_position_id', old('filter_ad_position_id', $filter_ad_position_id), ['class' => 'form-control', 'placeholder' => '请输入广告位ID']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_ad_position_name', '广告位名称 (关键字)') !!}
                                {!! Form::text('filter_ad_position_name', old('filter_ad_position_name'), ['class' => 'form-control', 'placeholder' => '请输入广告位名称']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_jump_type', '跳转类型') !!}
                                {!! Form::select('filter_jump_type', $ad->jump_type_display, old('filter_status'), ['class' => 'form-control', 'placeholder' => '全部跳转类型']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_platform', '平台') !!}
                                {!! Form::select('filter_platform', $ad->platform_display, old('filter_platform'), ['class' => 'form-control', 'placeholder' => '全部平台']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_status', '状态') !!}
                                {!! Form::select('filter_status', $ad->status_display, old('filter_status'), ['class' => 'form-control', 'placeholder' => '全部状态']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> 应用过滤条件</button>
                    <a class="btn btn-warning pull-right" href="{{ route('admin.ads.index') }}"><i class="fa fa-trash"></i> 清除过滤条件</a>
                </div>
            </div>
            {{ Form::close() }}

            <!-- Table index -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">广告列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="appTable" class="table table-bordered table-striped">
                        <thead>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '名称', '跳转类型', '平台', '广告位名称', '开始时间', '结束时间', '排序', '状态', '添加时间', '操作']])
                        </thead>
                        <tbody>
                        @forelse($ads as $ad)
                            <tr>
                                <td>{{ $ad->id or '' }}</td>
                                <td>{{ $ad->name or '' }}</td>
                                <td>{{ $ad->jumpTypeDisplay or '' }}</td>
                                <td>{{ $ad->platformDisplay or '' }}</td>
                                <td>{{ $ad->adPosition->name or '' }}</td>
                                <td>{{ $ad->start_at or '' }}</td>
                                <td>{{ $ad->end_at or '' }}</td>
                                <td class="sort">{{ $ad->sort or '' }}</td>
                                <td>{{ $ad->statusDisplay or '' }}</td>
                                <td>{{ $ad->created_at or '' }}</td>
                                <td>
                                    <a class="btn btn-primary btn-xs"
                                       href="{{ route('admin.ads.edit', $ad->id) }}">查看 / 编辑</a>
                                    <a class="btn btn-success btn-xs"
                                       href="{{ route('admin.ad_positions.index', ['filter_id' => $ad->ad_position_id]) }}">查看所属广告位</a>
                                    <a class="btn btn-danger btn-xs"
                                       data-toggle="modal"
                                       data-target="#confirm-delete-modal"
                                       data-name="{{ $ad->name or '' }}"
                                       data-href="{{ route('admin.ads.destroy', $ad->id) }}">删除
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center"><td colspan="10">暂无数据！</td></tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '名称', '跳转类型', '平台', '广告位名称', '开始时间', '结束时间', '排序', '状态', '添加时间', '操作']])
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->

                <!-- Paginate -->
                @include('layouts.admin.common.pagination', ['model' => $ads, 'filters' => [
                    'filter_name' => old('filter_name', $filter_name),
                    'filter_ad_position_id' => old('filter_ad_position_id', $filter_ad_position_id),
                    'filter_ad_position_name' => old('filter_ad_position_name', $filter_ad_position_name),
                    'filter_jump_type' => old('filter_jump_type', $filter_jump_type),
                    'filter_platform' => old('filter_platform', $filter_platform),
                    'filter_status' => old('filter_status', $filter_status),
                ]])
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection