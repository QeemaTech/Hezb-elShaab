@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">
                                    {{ trans('messages.update_form_title', ['form' => trans('messages.user')]) }}</p>
                            </div>
                        </div>
                        <div class="card-body">

                            {{-- User Information --}}
                            <p class="text-uppercase text-sm">{{ __('messages.user_information') }}</p>
                            <div class="row">
                                {{-- Name --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.name') }} <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ old('name', $user->name) }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.email') }} <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- National ID --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.national_id') }}</label>
                                        <input class="form-control" type="text" name="national_id"
                                            value="{{ old('national_id', $user->national_id) }}">
                                        @error('national_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Phone --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.phone') }}</label>
                                        <input class="form-control" type="text" name="phone"
                                            value="{{ old('phone', $user->phone) }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.password') }}</label>
                                        <input class="form-control" type="password" name="password">
                                        <small class="text-muted">{{ __('messages.leave_blank_if_no_change') }}</small>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Role --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.role') }} <span class="text-danger">*</span></label>
                                        <select name="role" class="form-select" id="">
                                            <option @if($user->role == 'user') selected @endif value="user">{{__('messages.user')}}</option>
                                            <option @if($user->role == 'admin') selected @endif value="admin">{{__('messages.admin')}}</option>
                                        </select>
                                        @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                {{-- Image --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.image') }}</label>
                                        <input class="form-control" type="file" name="image" accept="image/*"
                                            onchange="previewImage(event)">
                                        @if ($user->image)
                                            <div class="mt-2">
                                                <img id="preview" src="{{ asset('storage/' . $user->image) }}"
                                                    alt="Current Image" height="80">
                                            </div>
                                        @else
                                            <div class="mt-2">
                                                <img id="preview" style="display:none;" height="80">
                                            </div>
                                        @endif
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input m-0" type="checkbox" name="status" value="1"
                                            {{ old('status', $user->status) ? 'checked' : '' }}>
                                        <label class="form-check-label mx-3">{{ __('messages.active') }}</label>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="row mt-4">
                                <div class="col-12">
                                    <button
                                        class="btn btn-primary btn-sm ms-auto">{{ __('messages.update_user') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endpush
