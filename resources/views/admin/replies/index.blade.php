@extends('layouts.admin.app')

<!-- Model -->
@inject('reply', 'App\Models\Reply')

<!-- Breadcrumb -->
@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.replies.index',
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
            {!! Form::open(['route' => ['admin.replies.index'], 'method' => 'get']) !!}
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
                                {!! Form::label('filter_app_name', '小程序名称 (关键字)') !!}
                                {!! Form::text('filter_app_name', old('filter_app_name'), ['class' => 'form-control', 'placeholder' => '请输入小程序名称']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_member_name', '会员名称 (关键字)') !!}
                                {!! Form::text('filter_member_name', old('filter_member_name'), ['class' => 'form-control', 'placeholder' => '请输入会员名称']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_status', '状态') !!}
                                {!! Form::select('filter_status', $reply->status_display, old('filter_status'), ['class' => 'form-control', 'placeholder' => '全部状态']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> 应用过滤条件</button>
                    <a class="btn btn-warning pull-right" href="{{ route('admin.replies.index') }}"><i class="fa fa-trash"></i> 清除过滤条件</a>
                </div>
            </div>
            {{ Form::close() }}

            <!-- Table index -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">回复列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="appTable" class="table table-bordered table-striped">
                        <thead>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '小程序名称', '会员用户名', '评论内容', '回复内容',  '添加时间', '状态', '操作']])
                        </thead>
                        <tbody>
                        @foreach($replies as $reply)
                            <tr>
                                <td>{{ $reply->id or '' }}</td>
                                <td>{{ $reply->comment->app->name or '' }}</td>
                                <td>{{ $reply->user->name or '' }}</td>
                                <td>{{ str_limit($reply->comment->body, 20, '...') }}</td>
                                <td>{{ str_limit($reply->body, 20, '...') }}</td>
                                <td>{{ $reply->created_at or '' }}</td>
                                <td>{{ $reply->statusDisplay or '' }}</td>
                                <td>
                                    <a class="btn btn-primary btn-xs"
                                       href="{{ route('admin.replies.edit', $reply->id) }}">查看 / 编辑</a>
                                    {{--<a class="btn btn-danger btn-xs"--}}
                                       {{--data-toggle="modal"--}}
                                       {{--data-target="#confirm-delete-modal"--}}
                                       {{--data-name="对{{ $reply->user->name or '' }}的回复"--}}
                                       {{--data-href="{{ route('admin.replies.destroy', $reply->id) }}">删除--}}
                                    {{--</a>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '小程序名称', '会员用户名', '评论内容', '回复内容',  '添加时间', '状态', '操作']])
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->

                <!-- Paginate -->
                @include('layouts.admin.common.pagination', ['model' => $replies, 'filters' => [
                    'filter_status' => old('filter_status', $filter_status),
                ]])
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection