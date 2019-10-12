@extends('layouts.admin.app')

<!-- Breadcrumb -->
@section('content-header')
    @include('layouts.admin._content-header', [
        'breadcrumbs' => 'admin.home',
     ])
@endsection

@section('content')
    <div class="row">

        @foreach($data as $item)
            @component('layouts.admin.common.components.box')

                @slot('today_count') {{ $item['today_count'] }} @endslot
                @slot('today_title') {{ $item['today_title'] }} @endslot
                @slot('all_count') {{ $item['all_count'] }} @endslot
                @slot('all_title') {{ $item['all_title'] }} @endslot
                @slot('color') {{ $item['color'] }} @endslot
                @slot('icon') {{ $item['icon'] }} @endslot

            @endcomponent
        @endforeach

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $all_view_count or 0  }}</h3>

                    <p>总浏览数</p>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
@endsection