@extends('layouts.base')

@section('body')
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Drewez</b> Power
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
                    <input id="name"
                           type="text"
                           class="form-control"
                           name="name"
                           placeholder="Name"
                           value="{{ old('name') }}"
                           required
                           autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>

                    @if ($errors->has('name'))
                        <span class="helper-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                    <input id="email"
                           type="email"
                           class="form-control"
                           name="email"
                           placeholder="Email"
                           value="{{ old('email') }}"
                           required
                           autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    @if ($errors->has('email'))
                        <span class="helper-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    @if ($errors->has('password'))
                        <span class="helper-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Confirm password"
                           required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-push-8 col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{ route('password.request') }}">I forgot my password</a><br>
            <a href="{{ route('login') }}" class="text-center">I allready have an account</a>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    </body>
@endsection