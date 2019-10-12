<section class="content-header">
    <h1>
        首页
        @if($create_action && $create_url)
        <a href="{{ route('admin.apps.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> 新建小程序</a>
        @endif
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">仪表盘</li>
    </ol>
</section>