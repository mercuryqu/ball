@extends('layouts.admin.app')

<!-- Model -->
@inject('comment', 'App\Models\Comment')

<!-- Breadcrumb -->
@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.comments.index',
        'create_name' => '添加评论',
        'create_url' => route('admin.comments.create')
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
            {!! Form::open(['route' => ['admin.comments.index'], 'method' => 'get']) !!}
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
                                {!! Form::label('filter_body', '内容 (关键字)') !!}
                                {!! Form::text('filter_body', old('filter_body'), ['class' => 'form-control', 'placeholder' => '请输入内容']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_is_reply', '回复状态') !!}
                                {!! Form::select('filter_is_reply', $comment->is_reply_display, old('filter_is_reply'), ['class' => 'form-control', 'placeholder' => '全部状态']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_status', '状态') !!}
                                {!! Form::select('filter_status', $comment->status_display, old('filter_status'), ['class' => 'form-control', 'placeholder' => '全部状态']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> 应用过滤条件</button>
                    <a class="btn btn-warning pull-right" href="{{ route('admin.comments.index') }}"><i class="fa fa-trash"></i> 清除过滤条件</a>
                </div>
            </div>
            {{ Form::close() }}

            <!-- Table index -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">评论列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="appTable" class="table table-bordered table-striped">
                        <thead>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '小程序名称', '会员名称', '评分（★）', '评论内容',  '添加时间', '回复', '状态', '操作']])
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->id or '' }}</td>
                                <td>{{ $comment->app->name or '' }}</td>
                                <td>{{ $comment->member->name or '' }}</td>
                                <td>{{ $comment->star or '' }}</td>
                                <td>{{ str_limit($comment->body, 20, '...') }}</td>
                                <td>{{ $comment->created_at or '' }}</td>
                                <td>{{ $comment->isReplyDisplay or '' }}</td>
                                <td>{{ $comment->statusDisplay or '' }}</td>
                                <td>
                                    <a class="btn btn-primary btn-xs"
                                       href="{{ route('admin.comments.edit', $comment->id) }}">查看 / 编辑</a>
                                    @if($comment->is_reply == 0)
                                    <a class="btn btn-success btn-xs"
                                       href="{{ route('admin.replies.create', ['comment_id' => $comment->id, 'previous' => request()->fullUrl()]) }}">回复</a>
                                    @elseif ($comment->is_reply == 1)

                                    <a class="btn btn-warning btn-xs"
                                       href="{{ route('admin.replies.edit', $comment->reply->id) }}">查看回复</a>
                                    @endif
                                    <a class="btn btn-danger btn-xs"
                                       data-toggle="modal"
                                       data-target="#confirm-delete-modal"
                                       data-name="{{ $comment->app->name or '' }}的评论及其回复"
                                       data-href="{{ route('admin.comments.destroy', $comment->id) }}">删除
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '小程序名称', '会员名称', '评分', '评论内容',  '添加时间', '回复', '状态', '操作']])
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->

                <!-- Paginate -->
                @include('layouts.admin.common.pagination', ['model' => $comments, 'filters' => [
                    'filter_app_name' => old('filter_app_name', $filter_app_name),
                    'filter_member_name' => old('filter_member_name', $filter_member_name),
                    'filter_status' => old('filter_status', $filter_status),
                    'filter_body' => old('filter_body', $filter_body),
                ]])
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection