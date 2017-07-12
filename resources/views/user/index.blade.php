@extends('layouts.panel')

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('flash::message')
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="red">
                <h4 class="title pull-left">User List</h4>
                <a type="button" class="pull-right cursor-pointer"
                   data-toggle="modal"
                   data-target="#modal-form"
                   data-action="{{ route('user.create') }}"
                   data-title="Create User"
                >
                    <i class="fa fa-2x fa-plus-circle"></i>
                </a>
                <span class="clearfix"></span>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-9">
                        {!! Form::open(['url' => route('user.index'), 'method' => 'get']) !!}
                        <div class="input-group">
                            {{ Form::text('search', old('search'), ['class' => 'form-control', 'placeholder' => 'Search...']) }}
                            <span class="input-group-addon">
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <table class="table table-hover">
                    <thead class="text-danger">
                    <tr>
                        <th style="width: 1%">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 1%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($index = 1)
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles->first()->display_name }}</td>
                            <td class="td-actions text-right">
                                <a type="button" class="btn btn-primary btn-simple btn-xs"
                                   data-toggle="modal"
                                   data-target="#modal-form"
                                   data-action="{{ route('user.edit', $user->id) }}"
                                   data-title="Edit {{ $user->name }}"
                                >
                                    <i class="material-icons">edit</i>
                                </a>
                                <a type="button" class="btn btn-danger btn-simple btn-xs"
                                   data-toggle="modal"
                                   data-target="#modal-delete"
                                   data-action="{{ route('user.destroy', $user->id) }}"
                                   data-title="Delete Confirmation!"
                                   data-message="You are about to delete {{ $user->name }} record, this procedure is irreversible. Do you want to proceed?"
                                >
                                    <i class="material-icons">close</i>
                                    <div class="ripple-container"></div>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @if(!$users->count())
                        <tr>
                            <td class="text-center" colspan="5">No records found!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('partials.modal_delete')
    @include('partials.modal_form')
@endsection