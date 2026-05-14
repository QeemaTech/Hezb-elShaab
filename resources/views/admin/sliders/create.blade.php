@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">{{ trans('messages.add_form_title', ['form' => trans('messages.sliders')]) }}</p>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">

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
                                    <img id="imagePreview" src="#" alt="Preview" style="max-width: 150px; display: none; border-radius: 5px;">
                                </div>
                            </div>


                        </div>



                        {{-- Submit --}}
                        <div class="row mt-4">
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm ms-auto">{{ __('messages.create_sliders') }}</button>
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
    // Image preview
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
