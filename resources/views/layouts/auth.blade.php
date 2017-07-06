@extends('layouts.app')

@section('styles')
    {{--<style>--}}
        {{--html, body {--}}
            {{--height: 100%;--}}
            {{--padding: 0;--}}
            {{--display: flex;--}}
            {{--flex-direction: column;--}}
        {{--}--}}

        {{--.auth {--}}
            {{--flex-grow: 1;--}}
        {{--}--}}

        {{--.auth .panel {--}}
            {{--box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);--}}
        {{--}--}}

        {{--.vertical-center {--}}
            {{--display: flex;--}}
            {{--align-items: center;--}}
            {{--justify-content: center;--}}
            {{--min-height: 85vh;--}}
        {{--}--}}
    {{--</style>--}}
@endsection

@section('container')
    @parent

    <div class="vertical-center auth">
        @yield('content')
    </div>
@endsection