@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('messages.about_us') }}</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.aboutUs.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-control-label">{{ __('messages.vision_text') }}</label>
                            <textarea class="form-control" name="vision_text" rows="5">{{ old('vision_text', $visionText) }}</textarea>
                            @error('vision_text') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-control-label">{{ __('messages.contact_email') }}</label>
                                <input class="form-control" type="email" name="contact_email" value="{{ old('contact_email', $contactEmail) }}">
                                @error('contact_email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-control-label">{{ __('messages.membership_form_url') }}</label>
                                <input class="form-control" type="url" name="membership_form_url" value="{{ old('membership_form_url', $membershipFormUrl) }}">
                                @error('membership_form_url') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <hr class="horizontal dark">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">{{ __('messages.faqs') }}</h6>
                            <button type="button" id="addFaqBtn" class="btn btn-sm btn-primary">{{ __('messages.add_faq') }}</button>
                        </div>

                        <div id="faqsContainer">
                            @php
                                $oldFaqs = old('faqs');
                                $faqItems = is_array($oldFaqs) ? $oldFaqs : $faqs;
                            @endphp

                            @forelse($faqItems as $index => $faq)
                                <div class="faq-item border rounded p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-5 mb-2">
                                            <label class="form-control-label">{{ __('messages.question') }}</label>
                                            <input class="form-control" type="text" name="faqs[{{ $index }}][question]" value="{{ $faq['question'] ?? '' }}">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-control-label">{{ __('messages.answer') }}</label>
                                            <textarea class="form-control" name="faqs[{{ $index }}][answer]" rows="2">{{ $faq['answer'] ?? '' }}</textarea>
                                        </div>
                                        <div class="col-md-1 d-flex align-items-end mb-2">
                                            <button type="button" class="btn btn-sm btn-danger remove-faq-btn">X</button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="faq-item border rounded p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-5 mb-2">
                                            <label class="form-control-label">{{ __('messages.question') }}</label>
                                            <input class="form-control" type="text" name="faqs[0][question]">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-control-label">{{ __('messages.answer') }}</label>
                                            <textarea class="form-control" name="faqs[0][answer]" rows="2"></textarea>
                                        </div>
                                        <div class="col-md-1 d-flex align-items-end mb-2">
                                            <button type="button" class="btn btn-sm btn-danger remove-faq-btn">X</button>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        @error('faqs') <span class="text-danger">{{ $message }}</span> @enderror
                        @error('faqs.*.question') <span class="text-danger d-block">{{ $message }}</span> @enderror
                        @error('faqs.*.answer') <span class="text-danger d-block">{{ $message }}</span> @enderror

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">{{ __('messages.save_changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    (function() {
        const faqsContainer = document.getElementById('faqsContainer');
        const addFaqBtn = document.getElementById('addFaqBtn');

        function nextFaqIndex() {
            return faqsContainer.querySelectorAll('.faq-item').length;
        }

        function faqTemplate(index) {
            return `
                <div class="faq-item border rounded p-3 mb-3">
                    <div class="row">
                        <div class="col-md-5 mb-2">
                            <label class="form-control-label">{{ __('messages.question') }}</label>
                            <input class="form-control" type="text" name="faqs[${index}][question]">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-control-label">{{ __('messages.answer') }}</label>
                            <textarea class="form-control" name="faqs[${index}][answer]" rows="2"></textarea>
                        </div>
                        <div class="col-md-1 d-flex align-items-end mb-2">
                            <button type="button" class="btn btn-sm btn-danger remove-faq-btn">X</button>
                        </div>
                    </div>
                </div>
            `;
        }

        addFaqBtn.addEventListener('click', function() {
            const index = nextFaqIndex();
            faqsContainer.insertAdjacentHTML('beforeend', faqTemplate(index));
        });

        document.addEventListener('click', function(event) {
            if (!event.target.classList.contains('remove-faq-btn')) {
                return;
            }

            const item = event.target.closest('.faq-item');
            if (item) {
                item.remove();
            }
        });
    })();
</script>
@endpush
@endsection

