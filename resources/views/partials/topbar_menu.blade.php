<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
        <li class="hidden-sm hidden-xs">
            <a href="{{ route('home.index') }}">
                <i class="material-icons">dashboard</i>
                <p class="hidden-lg hidden-md">Dashboard</p>
            </a>
        </li>
        {{--<li class="dropdown">--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                {{--<i class="material-icons">notifications</i>--}}
                {{--<span class="notification">5</span>--}}
                {{--<p class="hidden-lg hidden-md">Notifications</p>--}}
            {{--</a>--}}
            {{--<ul class="dropdown-menu">--}}
                {{--<li><a href="#">Mike John responded to your email</a></li>--}}
                {{--<li><a href="#">You have 5 new tasks</a></li>--}}
                {{--<li><a href="#">You're now friend with Andrew</a></li>--}}
                {{--<li><a href="#">Another Notification</a></li>--}}
                {{--<li><a href="#">Another One</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        <li class="dropdown">
            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                <p>
                    <i class="fa fa-cog"></i>
                    {{ Auth::user()->name }}
                    <span class="caret"></span>
                </p>
            </a>
            <ul class="dropdown-menu">
                {{ Form::open(['url' => route('logout'), 'id' => 'logout']) }}{{ Form::close() }}
                <li>
                    <a href="{{ route('profile.index') }}"><i class="material-icons">person</i> My Profile</a>
                </li>
                <li>
                    <a class="btn btn-danger" onclick="$('#logout').submit()">Logout <i class="material-icons">exit_to_app</i></a>
                </li>
            </ul>
        </li>
    </ul>
</div>