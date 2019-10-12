<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-{{ $color or 'green' }}">
        <div class="inner">
            <h3>{{ $today_count or 0 }}</h3>
            <p>{{ $today_title }}</p>
        </div>
        <div class="inner">
            <h3>{{ $all_count or 0 }}</h3>
            <p>{{ $all_title }}</p>
        </div>
        <div class="icon">
            <i class="ion ion-{{ $icon or 'bag'  }}"></i>
        </div>
        {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
    </div>
</div>