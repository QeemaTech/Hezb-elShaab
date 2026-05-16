@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6>{{ __('messages.system_logs') }}</h6>
            <div class="d-flex gap-2">
                <form method="POST" action="{{ route('admin.system-logs.destroy-all') }}" onsubmit="return confirm('{{ __('messages.delete_all_logs_confirm') }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">{{ __('messages.delete_all') }}</button>
                </form>
            </div>
        </div>

        <div class="card-body">
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-2"><input class="form-control" name="q" value="{{ request('q') }}" placeholder="{{ __('messages.search') }}"></div>
                <div class="col-md-2"><input class="form-control" name="category" value="{{ request('category') }}" placeholder="{{ __('messages.log_category') }}"></div>
                <div class="col-md-2"><input class="form-control" name="action" value="{{ request('action') }}" placeholder="{{ __('messages.log_action') }}"></div>
                <div class="col-md-2"><input class="form-control" name="status_code" value="{{ request('status_code') }}" placeholder="{{ __('messages.status_code') }}"></div>
                <div class="col-md-2"><input type="date" class="form-control" name="date_from" value="{{ request('date_from') }}"></div>
                <div class="col-md-2"><input type="date" class="form-control" name="date_to" value="{{ request('date_to') }}"></div>
                <div class="col-md-12 d-flex gap-2">
                    <button class="btn btn-primary btn-sm">{{ __('messages.search') }}</button>
                    <a href="{{ route('admin.system-logs.index') }}" class="btn btn-outline-secondary btn-sm">{{ __('messages.cancel') }}</a>
                </div>
            </form>

            <form method="POST" action="{{ route('admin.system-logs.destroy-range') }}" class="row g-2 mb-3" onsubmit="return confirm('{{ __('messages.delete_logs_range_confirm') }}')">
                @csrf
                @method('DELETE')
                <div class="col-md-3"><input required type="date" class="form-control" name="date_from"></div>
                <div class="col-md-3"><input required type="date" class="form-control" name="date_to"></div>
                <div class="col-md-3">
                    <button class="btn btn-warning btn-sm">{{ __('messages.delete_by_date_range') }}</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('messages.user') }}</th>
                            <th>{{ __('messages.log_action') }}</th>
                            <th>{{ __('messages.log_category') }}</th>
                            <th>{{ __('messages.method') }}</th>
                            <th>{{ __('messages.status') }}</th>
                            <th>{{ __('messages.route') }}</th>
                            <th>{{ __('messages.created_at') }}</th>
                            <th>{{ __('messages.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->user?->name ?? '-' }}</td>
                                <td>{{ $log->action ?? '-' }}</td>
                                <td>{{ $log->category ?? '-' }}</td>
                                <td>{{ $log->method }}</td>
                                <td>{{ $log->status_code ?? '-' }}</td>
                                <td>{{ $log->route_name ?? '-' }}</td>
                                <td>{{ optional($log->created_at)->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('admin.system-logs.show', $log->id) }}" class="text-info"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center">{{ __('messages.no_data') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">{{ $logs->links() }}</div>
        </div>
    </div>
</div>
@endsection
