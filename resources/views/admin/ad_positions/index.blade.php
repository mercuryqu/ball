@extends('layouts.admin.app')

<!-- Model -->
@inject('ad_position', 'App\Models\AdPosition')

<!-- Breadcrumb -->
@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.ad_positions.index',
        'create_name' => '添加广告位',
        'create_url' => route('admin.ad_positions.create')
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
            {!! Form::open(['route' => ['admin.ad_positions.index'], 'method' => 'get']) !!}
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
                                {!! Form::label('filter_id', '广告位ID') !!}
                                {!! Form::text('filter_id', old('filter_id', $filter_id), ['class' => 'form-control', 'placeholder' => '请输入广告位ID']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_name', '名称 (关键字)') !!}
                                {!! Form::text('filter_name', old('filter_name', $ad_position->filter_name), ['class' => 'form-control', 'placeholder' => '请输入名称']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_position', '位置') !!}
                                {!! Form::select('filter_position', $ad_position->position_display, old('filter_position'), ['class' => 'form-control', 'placeholder' => '全部位置']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_platform', '平台') !!}
                                {!! Form::select('filter_platform', $ad_position->platform_display, old('filter_platform'), ['class' => 'form-control', 'placeholder' => '全部平台']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_status', '状态') !!}
                                {!! Form::select('filter_status', $ad_position->status_display, old('filter_status'), ['class' => 'form-control', 'placeholder' => '全部状态']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> 应用过滤条件</button>
                    <a class="btn btn-warning pull-right" href="{{ route('admin.ad_positions.index') }}"><i class="fa fa-trash"></i> 清除过滤条件</a>
                </div>
            </div>
            {{ Form::close() }}

            <!-- Table index -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">广告位列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="appTable" class="table table-bordered table-striped">
                        <thead>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '名称', '位置', '平台', '添加时间', '状态', '操作']])
                        </thead>
                        <tbody>
                        @foreach($ad_positions as $ad_position)
                            <tr>
                                <td>{{ $ad_position->id or '' }}</td>
                                <td>{{ $ad_position->name or '' }}</td>
                                <td>{{ $ad_position->positionDisplay or '' }}</td>
                                <td>{{ $ad_position->platformDisplay or '' }}</td>
                                <td>{{ $ad_position->created_at or '' }}</td>
                                <td>{{ $ad_position->statusDisplay or '' }}</td>
                                <td>
                                    <a class="btn btn-primary btn-xs"
                                       href="{{ route('admin.ad_positions.edit', $ad_position->id) }}">查看 / 编辑</a>
                                    <a class="btn btn-success btn-xs"
                                       href="{{ route('admin.ads.index', ['filter_ad_position_id' => $ad_position->id]) }}">查看广告位下广告</a>
                                    <a class="btn btn-danger btn-xs"
                                       data-toggle="modal"
                                       data-target="#confirm-delete-modal"
                                       data-name="{{ $ad_position->name or '' }}"
                                       data-href="{{ route('admin.ad_positions.destroy', $ad_position->id) }}">删除
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '名称', '位置', '平台', '添加时间', '状态', '操作']])
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->

                <!-- Paginate -->
                @include('layouts.admin.common.pagination', ['model' => $ad_positions, 'filters' => [
                    'filter_id' => old('filter_id', $filter_id),
                    'filter_name' => old('filter_name', $filter_name),
                    'filter_position' => old('filter_position', $filter_position),
                    'filter_platform' => old('filter_platform', $filter_platform),
                    'filter_status' => old('filter_status', $filter_status),
                ]])
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection