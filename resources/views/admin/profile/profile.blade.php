@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('profile.post', auth()->user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                   
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="mb-0">{{ __('messages.update_profile') }}</h5>
                        </div>
                        <div class="card-body">

                            {{-- Name --}}
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('messages.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name"
                                    value="{{ old('name', auth()->user()->name) }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('messages.email') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email"
                                    value="{{ old('email', auth()->user()->email) }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('messages.phone') }}</label>
                                <input class="form-control" type="text" name="phone"
                                    value="{{ old('phone', auth()->user()->phone) }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Old Password --}}
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('messages.old_password') }}</label>
                                <input class="form-control" type="password" name="old_password"
                                    placeholder="{{ __('messages.enter_old_password_if_changing') }}">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- New Password --}}
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('messages.new_password') }}</label>
                                <input class="form-control" type="password" name="password"
                                    placeholder="{{ __('messages.enter_new_password') }}">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Confirm New Password --}}
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('messages.confirm_password') }}</label>
                                <input class="form-control" type="password" name="password_confirmation"
                                    placeholder="{{ __('messages.retype_new_password') }}">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Profile Image --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-control-label">{{ __('messages.image') }}</label>
                                    <input class="form-control" type="file" name="image" accept="image/*"
                                        id="imageInput">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    @if (auth()->user()->image)
                                        <img id="imagePreview" src="{{ asset(auth()->user()->image) }}" alt="Preview"
                                            style="max-width: 150px; border-radius: 5px;">
                                    @else
                                        <img id="imagePreview" src="#" alt="Preview"
                                            style="max-width: 150px; display: none; border-radius: 5px;">
                                    @endif
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="text-end">
                                <button class="btn btn-primary">{{ __('messages.update_profile') }}</button>
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
                }
            });
            $(document).ready(function() {
                let $oldPass = $('input[name="old_password"]');
                let $newPass = $('input[name="password"]');
                let $confirmPass = $('input[name="password_confirmation"]');

                function toggleRequired() {
                    if ($oldPass.val().length > 0) {
                        $newPass.attr('required', true);
                        $confirmPass.attr('required', true);
                    } else {
                        $newPass.removeAttr('required');
                        $confirmPass.removeAttr('required');
                    }
                }

                function validateMatch() {
                    if ($confirmPass.val().length > 0) {
                        if ($newPass.val() !== $confirmPass.val()) {
                            $confirmPass[0].setCustomValidity("Passwords do not match");
                        } else {
                            $confirmPass[0].setCustomValidity("");
                        }
                    } else {
                        $confirmPass[0].setCustomValidity("");
                    }
                }

                // Listen for typing in all three fields
                $oldPass.on('input', function() {
                    toggleRequired();
                });

                $newPass.on('input', function() {
                    toggleRequired();
                    validateMatch();
                });

                $confirmPass.on('input', function() {
                    validateMatch();
                });
            });
        </script>
    @endpush
@endsection
