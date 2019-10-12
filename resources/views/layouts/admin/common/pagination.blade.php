@if(isset($model))
    <div class="box-footer clearfix">
        <div class="col-sm-5">
            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                {{ $model->firstItem() }} @if($model->firstItem()) - @endif {{ $model->lastItem() }} (共{{$model->total()}}条记录)
            </div>
        </div>

        {!! $model->appends($filters)->links() !!}
    </div>
@endif