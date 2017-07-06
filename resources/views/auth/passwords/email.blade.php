@extends('layouts.auth')

@section('content')
<div class="container" id="reset">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <img class="img img-responsive center-block" src="{{ asset('img/logo.png') }}">
            <br><br>
        </div>

        <div class="col-md-4 col-md-offset-4">
            <div class="panel">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" id="form" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
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

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="btn-group-justified">
                                    <button type="submit" class="btn btn-teal" style="width: 100%">
                                        Send
                                    </button>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <div class="col-md-12">
                                <span class="pull-left">Back to <a href="{{ route('login') }}">login</a>!</span>
                                <span class="pull-right">Not yet  <a href="{{ route('register') }}">registered</a>?</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
