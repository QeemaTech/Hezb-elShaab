@extends('admin.layouts.app')
@section('content')
<div class="container-fluid py-4">
  <div class="card mb-4">
    <div class="card-header pb-0 d-flex justify-content-between">
      <h6>{{ __('messages.governorates') }}</h6>
      <a href="{{ route('admin.governorates.create') }}" class="btn btn-sm btn-primary">{{ __('messages.create') }}</a>
    </div>
    <div class="card-body">
      <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4"><input class="form-control" name="name" value="{{ request('name') }}" placeholder="{{ __('messages.name') }}"></div>
        <div class="col-md-3">
          <select name="status" class="form-select">
            <option value="">{{ __('messages.status') }}</option>
            <option value="1" @selected(request('status')==='1')>{{ __('messages.active') }}</option>
            <option value="0" @selected(request('status')==='0')>{{ __('messages.inactive') }}</option>
          </select>
        </div>
        <div class="col-md-5"><button class="btn btn-primary btn-sm">{{ __('messages.search') }}</button></div>
      </form>
      <div class="table-responsive">
        <table class="table align-items-center mb-0">
          <thead><tr><th>{{ __('messages.name') }}</th><th>{{ __('messages.sort_order') }}</th><th>{{ __('messages.status') }}</th><th>{{ __('messages.Actions') }}</th></tr></thead>
          <tbody>
            @forelse($governorates as $governorate)
              <tr>
                <td>{{ $governorate->name }}</td><td>{{ $governorate->sort_order }}</td>
                <td>{!! $governorate->status ? '<span class="badge bg-success">'.__('messages.active').'</span>' : '<span class="badge bg-secondary">'.__('messages.inactive').'</span>' !!}</td>
                <td>
                  <a href="{{ route('admin.governorates.show',$governorate) }}" class="mx-2 text-info"><i class="fa fa-eye"></i></a>
                  <a href="{{ route('admin.governorates.edit',$governorate) }}" class="mx-2 text-primary"><i class="fa fa-pen"></i></a>
                  <a href="javascript:;" class="btn-delete text-danger mx-2" data-url="{{ route('admin.governorates.destroy',$governorate) }}"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            @empty
              <tr><td colspan="4" class="text-center">{{ __('messages.no_data') }}</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-3">{{ $governorates->links() }}</div>
    </div>
  </div>
</div>
@endsection
