<section class="content-header">
    <h1>
        {{ $menus[request()->route()->action['as']] or '默认标题' }}
        @if(isset($create_name) && isset($create_url))
            <a href="{{ $create_url }}" class="btn btn-primary"><i class="fa fa-{{ $create_fa or 'plus' }}"></i> {{ $create_name }}</a>
        @endif
    </h1>

    @if(isset($breadcrumbs) && isset($model))
        {!! Breadcrumbs::render($breadcrumbs, $model) !!}
    @else
        {!! Breadcrumbs::render($breadcrumbs) !!}
    @endif
</section>