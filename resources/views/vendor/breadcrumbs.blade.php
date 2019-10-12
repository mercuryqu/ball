@if (count($breadcrumbs))

    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li><a href="{{ $breadcrumb->url }}"><i class="fa fa-dashboard"></i> {{ $breadcrumb->title }}</a></li>
            @elseif(count($breadcrumbs) >= 1 && $loop->index == 0)
                <li><i class="fa fa-dashboard"></i> {{ $breadcrumb->title }}</li>
            @else
                <li class="active">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>

@endif