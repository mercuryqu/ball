@extends('layouts.admin.auth.app')

@section('content')
    <form action="{{ route('admin.auth.login') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group has-feedback">
            {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '邮箱']) !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '密码']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        {!! Form::checkbox('remember', old('remember')) !!} 记住密码
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                {!! Form::submit('登录', ['class' => 'btn btn-primary btn-block btn-flat']) !!}
            </div>
            <!-- /.col -->
        </div>
    </form>

    {{--<a href="#">找回密码</a><br>--}}
{{--    <a href="{{ route('auth.register') }}" class="text-center">去注册</a>--}}
@endsection

@section('js')
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
@endsection