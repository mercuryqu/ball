@extends('layouts.admin.app')

<!-- Model -->
@inject('message', 'App\Models\Sms')

<!-- Breadcrumb -->
@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.sms.index',
     ])
@endsection

@section('content')
    <!-- content -->
    <div class="row">
        <div class="col-xs-12">
            {!! Form::open(['route' => ['admin.sms.index'], 'method' => 'get']) !!}
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
                                {!! Form::label('filter_telephone', '手机号码 (关键字)') !!}
                                {!! Form::number('filter_telephone', old('filter_telephone'), ['class' => 'form-control', 'placeholder' => '请输入手机号码']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_code', '验证码') !!}
                                {!! Form::number('filter_code', old('filter_code'), ['class' => 'form-control', 'placeholder' => '请输入验证码']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_type', '类型') !!}
                                {!! Form::select('filter_type', $message->type_display, old('filter_type'), ['class' => 'form-control', 'placeholder' => '全部类型']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('filter_status', '状态') !!}
                                {!! Form::select('filter_status', $message->status_display, old('filter_status'), ['class' => 'form-control', 'placeholder' => '全部状态']) !!}
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
                    <h3 class="box-title">短信列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="appTable" class="table table-bordered table-striped">
                        <thead>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '手机号', '内容', '类型', '验证码', '备注', '添加时间', '状态']])
                        </thead>
                        <tbody>
                        @foreach($sms as $message)
                            <tr>
                                <td>{{ $message->id or '' }}</td>
                                <td>{{ $message->telephone or '' }}</td>
                                <td>{{ $message->body or '' }}</td>
                                <td>{{ $message->typeDisplay or '' }}</td>
                                <td>{{ $message->code or '' }}</td>
                                <td>{{ $message->comment or '' }}</td>
                                <td>{{ $message->created_at or '' }}</td>
                                <td>{{ $message->statusDisplay or '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '手机号', '内容', '类型', '验证码', '备注', '添加时间', '状态']])
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->

                <!-- Paginate -->
                @include('layouts.admin.common.pagination', ['model' => $sms, 'filters' => [
                    'filter_telephone' => old('filter_telephone', $filter_telephone),
                    'filter_code' => old('filter_code', $filter_code),
                    'filter_type' => old('filter_type', $filter_type),
                    'filter_status' => old('filter_status', $filter_status),
                ]])
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection