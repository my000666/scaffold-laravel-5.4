@extends('layouts.panel')

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('flash::message')
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="orange">
                <h4 class="title pull-left">Manage Roles</h4>
                <a type="button" rel="tooltip" title="" class="pull-right cursor-pointer"
                   data-toggle="modal"
                   data-target="#modal-form"
                   data-original-title="Add"
                   data-action="{{ route('role.create') }}"
                   data-title="Add New Role"
                >
                    <i class="fa fa-2x fa-plus-circle"></i>
                </a>
                <span class="clearfix"></span>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-9">
                        {!! Form::open(['url' => route('role.index'), 'method' => 'get']) !!}
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
                    <thead class="text-warning">
                    <tr>
                        <th style="width: 1%">#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th style="width: 1%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($index = 1)
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->mode_role->mode->display_name }}</td>
                            <td>{{ $role->description }}</td>
                            <td class="td-actions text-right">
                                <a type="button" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs"
                                   data-toggle="modal"
                                   data-target="#modal-form"
                                   data-original-title="Edit"
                                   data-action="{{ route('role.edit', $role->id) }}"
                                   data-title="Edit {{ $role->display_name }} Role"
                                >
                                    <i class="material-icons">edit</i>
                                </a>
                                <a type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs"
                                   data-toggle="modal"
                                   data-target="#modal-delete"
                                   data-original-title="Delete"
                                   data-action="{{ route('role.destroy', $role->id) }}"
                                   data-title="Delete Confirmation!"
                                   data-message="You are about to delete {{ $role->display_name }} record, this procedure is irreversible. Do you want to proceed?"
                                >
                                    <i class="material-icons">close</i>
                                    <div class="ripple-container"></div>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @if(!$roles->count())
                        <tr>
                            <td class="" colspan="5">No records found!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('partials.modal_delete')
    @include('partials.modal_form')
@endsection