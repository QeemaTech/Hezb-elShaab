@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">{{ trans('messages.add_form_title', ['form' => trans('messages.user')]) }}</p>
                        </div>
                    </div>
                    <div class="card-body">

                        {{-- User Information --}}
                        <p class="text-uppercase text-sm">{{ __('messages.user_information') }}</p>
                        <div class="row">
                            {{-- Name --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.email') }} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.phone') }}</label>
                                    <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.password') }} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="password">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Role --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.user_type') }} <span class="text-danger">*</span></label>
                                    <select name="role" class="form-select" id="">
                                        <option value="user">{{__('messages.user')}}</option>
                                        <option value="admin">{{__('messages.admin')}}</option>
                                    </select>
                                    @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Permissions --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.permissions') }} <span class="text-danger">*</span></label>
                                    <select name="permissions" class="form-select select2js" id="" multiple>
                                        @foreach ($permissions as $permission)
                                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('permissions') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.image') }}</label>
                                    <input class="form-control" type="file" name="image" accept="image/*" id="imageInput">
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                {{-- Preview --}}
                                <div class="mt-2">
                                    <img id="imagePreview" src="#" alt="Preview" style="max-width: 150px; display: none; border-radius: 5px;">
                                </div>
                            </div>
                        </div>

                        <hr class="horizontal dark">

                        {{-- Status --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input m-0" type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                    <label class="form-check-label mx-3">{{ __('messages.active') }}</label>
                                </div>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="row mt-4">
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm ms-auto">{{ __('messages.create_user') }}</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        let preview = document.getElementById('imagePreview');
        let file = event.target.files[0];

        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endpush
@endsection
