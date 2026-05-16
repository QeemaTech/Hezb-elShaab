@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between">
            <h6>{{ __('messages.system_logs') }} #{{ $systemLog->id }}</h6>
            <a href="{{ route('admin.system-logs.index') }}" class="btn btn-sm btn-secondary">{{ __('messages.back') }}</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-2"><strong>{{ __('messages.user') }}:</strong> {{ $systemLog->user?->name ?? '-' }}</div>
                <div class="col-md-6 mb-2"><strong>{{ __('messages.log_action') }}:</strong> {{ $systemLog->action }}</div>
                <div class="col-md-6 mb-2"><strong>{{ __('messages.log_category') }}:</strong> {{ $systemLog->category }}</div>
                <div class="col-md-6 mb-2"><strong>{{ __('messages.status_code') }}:</strong> {{ $systemLog->status_code }}</div>
                <div class="col-md-6 mb-2"><strong>{{ __('messages.method') }}:</strong> {{ $systemLog->method }}</div>
                <div class="col-md-6 mb-2"><strong>{{ __('messages.route') }}:</strong> {{ $systemLog->route_name }}</div>
                <div class="col-md-6 mb-2"><strong>{{ __('messages.ip_address') }}:</strong> {{ $systemLog->ip_address }}</div>
                <div class="col-md-6 mb-2"><strong>{{ __('messages.created_at') }}:</strong> {{ optional($systemLog->created_at)->format('Y-m-d H:i:s') }}</div>
                <div class="col-md-12 mb-2"><strong>{{ __('messages.url') }}:</strong> {{ $systemLog->url }}</div>
                <div class="col-md-12 mb-2"><strong>{{ __('messages.description') }}:</strong> {{ $systemLog->description }}</div>
                <div class="col-md-12 mb-2"><strong>{{ __('messages.payload') }}:</strong>
                    <pre class="bg-light p-2">{{ json_encode($systemLog->payload, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
