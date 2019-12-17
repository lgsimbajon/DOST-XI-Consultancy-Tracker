@extends('layouts.app')

@section('styles')
    <style>
        .login-box-body:hover{
            -webkit-box-shadow: 0px 0px 6px 6px #ccc;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
            -moz-box-shadow:    0px 0px 6px 6px #ccc;  /* Firefox 3.5 - 3.6 */
            box-shadow:         0px 0px 6px 6px #ccc;
        }
    </style>
@endsection

@section('content')
<div class="login-box">
    <div class="login-logo">

        <img style="width: 106px;" src="{{ URL::to('/') }}/img/dost.png"><img style="width: 210px;" src="{{ URL::to('/') }}/img/logoct.png">
        <br>

        {{--<a href="#">--}}
            {{--DOST XI--}}
            {{--<br>--}}
            {{--Consultancy Tracker--}}
        {{--</a>--}}
    </div>
    <div class="login-box-body" style="border: solid; transition-timing-function: ease-in-out;">
        <p class="login-box-msg">
            {{ trans('global.login') }}
        </p>
        @if(session()->has('message'))
            <p class="alert alert-info">
                {{ session()->get('message') }}
            </p>
        @endif
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" class="form-control" required autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                @if($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" class="form-control" required placeholder="{{ trans('global.login_password') }}">
                @if($errors->has('password'))
                    <p class="help-block">
                        {{ $errors->first('password') }}
                    </p>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label><input type="checkbox" name="remember"> {{ trans('global.remember_me') }}</label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        Login
                    </button>
                </div>
            </div>
        </form>
        {{--<a href="{{ route('password.request') }}">--}}
            {{--{{ trans('global.forgot_password') }}--}}
        {{--</a>--}}


    </div>
</div>
@endsection

@section('scripts')
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