<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name', optional($governorate)->name) }}">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label">{{ __('messages.sort_order') }}</label>
            <input type="number" min="0" name="sort_order" class="form-control" value="{{ old('sort_order', optional($governorate)->sort_order ?? 0) }}">
        </div>
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <div class="form-check form-switch mt-3">
            <input class="form-check-input m-0" type="checkbox" name="status" value="1" {{ old('status', optional($governorate)->status ?? 1) ? 'checked' : '' }}>
            <label class="form-check-label mx-3">{{ __('messages.active') }}</label>
        </div>
    </div>
</div>
