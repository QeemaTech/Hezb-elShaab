@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h6>{{ __('messages.roles') }}</h6>
                            <a href="{{ route('admin.roles.create') }}" class="float-end me-1 btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle fa-lg"></i>
                                {{ trans('messages.add_form_title', ['form' => trans(key: 'messages.role')]) }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    @foreach ($role->permissions as $permission)
                        <span class="badge bg-info">{{ $permission->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this role?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
