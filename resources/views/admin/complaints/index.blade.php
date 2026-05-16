@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h6>{{ __('messages.complaints') }}</h6>
                        <div class="d-flex gap-2">
                            @hasrole('super admin')
                                <a href="{{ route('admin.exports.complaints', array_merge(request()->query(), ['format' => 'xlsx'])) }}" class="btn btn-sm btn-outline-success">
                                    Export Excel
                                </a>
                                <a href="{{ route('admin.exports.complaints', array_merge(request()->query(), ['format' => 'csv'])) }}" class="btn btn-sm btn-outline-secondary">
                                    Export CSV
                                </a>
                            @endhasrole
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">#</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ __('messages.name') }}</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ __('messages.email') }}</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ __('messages.phone') }}</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ __('messages.status') }}</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ __('messages.Date') }}</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ __('messages.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaints as $index => $complaint)
                                    <tr>
                                        <td><span class="text-secondary text-xs font-weight-bold">{{ $index + 1 }}</span></td>
                                        <td class="text-center"><span class="text-secondary text-xs font-weight-bold">{{ $complaint->name }}</span></td>
                                        <td class="text-center"><span class="text-secondary text-xs font-weight-bold">{{ $complaint->email ?? '-' }}</span></td>
                                        <td class="text-center"><span class="text-secondary text-xs font-weight-bold">{{ $complaint->phone }}</span></td>
                                        <td class="text-center"><span class="badge badge-sm bg-gradient-info">{{ __('messages.' . $complaint->status) }}</span></td>
                                        <td class="text-center"><span class="text-secondary text-xs font-weight-bold">{{ $complaint->created_at }}</span></td>
                                        <td class="text-center align-middle">
                                            <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="mx-2 text-info">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
