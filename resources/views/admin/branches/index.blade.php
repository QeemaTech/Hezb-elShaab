@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <p class="mb-0">{{ trans('messages.branches') }}</p>
                    <a href="{{ route('admin.branches.create') }}" class="btn btn-primary btn-sm mb-0">{{ trans('messages.create') }}</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('messages.name') }}</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('messages.phone') }}</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('messages.address') }}</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('messages.latitude') }}</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('messages.longitude') }}</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('messages.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($branches as $branch)
                                    <tr>
                                        <td class="text-sm px-3">{{ $branch->name }}</td>
                                        <td class="text-sm px-3">{{ $branch->phone }}</td>
                                        <td class="text-sm px-3">{{ $branch->address }}</td>
                                        <td class="text-sm px-3">{{ $branch->latitude }}</td>
                                        <td class="text-sm px-3">{{ $branch->longitude }}</td>
                                        <td class="text-center align-middle">
                                            <a href="{{ route('admin.branches.edit', $branch) }}" class="mx-2 text-primary font-weight-bold" data-toggle="tooltip" data-original-title="Edit branch">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a href="javascript:;" class="btn-delete text-danger mx-2" data-url="{{ route('admin.branches.destroy', $branch) }}" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">{{ __('messages.no_data') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
