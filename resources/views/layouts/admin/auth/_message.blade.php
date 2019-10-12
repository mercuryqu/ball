@if (session()->has('info'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('info') }} （状态码：{{ Session::get('code') }}）
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session()->get('success') }} （状态码：{{ Session::get('code') }}）
    </div>
@endif

@if (session()->has('danger'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session()->get('danger') }} （状态码：{{ Session::get('code') }}）
    </div>
@endif