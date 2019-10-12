<!-- bottom menu -->
<div class="mack_li">
    <a href="{{ route('wap.home') }}">
        <div>
            @if(request()->routeIs('wap.home'))
                <img src="{{ asset('statics/wap/images/star-light.png') }}">
                <p class="menu-color">精选</p>
            @else
                <img src="{{ asset('statics/wap/images/star-gray.png') }}">
                <p class="menu-gray">精选</p>
            @endif
        </div>
    </a>
    <a href="{{ route('wap.categories.index') }}">
        <div>
            @if(request()->routeIs('wap.categories.index'))
                <img src="{{ asset('statics/wap/images/category-light.png') }}">
                <p class="menu-color">分类</p>
            @else
                <img src="{{ asset('statics/wap/images/category-gray.png') }}">
                <p class="menu-gray">分类</p>
            @endif
        </div>
    </a>
    <a href="{{ route('wap.search.index') }}">
        <div>
            @if(request()->routeIs('wap.search.index'))
                <img src="{{ asset('statics/wap/images/search-light.png') }}">
                <p class="menu-color">搜索</p>
            @else
                <img src="{{ asset('statics/wap/images/search-gray.png') }}">
                <p class="menu-gray">搜索</p>
            @endif
        </div>
    </a>
</div>