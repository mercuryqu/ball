<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('statics/admin/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <!-- Status -->
        {{--<a href="#"><i class="fa fa-circle text-success"></i> 系统管理员</a>--}}
      </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
      </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <li @if(request()->routeIs('admin.home')) class="active" @endif><a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> <span>首页</span></a></li>
      </ul>

      <li class="header">小程序管理</li>
      <!-- Optionally, you can add icons to the links -->
      <li @if(request()->routeIs('admin.modules.*')) class="active" @endif><a href="{{ route('admin.modules.index') }}"><i class="fa fa-chrome"></i> <span>模块列表</span></a>
      <li @if(request()->routeIs('admin.apps.*')) class="active" @endif><a href="{{ route('admin.apps.index') }}"><i class="fa fa-chrome"></i> <span>小程序列表</span></a></li>
      <li @if(request()->routeIs('admin.topics.*')) class="active" @endif><a href="{{ route('admin.topics.index') }}"><i class="fa fa-book"></i> <span>专题列表</span></a></li>
      <li @if(request()->routeIs('admin.categories.*')) class="active" @endif><a href="{{ route('admin.categories.index') }}"><i class="fa fa-bookmark"></i> <span>分类列表</span></a></li>
      <li @if(request()->routeIs('admin.keywords.*')) class="active" @endif><a href="{{ route('admin.keywords.index') }}"><i class="fa fa-key"></i> <span>关键词列表</span></a></li>
      <li @if(request()->routeIs('admin.comments.*')) class="active" @endif><a href="{{ route('admin.comments.index') }}"><i class="fa fa-commenting-o"></i> <span>评论列表</span></a></li>
      <li @if(request()->routeIs('admin.replies.*')) class="active" @endif><a href="{{ route('admin.replies.index') }}"><i class="fa fa-reply"></i> <span>回复列表</span></a></li>
    </ul>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">关联管理</li>
      <!-- Optionally, you can add icons to the links -->
      <li @if(request()->routeIs('admin.modulegables.*')) class="active" @endif><a href="{{ route('admin.modulegables.index') }}"><i class="fa fa-chrome"></i> <span>模块关联列表</span></a>
      <li @if(request()->routeIs('admin.app_topic.*')) class="active" @endif><a href="{{ route('admin.app_topic.index') }}"><i class="fa fa-chrome"></i> <span>专题和小程序关联列表</span></a>
      <li @if(request()->routeIs('admin.app_category.*')) class="active" @endif><a href="{{ route('admin.app_category.index') }}"><i class="fa fa-chrome"></i> <span>分类和小程序关联列表</span></a>
    </ul>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">会员管理</li>
      <!-- Optionally, you can add icons to the links -->
      <li @if(request()->routeIs('admin.members.*')) class="active" @endif><a href="{{ route('admin.members.index') }}"><i class="fa fa-user"></i> <span>会员列表</span></a></li>
      {{--<li><a href="#"><i class="fa fa-recycle"></i> <span>会员回收站</span></a></li>--}}
    </ul>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">广告管理</li>
      <!-- Optionally, you can add icons to the links -->
      <li @if(request()->routeIs('admin.ads.*')) class="active" @endif><a href="{{ route('admin.ads.index') }}"><i class="fa fa-tv"></i> <span>广告列表</span></a></li>
      <li @if(request()->routeIs('admin.ad_positions.*')) class="active" @endif><a href="{{ route('admin.ad_positions.index') }}"><i class="fa fa-clone"></i> <span>广告位列表</span></a></li>
    </ul>
    {{--<ul class="sidebar-menu" data-widget="tree">--}}
      {{--<li class="header">统计管理</li>--}}
      {{--<!-- Optionally, you can add icons to the links -->--}}
      {{--<li><a href="#"><i class="fa fa-delicious"></i> <span>小程序统计</span></a></li>--}}
      {{--<li><a href="#"><i class="fa fa-ioxhost"></i> <span>分类统计</span></a></li>--}}
    {{--</ul>--}}
    {{--<ul class="sidebar-menu" data-widget="tree">--}}
      {{--<li class="header">设置</li>--}}
      {{--<!-- Optionally, you can add icons to the links -->--}}
      {{--<li><a href="#"><i class="fa fa-cog"></i> <span>系统设置</span></a></li>--}}
    {{--</ul>--}}
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">记录</li>
      <!-- Optionally, you can add icons to the links -->
      <li @if(request()->routeIs('admin.sms.*')) class="active" @endif><a href="{{ route('admin.sms.index') }}"><i class="fa fa-envelope"></i> <span>短信记录</span></a></li>
    </ul>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">设置</li>
      <!-- Optionally, you can add icons to the links -->
      <li @if(request()->routeIs('admin.settings.*')) class="active" @endif><a href="{{ route('admin.settings.index') }}"><i class="fa fa-envelope"></i> <span>系统设置</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>