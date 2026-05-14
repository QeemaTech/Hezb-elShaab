@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('messages.app_settings') }}</h5>
                    <button id="editBtn" class="btn btn-primary btn-sm">{{ __('messages.edit') }}</button>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.appSettings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- banner Image --}}
                        <div class="mb-4">
                            <label class="form-control-label">{{ __('messages.banner_image') }}</label>
                            <div id="bannerDisplay">
                                @if($banner_image)
                                    <img src="{{ asset($banner_image) }}" alt="banner" style="max-height:150px;border-radius:5px;">
                                @else
                                    <p class="text-muted">{{ __('messages.no_image_uploaded') }}</p>
                                @endif
                            </div>
                            <div id="bannerInput" style="display:none;">
                                <input type="file" class="form-control" name="banner_image" accept="image/*">
                            </div>
                        </div>

                        {{-- Show Elections --}}
                        <div class="mb-4">
                            <label class="form-control-label">{{ __('messages.show_elections') }}</label>
                            <div id="showElectionsDisplay">
                                <span class="badge bg-{{ $show_elections ? 'success' : 'secondary' }}">
                                    {{ $show_elections ? __('messages.yes') : __('messages.no') }}
                                </span>
                            </div>
                            <div id="showElectionsInput" style="display:none;">
                                <select name="show_elections" class="form-select">
                                    <option value="1" {{ $show_elections ? 'selected' : '' }}>{{ __('messages.yes') }}</option>
                                    <option value="0" {{ !$show_elections ? 'selected' : '' }}>{{ __('messages.no') }}</option>
                                </select>
                            </div>
                        </div>

                        {{-- Save Button --}}
                        <div id="saveBtnWrapper" style="display:none;">
                            <button type="submit" class="btn btn-success">{{ __('messages.save_changes') }}</button>
                            <button type="button" id="cancelBtn" class="btn btn-secondary">{{ __('messages.cancel') }}</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('editBtn').addEventListener('click', function(){
        document.getElementById('bannerDisplay').style.display = 'none';
        document.getElementById('bannerInput').style.display = 'block';
        document.getElementById('showElectionsDisplay').style.display = 'none';
        document.getElementById('showElectionsInput').style.display = 'block';
        document.getElementById('saveBtnWrapper').style.display = 'block';
        this.style.display = 'none';
    });

    document.getElementById('cancelBtn').addEventListener('click', function(){
        location.reload();
    });
</script>
@endpush
@endsection
