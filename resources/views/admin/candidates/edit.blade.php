@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">{{ trans('messages.edit_form_title', ['form' => trans('messages.candidates')]) }}</p>
                        </div>
                    </div>
                    <div class="card-body">

                        {{-- Candidates Information --}}
                        <p class="text-uppercase text-sm">{{ __('messages.candidates_information') }}</p>
                        <div class="row">
                            {{-- Name --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name', $candidate->name) }}">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Brief --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.brief') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="brief" name="brief" rows="6">{{ old('brief', $candidate->brief) }}</textarea>
                                    @error('brief') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Image Upload --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.image') }}</label>
                                    <input class="form-control" type="file" name="image" accept="image/*" id="imageInput">
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Preview --}}
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <img id="imagePreview"
                                         src="{{ $candidate->image ? asset('storage/' . $candidate->image) : '#' }}"
                                         alt="Preview"
                                         style="max-width: 150px; {{ $candidate->image ? '' : 'display: none;' }} border-radius: 5px;">
                                </div>
                            </div>
                        </div>

                        <hr class="horizontal dark">

                        {{-- Description --}}
                        <p class="text-uppercase text-sm">{{ __('messages.description') }}</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="description" name="description" rows="6">{{ old('description', $candidate->description) }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="horizontal dark">

                        {{-- Status --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input m-0" type="checkbox" name="status" value="1" {{ old('status', $candidate->status) ? 'checked' : '' }}>
                                    <label class="form-check-label mx-3">{{ __('messages.active') }}</label>
                                </div>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="row mt-4">
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm ms-auto">{{ __('messages.update_candidates') }}</button>
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
    // Image preview on change
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
            preview.style.display = '{{ $candidate->image ? 'block' : 'none' }}';
        }
    });

    // Froala editors
    new FroalaEditor('#description', { heightMin: 200, heightMax: 600 });
    new FroalaEditor('#brief');
</script>
@endpush

@endsection
