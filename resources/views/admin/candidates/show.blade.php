@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">

            <div class="card shadow-sm">

                {{-- Candidate Image --}}
                @if ($candidate->image)
                    <a href="{{ asset('storage/' . $candidate->image) }}" target="_blank">
                        <img src="{{ asset('storage/' . $candidate->image) }}" alt="{{ $candidate->name }}" class="card-img-top" style="max-height: 350px; object-fit: cover;">
                    </a>
                @endif

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- Candidate Name --}}
                            <h2 class="fw-bold">{{ $candidate->name }}</h2>

                            {{-- Candidate Info --}}
                            <ul class="list-unstyled text-muted mb-3">
                                <li class="mt-4">
                                    <strong>{{ __('messages.Brief') }} : </strong>
                                    {!! $candidate->brief !!}
                                </li>

                                <li class="mt-4">
                                    <strong>{{ __('messages.Status') }} : </strong>
                                    @if ($candidate->status)
                                        <span class="badge bg-success">{{ __('messages.active') }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ __('messages.inactive') }}</span>
                                    @endif
                                </li>

                            </ul>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <h5>{{ __('messages.description') }}</h5>
                        <p>{!! $candidate->description ?? __('messages.no_description_provided') !!}</p>
                    </div>

                    {{-- Back Button --}}
                    <div class="text-end">
                        <a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary">
                            {{ __('messages.back') }}
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
