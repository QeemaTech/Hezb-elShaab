@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">{{ trans('messages.update_form_title', ['form' => trans('messages.news')]) }}</p>
                        </div>
                    </div>
                    <div class="card-body">

                        {{-- News Details --}}
                        <p class="text-uppercase text-sm">{{ __('messages.news_information') }}</p>
                        <div class="row">
                            {{-- Title --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.title') }} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="title" value="{{ old('title', $news->title) }}">
                                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Read Minutes --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('messages.read_minutes') }}</label>
                                    <input class="form-control" type="number" name="read_minutes" min="0" value="{{ old('read_minutes', $news->read_minutes) }}">
                                    @error('read_minutes') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Image --}}
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
                                    @if($news->image)
                                        <img id="imagePreview" src="{{ asset($news->image_url) }}" alt="Preview" style="max-width: 150px; border-radius: 5px;">
                                    @else
                                        <img id="imagePreview" src="#" alt="Preview" style="max-width: 150px; display: none; border-radius: 5px;">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr class="horizontal dark">

                        {{-- Description --}}
                        <p class="text-uppercase text-sm">{{ __('messages.description') }}</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="description" name="description" rows="6">{{ old('description', $news->description) }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="horizontal dark">

                        {{-- Status --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input m-0" type="checkbox" name="status" value="1" {{ old('status', $news->status) ? 'checked' : '' }}>
                                    <label class="form-check-label mx-3">{{ __('messages.active') }}</label>
                                </div>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="row mt-4">
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm ms-auto">{{ __('messages.update_news') }}</button>
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
    // Image preview - update preview when user selects new image
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

    // Froala editor for description
    new FroalaEditor('#description', {
        heightMin: 200,
        heightMax: 600,
    });
</script>
@endpush

@endsection
