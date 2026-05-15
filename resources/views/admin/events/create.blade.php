@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">{{ trans('messages.add_form_title', ['form' => trans(key: 'messages.event')]) }}</p>
                        </div>
                    </div>
                    <div class="card-body">

                        {{-- Event Details --}}
                        <p class="text-uppercase text-sm">{{__('messages.event_information')}}</p>
                        <div class="row">
                            {{-- Title --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('messages.Title')}} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="title" value="{{ old('title') }}">
                                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Date --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('messages.Date')}}</label>
                                    <input class="form-control" type="datetime-local" name="date" value="{{ old('date') }}">
                                    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('messages.image')}}</label>
                                    <input class="form-control" type="file" name="image" accept="image/*" id="imageInput">
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                {{-- Preview --}}
                                <div class="mt-2">
                                    <img id="imagePreview" src="#" alt="Preview" style="max-width: 150px; display: none; border-radius: 5px;">
                                </div>
                            </div>

                            {{-- Video --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('messages.video')}}</label>
                                    <input class="form-control" type="file" name="video" accept="video/*" id="videoInput">
                                    @error('video') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                {{-- Preview --}}
                                <div class="mt-2">
                                    <video id="videoPreview" style="max-width: 300px;max-height: 300px ;display: none;" controls></video>
                                </div>
                            </div>

                        </div>

                        <hr class="horizontal dark">

                        {{-- Location --}}
                        <p class="text-uppercase text-sm">{{__('messages.location')}}</p>
                        <div class="row">
                            {{-- Address --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('messages.address')}}</label>
                                    <input class="form-control" type="text" name="address" value="{{ old('address') }}">
                                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Latitude --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('messages.latitude')}}</label>
                                    <input class="form-control" type="text" name="latitude" value="{{ old('latitude') }}">
                                    @error('latitude') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Longitude --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('messages.longitude')}}</label>
                                    <input class="form-control" type="text" name="longitude" value="{{ old('longitude') }}">
                                    @error('longitude') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="horizontal dark">

                        {{-- Description & Rules --}}
                        <p class="text-uppercase text-sm">{{__('messages.extra_information')}}</p>
                        <div class="row">
                            {{-- Description --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('messages.description')}}</label>
                                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Rules --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('messages.rules')}}</label>
                                    <textarea class="form-control" id="rules" name="rules" rows="3">{{ old('rules') }}</textarea>
                                    @error('rules') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input m-0" type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                    <label class="form-check-label mx-3">{{__('messages.active')}}</label>
                                </div>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input m-0" type="checkbox" name="chat_available" value="1" {{ old('chat_available', 1) ? 'checked' : '' }}>
                                    <label class="form-check-label mx-3">{{__('messages.chat_available')}}</label>
                                </div>
                                @error('chat_available') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input m-0" type="checkbox" name="is_private" value="1" id="is_private" {{ old('is_private', 0) ? 'checked' : '' }}>
                                    <label class="form-check-label mx-3">{{ __('messages.private_event') }}</label>
                                </div>
                                @error('is_private') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-12 d-none mt-3" id="event_users_wrapper">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.event_users') }}</label>
                                    <select name="event_users[]" id="event_users" class="select2js form-control"
                                        placeholder="{{ __('messages.select_event_users') }}"
                                        data-ajax--url="{{ route('ajax-list', ['type' => 'users']) }}"
                                        data-ajax--cache="true" multiple>
                                    </select>
                                    <small class="text-muted">{{ __('messages.search_name_or_national_id_help') }}</small>
                                </div>
                            </div>

                        </div>

                        <hr class="horizontal dark">

                        {{-- organizers --}}
                        <p class="text-uppercase text-sm">{{__('messages.organizers')}}</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('messages.organizers')}}</label>
                                    <select name="organizers[]" id="organizers" class="select2js form-control"
                                        placeholder="{{ __('messages.select_organizers') }}"
                                        data-ajax--url="{{ route('ajax-list', ['type' => 'admins']) }}"
                                        data-ajax--cache = "true" multiple>
                                    </select>
                                    <small class="text-muted">{{ __('messages.search_name_or_national_id_help') }}</small>
                                </div>
                            </div>

                        </div>

                        <hr class="horizontal dark">

                        {{-- Sponsors --}}
                        <p class="text-uppercase text-sm">{{ __('messages.sponsors') }}</p>
                        <div id="sponsors-wrapper">
                            <div class="row sponsor-item mb-3">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.name') }}</label>
                                        <input type="text" name="sponsors[0][name]" class="form-control" placeholder="{{ __('messages.sponsor_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.image') }}</label>
                                        <input type="file" name="sponsors[0][image]" class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-sponsor">&times;</button>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-success" id="add-sponsor">{{ __('messages.add_sponsor') }}</button>
                            </div>
                        </div>



                        {{-- Submit --}}
                        <div class="row mt-4">
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm ms-auto">{{__('messages.create_event')}}</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        let sponsorIndex = 1;

        document.getElementById('add-sponsor').addEventListener('click', function() {
            let wrapper = document.getElementById('sponsors-wrapper');
            let newSponsor = document.createElement('div');
            newSponsor.classList.add('row', 'sponsor-item', 'mb-3');
            newSponsor.innerHTML = `
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-control-label">{{ __('messages.name') }}</label>
                        <input type="text" name="sponsors[${sponsorIndex}][name]" class="form-control" placeholder="{{ __('messages.sponsor_name') }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-control-label">{{ __('messages.image') }}</label>
                        <input type="file" name="sponsors[${sponsorIndex}][image]" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-sponsor">&times;</button>
                </div>
            `;
            wrapper.appendChild(newSponsor);
            sponsorIndex++;
        });

        document.getElementById('sponsors-wrapper').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-sponsor')) {
                e.target.closest('.sponsor-item').remove();
            }
        });
    });
    new FroalaEditor('#description', {
        heightMin: 200,
        heightMax: 600,
    });
    new FroalaEditor('#rules', {
        heightMin: 200,
        heightMax: 600,
    });

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
    document.getElementById('videoInput').addEventListener('change', function(event) {
        let preview = document.getElementById('videoPreview');
        let file = event.target.files[0];

        if (file) {
            let url = URL.createObjectURL(file);
            preview.src = url;
            preview.style.display = 'block';
            preview.load();
        } else {
            preview.style.display = 'none';
            preview.src = '';
        }
    });
    $(document).ready(function(){
        function toggleEventUsers() {
            if ($('#is_private').is(':checked')) {
                $('#event_users_wrapper').removeClass('d-none');
            } else {
                $('#event_users_wrapper').addClass('d-none');
            }
        }

        toggleEventUsers();

        $('#is_private').on('change', toggleEventUsers);
    });
</script>
@endpush

@endsection
