@extends('layouts.admin.app')

@section('content-header')
    <!-- Breadcrumb -->
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.apps.show',
        'model' => $app
     ])
@endsection

@section('content')
    <!-- Default box -->
        <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
                <strong>名称</strong>
                <div class="text-muted h4">
                    {{ $app->name or '' }}
                </div>
                <hr>

                <strong>所属用户</strong>
                <div class="text-muted h4">
                    {{ $app->member->name or '' }}
                </div>
                <hr>

                <strong>评分</strong>
                <div class="text-muted h4">
                    {{ $app->star or '' }}
                </div>
                <hr>

                <strong>点击数</strong>
                <div class="text-muted h4">
                    {{ $app->view_count or '' }}
                </div>
                <hr>

                <strong>推荐</strong>
                <p class="text-muted h4">
                    <div>
                    @if($app->is_recommended)
                        <span class="label label-success">{{ $app->isRecommendedDisplay or '' }}</span>
                    @else
                        <span class="label label-danger">{{ $app->isRecommendedDisplay or '' }}</span>
                    @endif
                    </div>
                </p>
                <hr>

                <strong>状态</strong>
                <p class="text-muted h4">
                <div>
                    @if($app->status)
                        <span class="label label-success">{{ $app->statusDisplay or '' }}</span>
                    @else
                        <span class="label label-danger">{{ $app->statusDisplay or '' }}</span>
                    @endif
                </div>
                </p>
                <hr>

                {!! Form::button('返回', ['class' => 'btn btn-success btn-cancel pull-left']) !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box-body -->
@endsection