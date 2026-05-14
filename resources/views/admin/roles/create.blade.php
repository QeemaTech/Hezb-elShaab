@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">
                                    {{ trans('messages.add_form_title', ['form' => trans(key: 'messages.role')]) }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- name --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.name') }} <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Permissions</label><br>
                                        <select name="permissions[]" id="" class="form-select select2js" multiple>
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->name }}">
                                                    {{ $permission->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- Submit --}}
                            <div class="row mt-4">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-sm ms-auto">{{ __('messages.create_role') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
