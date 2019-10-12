@if($modal_type == 'delete')
    <!-- Delete Modal -->
    <div class="modal modal-danger fade" id="confirm-delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">删除警告</h4>
                </div>
                <div class="modal-body">
                    <p>是否确定删除<span class="modal-name"></span>？ @if(isset($show_delete_msg) && $show_delete_msg) {{ $delete_msg or '删除后不可恢复！' }} @endif</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['method' => 'delete', 'id' => 'deleteModalForm']) !!}
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-outline">确定</button>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endif

@if($modal_type == 'change')
    <!-- Change Modal -->
    <div class="modal modal-info fade" id="confirm-change-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['method' => 'post', 'id' => 'changeModalForm', 'class'=> "form2", 'onsubmit' => 'return validateForm();']) !!}
                {{ method_field('PATCH') }}
                <div class="modal-header">
                    审核小程序(<span class="modal-name"></span>)
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span></button>
                </div>
                <div class="modal-body" style="height:300px;">

                    <div class="form-group" style="margin: 10px 20px 10px 20px;">
                        <label for="status">状态：</label>
                        {!! Form::select('status', ['1' => '正常', '2' => '未通过'], old('status'), ['class' => 'form-control', 'id' => 'status']) !!}
                    </div>

                    <div class="form-group" style="margin: 10px 20px 10px 20px;display: none;" id="reason-div">
                        <label for="reason">理由：</label>
                        <textarea class="form-control col-sm-12" name="reason" type="text" value="" id="reason" style="height: 135px;" placeholder="多个理由请换行输入"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">取消</button>
                    <button class="btn btn-outline btn-ok">确认</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.modal -->
@endif

    