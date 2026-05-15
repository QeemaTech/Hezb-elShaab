@extends('admin.layouts.app')
@section('content')
<div class="container-fluid py-4">
  <div class="card"><div class="card-header pb-0"><h5>{{ __('messages.party_unit') }}: {{ $partyUnit->name }}</h5></div>
    <div class="card-body">
      <p><strong>{{ __('messages.governorate') }}:</strong> {{ $partyUnit->localUnit->district->governorate->name }}</p>
      <p><strong>{{ __('messages.district') }}:</strong> {{ $partyUnit->localUnit->district->name }}</p>
      <p><strong>{{ __('messages.local_unit') }}:</strong> {{ $partyUnit->localUnit->name }}</p>
      <p><strong>{{ __('messages.status') }}:</strong> {{ $partyUnit->status ? __('messages.active') : __('messages.inactive') }}</p>
      <p><strong>{{ __('messages.sort_order') }}:</strong> {{ $partyUnit->sort_order }}</p>
    </div>
  </div>
</div>
@endsection
