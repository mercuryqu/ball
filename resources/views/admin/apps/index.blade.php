@extends('layouts.admin.app')

<!-- Model -->
@inject('app', 'App\Models\App')

<!-- Breadcrumb -->
@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.apps.index',
        'create_name' => '添加小程序',
        'create_url' => route('admin.apps.create')
     ])
@endsection

<!-- Delete Modal -->
@section('modals')
    @include('layouts.admin.common.modals', [
        'modal_type' => 'delete',
        'show_delete_msg' => true,
        'delete_msg' => '删除后可在回收站恢复！',
    ])

    @include('layouts.admin.common.modals', [
        'modal_type' => 'change',
        'show_delete_msg' => true,
        'delete_msg' => '删除后可在回收站恢复！',
    ])
@endsection

@section('content')
    <!-- content -->
    <div class="row">
        <div class="col-xs-12">
            {!! Form::open(['route' => ['admin.apps.index'], 'method' => 'get']) !!}
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
                                {!! Form::text('filter_name', old('filter_name'), ['class' => 'form-control', 'placeholder' => '请输入小程序名称']) !!}
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
                                {!! Form::select('filter_status', $app->status_display, old('filter_status'), ['class' => 'form-control', 'placeholder' => '全部状态']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> 应用过滤条件</button>
                    <a class="btn btn-warning pull-right" href="{{ route('admin.apps.index') }}"><i class="fa fa-trash"></i> 清除过滤条件</a>
                </div>
            </div>
            {{ Form::close() }}

            <!-- Table index -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">小程序列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="appTable" class="table table-bordered table-striped">
                        <thead>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '名称', '会员名称', '评分', '点击数', '分类', '添加时间', '状态', '操作']])
                        </thead>
                        <tbody>
                        @foreach($apps as $app)
                            <tr>
                                <td>{{ $app->id or '' }}</td>
                                <td>
                                    @if($app->logo)
                                        <div class="user-panel">
                                            <div class="pull-left image">
                                                <img src="{{ $app->logo }}" class="img-circle" alt="{{ $app->name }}">
                                                <span>{{ $app->name or '' }}</span>
                                            </div>
                                        </div>
                                    @else
                                        {{ $app->name or '' }}
                                    @endif
                                </td>
                                <td>{{ $app->member->name or '' }}</td>
                                <td>{{ $app->star or '' }}</td>
                                <td>{{ $app->view_count or '' }}</td>
                                <td>{{ $app->categories->pluck('name')->implode(' | ') }}</td>
                                <td>{{ $app->created_at or '' }}</td>
                                <td>{{ $app->statusDisplay or '' }}</td>
                                <td>
                                    <a class="btn btn-primary btn-xs"
                                       href="{{ route('admin.apps.edit', $app->id) }}">查看 / 编辑</a>
                                    <a class="btn btn-success btn-xs"
                                       href="{{ route('admin.app_category.index', ['filter_app_id' => $app->id]) }}">查看所属分类</a>
                                    <a class="btn btn-success btn-xs"
                                       href="{{ route('admin.app_topic.index', ['filter_app_id' => $app->id]) }}">查看所属专题</a>
                                    <a class="btn btn-danger btn-xs"
                                       data-toggle="modal"
                                       data-target="#confirm-delete-modal"
                                       data-name="{{ $app->name or '' }}"
                                       data-href="{{ route('admin.apps.destroy', $app->id) }}">删除
                                    </a>
                                    @if($app->status == 0)
                                    <a class="btn btn-primary btn-xs"
                                       data-toggle="modal"
                                       data-target="#confirm-change-modal"
                                       data-name="{{ $app->name or '' }}" 
                                       data-href="{{ route('admin.apps.change', $app->id) }}">审核
                                   </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        @include('layouts.admin.common.tr', ['ths' => ['ID', '名称', '会员名称', '评分', '点击数', '分类', '添加时间', '状态', '操作']])
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->

                <!-- Paginate -->
                @include('layouts.admin.common.pagination', ['model' => $apps, 'filters' => [
                    'filter_name' => old('filter_name', $filter_name),
                    'filter_member_name' => old('filter_member_name', $filter_member_name),
                    'filter_is_recommended' => old('filter_is_recommended', $filter_is_recommended),
                    'filter_status' => old('filter_status', $filter_status),
                ]])
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
    $(function () {
        // show change modal and get name and action of from needed
        $('#confirm-change-modal').on('show.bs.modal', function (e) {
            $(this).find('.modal-name').text($(e.relatedTarget).data('name'));
            $(this).find('#changeModalForm').attr('action', $(e.relatedTarget).data('href'));
        });

        $("#status").on('change', function (){
            var status = $('#status').val();
            if (status == 1) {
                $('#reason-div').css('display', 'none');
                return false;
            }

            $('#reason-div').css('display', 'block');
            return false;
        });
        // $('#submit').on('click', function () {
            
        // });
    });

    function validateForm() {
        var status = $('#status').val();
        var reason = $('#reason').val();

        if (status == 2) {
            if(reason.length === 0) {
                alert('请输入理由！');
                return false;
            }
        }
        return true;
    }
    </script>
@endsection