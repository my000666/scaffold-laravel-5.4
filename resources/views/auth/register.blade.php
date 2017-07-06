@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <img class="img img-responsive center-block" src="{{ asset('img/logo.png') }}">
            <br><br>
        </div>

        <div class="col-md-4 col-md-offset-4">
            <div class="panel">
                <div class="panel-body">
                    <form class="form-horizontal" id="form" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="material-icons">email</i></span>
                                    <input id="email" type="text" class="form-control" name="email" placeholder="Email Address" value="{{ old('ic') }}" autofocus>
                                    <span class="material-icons form-control-feedback">clear</span>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="material-icons">lock</i></span>
                                    <input id="password" type="password" placeholder="Enter Password" class="form-control" name="password" autofocus>
                                    <span class="material-icons form-control-feedback">clear</span>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="material-icons">lock</i></span>
                                    <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" autofocus>
                                    <span class="material-icons form-control-feedback">clear</span>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="btn-group-justified">
                                    <button type="submit" class="btn btn-teal" style="width: 100%">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-12">
                            <div class="form-group">
                                <span class="pull-left">Already <a href="{{ route('login') }}">registered</a>!</span>
                                <span class="pull-right">Forgot your <a href="{{ route('password.request') }}">password</a>?</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
