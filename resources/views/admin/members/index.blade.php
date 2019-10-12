@extends('layouts.admin.app')

<!-- Model -->
@inject('member', 'App\Models\Member')

<!-- Breadcrumb -->
@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.members.index',
        'create_name' => '添加会员',
        'create_url' => route('admin.members.create')
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
            {!! Form::open(['route' => ['admin.members.index'], 'method' => 'get']) !!}
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
                                {!! Form::label('filter_name', '名称 (关键字)') !!}
                                {!! Form::text('filter_name', old('filter_name'), ['class' => 'form-control', 'placeholder' => '请输入名称']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_username', '用户名 (关键字)') !!}
                                {!! Form::text('filter_username', old('filter_username'), ['class' => 'form-control', 'placeholder' => '请输入用户名']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_telephone', '手机号 (关键字)') !!}
                                {!! Form::number('filter_telephone', old('filter_telephone'), ['class' => 'form-control', 'placeholder' => '请输入手机号']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_email', '邮箱 (关键字)') !!}
                                {!! Form::email('filter_email', old('filter_email'), ['class' => 'form-control', 'placeholder' => '请输入邮箱']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_status', '状态') !!}
                                {!! Form::select('filter_status', $member->status_display, old('filter_status'), ['class' => 'form-control', 'placeholder' => '全部状态']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> 应用过滤条件</button>
                    <a class="btn btn-warning pull-right" href="{{ route('admin.members.index') }}"><i class="fa fa-trash"></i> 清除过滤条件</a>
                </div>
            </div>
            {{ Form::close() }}

            <!-- Table index -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">会员列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="appTable" class="table table-bordered table-striped">
                        <thead>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '名称', '用户名', '手机号', '邮箱', '添加时间', '状态', '操作']])
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member->id or '' }}</td>
                                <td>
                                    @if($member->avatar)
                                        <div class="user-panel">
                                            <div class="pull-left image">
                                                <img src="{{ $member->avatar }}" class="img-circle" alt="{{ $member->name }}">
                                                <span>{{ $member->name or '' }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $member->username or '' }}</td>
                                <td>{{ $member->telephone or '' }}</td>
                                <td>{{ $member->email or '' }}</td>
                                <td>{{ $member->created_at or '' }}</td>
                                <td>{{ $member->statusDisplay or '' }}</td>
                                <td>
                                    <a class="btn btn-primary btn-xs"
                                       href="{{ route('admin.members.edit', $member->id) }}">查看 / 编辑</a>
                                    <a class="btn btn-danger btn-xs"
                                       data-toggle="modal"
                                       data-target="#confirm-delete-modal"
                                       data-name="{{ $member->name or '' }}"
                                       data-href="{{ route('admin.members.destroy', $member->id) }}">删除
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '名称', '用户名', '手机号', '邮箱', '添加时间', '状态', '操作']])
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->

                <!-- Paginate -->
                @include('layouts.admin.common.pagination', ['model' => $members, 'filters' => [
                    'filter_name' => old('filter_name', $filter_name),
                    'filter_username' => old('filter_username', $filter_username),
                    'filter_telephone' => old('filter_telephone', $filter_telephone),
                    'filter_email' => old('filter_email', $filter_email),
                    'filter_status' => old('filter_status', $filter_status),
                ]])
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection