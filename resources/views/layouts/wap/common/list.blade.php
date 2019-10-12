@if(isset($item))
    <div class="napes">
        <a target="_top" href="{{ route('wap.apps.show', $item) }}">
            <div class="nape_lefts">
                @if($item->logo)
                    <img class="logo-img" src="{{ $item->logo or '' }}"/>
                @endif
            </div>
        </a>
        <div class="nape_rights_spam clearfix">
            <a target="_top" href="{{ route('wap.apps.show', $item) }}">
                <div class="nape_rights">
                    <h6 class="limit-name">{{ $item->name or '' }}</h6>
                    <p class="limit-name">{{ $item->slogan or '' }}</p>
                </div>
            </a>
            <span style="display:table;overflow:hidden;" onclick="show_code('{{ $item->name or '' }}', '{{ $item->code or '/statics/wap/images/code_default.png' }}')"><b style="font-weight: 400;color: #1e90e6;font-size:0.26rem;vertical-align:middle;display:table-cell;">体验</b></span>
        </div>
    </div>
@endif