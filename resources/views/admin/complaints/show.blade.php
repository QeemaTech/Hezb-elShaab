@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="mb-4">{{ __('messages.complaint') }} #{{ $complaint->id }}</h4>

                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><strong>{{ __('messages.name') }}:</strong> {{ $complaint->name }}</li>
                        <li class="mb-2"><strong>{{ __('messages.email') }}:</strong> {{ $complaint->email ?? '-' }}</li>
                        <li class="mb-2"><strong>{{ __('messages.phone') }}:</strong> {{ $complaint->phone }}</li>
                        <li class="mb-2"><strong>{{ __('messages.source') }}:</strong> {{ $complaint->source ?? '-' }}</li>
                        <li class="mb-2"><strong>{{ __('messages.status') }}:</strong> <span class="badge bg-info">{{ __('messages.' . $complaint->status) }}</span></li>
                    </ul>

                    <div class="mb-4">
                        <h6>{{ __('messages.description') }}</h6>
                        <p class="mb-0">{{ $complaint->description }}</p>
                    </div>

                    <hr>

                    <form action="{{ route('admin.complaints.update-status', $complaint->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label class="form-control-label">{{ __('messages.change_status') }}</label>
                                <select name="status" class="form-select">
                                    <option value="new" {{ $complaint->status === 'new' ? 'selected' : '' }}>{{ __('messages.new') }}</option>
                                    <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>{{ __('messages.in_progress') }}</option>
                                    <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>{{ __('messages.resolved') }}</option>
                                    <option value="closed" {{ $complaint->status === 'closed' ? 'selected' : '' }}>{{ __('messages.closed') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-3 mt-md-0">
                                <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
                            </div>
                        </div>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('admin.complaints.index') }}" class="btn btn-secondary">{{ __('messages.back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

