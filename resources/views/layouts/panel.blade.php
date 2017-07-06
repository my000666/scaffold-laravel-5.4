@extends('layouts.app')

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown-toggle").dropdown();
        });
    </script>
@endsection

@section('container')
    @parent

    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="{{ asset('img/sidebar-1.jpg') }}">
            @include('partials.leftbar_menu')
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="navbar-brand">@include('partials.breadcrumbs')</div>

                    </div>
                    @include('partials.topbar_menu')

                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endsection