@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">
                                    {{ trans('messages.update_form_title', ['form' => trans('messages.event')]) }}</p>
                            </div>
                        </div>
                        <div class="card-body">

                            {{-- Event Details --}}
                            <p class="text-uppercase text-sm">{{ __('messages.event_information') }}</p>
                            <div class="row">
                                {{-- Title --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.Title') }} <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="title"
                                            value="{{ old('title', $event->title) }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Date --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.Date') }}</label>
                                        <input class="form-control" type="datetime-local" name="date"
                                            value="{{ old('date', $event->date ? $event->date->format('Y-m-d\TH:i') : '') }}">
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Image --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.image') }}</label>
                                        <input class="form-control" type="file" name="image" accept="image/*" id="imageInput" onchange="previewImage(event)">
                                        @if ($event->image)
                                            <div class="mt-2">
                                                <img src="{{ $event->image_url }}" alt="Current Image" id="preview" height="80">
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

                                {{-- Video --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.video') }}</label>
                                        <input class="form-control" type="file" name="video" accept="video/*" onchange="previewVideo(event)">
                                        @if ($event->video)
                                            <div class="mt-2">
                                                <video width="160" controls id="videoPreview" >
                                                    <source src="{{ asset('storage/' . $event->video) }}"  type="video/mp4">
                                                </video>
                                            </div>
                                            @else
                                            <div class="mt-2">
                                                <video width="160" controls id="videoPreview">
                                                    <source src="" style="display: none" type="video/mp4">
                                                </video>
                                            </div>

                                        @endif
                                        @error('video')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="horizontal dark">

                            {{-- Location --}}
                            <p class="text-uppercase text-sm">{{ __('messages.location') }}</p>
                            <div class="row">
                                {{-- Address --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.address') }}</label>
                                        <input class="form-control" type="text" name="address"
                                            value="{{ old('address', $event->address) }}">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Latitude --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.latitude') }}</label>
                                        <input class="form-control" type="text" name="latitude"
                                            value="{{ old('latitude', $event->latitude) }}">
                                        @error('latitude')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Longitude --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.longitude') }}</label>
                                        <input class="form-control" type="text" name="longitude"
                                            value="{{ old('longitude', $event->longitude) }}">
                                        @error('longitude')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="horizontal dark">

                            {{-- Description & Rules --}}
                            <p class="text-uppercase text-sm">{{ __('messages.extra_information') }}</p>
                            <div class="row">
                                {{-- Description --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.description') }}</label>
                                        <textarea class="form-control" name="description" id="description" rows="4">{{ old('description', $event->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Rules --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.rules') }}</label>
                                        <textarea class="form-control" id="rules" name="rules" rows="3">{{ old('rules', $event->rules) }}</textarea>
                                        @error('rules')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input m-0" type="checkbox" name="status"
                                            value="1" {{ old('status', $event->status) ? 'checked' : '' }}>
                                        <label class="form-check-label mx-3">{{ __('messages.active') }}</label>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input m-0" type="checkbox" name="chat_available"
                                            value="1" {{ old('chat_available', $event->chat_available) ? 'checked' : '' }}>
                                        <label class="form-check-label mx-3">{{ __('messages.chat_available') }}</label>
                                    </div>
                                    @error('chat_available')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <hr class="horizontal dark">

                            {{-- organizers --}}
                            <p class="text-uppercase text-sm">{{ __('messages.organizers') }}</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('messages.organizers') }}</label>
                                        <select name="organizers[]" id="organizers" class="select2js form-control"
                                            placeholder="{{ __('messages.select_organizers') }}"
                                            data-ajax--url="{{ route('ajax-list', ['type' => 'admins']) }}"
                                            data-ajax--cache = "true" multiple>
                                            @if ($event->organizers)
                                                @foreach ($event->organizers as $organizer)
                                                    <option value="{{ $organizer->id }}" selected>{{ $organizer->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-muted">{{ __('messages.search_name_or_national_id_help') }}</small>
                                    </div>
                                </div>

                            </div>
                            {{-- Sponsors --}}
                            <p class="text-uppercase text-sm">{{ __('messages.sponsors') }}</p>
                            <div id="sponsors-wrapper">
                                @foreach ($event->sponsors as $index => $sponsor)
                                    <div class="row sponsor-item mb-3">
                                        <input type="hidden" name="sponsors[{{ $index }}][id]"
                                            value="{{ $sponsor->id }}">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-control-label">{{ __('messages.name') }}</label>
                                                <input type="text" name="sponsors[{{ $index }}][name]"
                                                    class="form-control" value="{{ $sponsor->name }}"
                                                    placeholder="{{ __('messages.sponsor_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-control-label">{{ __('messages.image') }}</label>
                                                <input type="file" name="sponsors[{{ $index }}][image]"
                                                    class="form-control" accept="image/*">
                                                @if ($sponsor->image)
                                                    <img src="{{ asset('storage/' . $sponsor->image) }}"
                                                        alt="Sponsor Image" class="mt-2" style="max-height: 50px;">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-start pt-4">
                                            <button type="button" class="btn btn-danger remove-sponsor">&times;</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="add-sponsor"
                                class="btn btn-primary btn-sm mt-2">{{ __('messages.add_sponsor') }}</button>


                            {{-- Submit --}}
                            <div class="row mt-4">
                                <div class="col-12">
                                    <button
                                        class="btn btn-primary btn-sm ms-auto">{{ __('messages.update_event') }}</button>
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
                let sponsorIndex = {{ $event->sponsors->count() }};

                document.getElementById('add-sponsor').addEventListener('click', function() {
                    let wrapper = document.getElementById('sponsors-wrapper');
                    let newSponsor = document.createElement('div');
                    newSponsor.classList.add('row', 'sponsor-item', 'mb-3');
                    newSponsor.innerHTML = `
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-control-label">{{ __('messages.name') }}</label>
                                <input type="text" name="sponsors[\${sponsorIndex}][name]" class="form-control" placeholder="{{ __('messages.sponsor_name') }}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-control-label">{{ __('messages.image') }}</label>
                                <input type="file" name="sponsors[\${sponsorIndex}][image]" class="form-control" accept="image/*">
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
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('preview');
                    output.src = reader.result;
                    output.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            }
            function previewVideo(event) {
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
            }
        </script>
    @endpush
@endsection
