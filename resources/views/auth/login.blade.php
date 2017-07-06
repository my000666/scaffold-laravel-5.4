@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <br><img class="img img-responsive center-block" src="{{ asset('img/logo.png') }}"><br>
            </div>

            <div class="col-md-4 col-md-offset-4">
                <div class="panel">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" id="form" method="POST" action="{{ route('login') }}">
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
                                        <input id="password" type="password" class="form-control" placeholder="Your Password" name="password">
                                        <span class="material-icons form-control-feedback">clear</span>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="btn-group-justified">
                                        <button type="submit" class="btn btn-teal" style="width: 100%">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="checkbox">
                                <label class="pull-right">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                                </label>
                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <span class="pull-left">Not yet  <a href="{{ route('register') }}">registered</a>?</span>
                                    <span class="pull-right">Forgot my <a href="{{ route('password.request') }}">password</a>!</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
