@extends('admin.layouts.app')
@section('content')
<div class="container-fluid py-4">
  <div class="card"><div class="card-header pb-0"><h5>{{ __('messages.local_unit') }}: {{ $localUnit->name }}</h5></div>
    <div class="card-body">
      <p><strong>{{ __('messages.governorate') }}:</strong> {{ $localUnit->district->governorate->name }}</p>
      <p><strong>{{ __('messages.district') }}:</strong> {{ $localUnit->district->name }}</p>
      <p><strong>{{ __('messages.status') }}:</strong> {{ $localUnit->status ? __('messages.active') : __('messages.inactive') }}</p>
      <p><strong>{{ __('messages.sort_order') }}:</strong> {{ $localUnit->sort_order }}</p>
      <hr>
      <h6>{{ __('messages.party_units') }}</h6>
      <div class="accordion" id="localPartyAccordion">
        @forelse($localUnit->partyUnits as $partyUnit)
          <div class="accordion-item border mb-2">
            <h2 class="accordion-header" id="local-party-heading-{{ $partyUnit->id }}">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#local-party-collapse-{{ $partyUnit->id }}">{{ $partyUnit->name }}</button>
            </h2>
            <div id="local-party-collapse-{{ $partyUnit->id }}" class="accordion-collapse collapse" data-bs-parent="#localPartyAccordion">
              <div class="accordion-body">
                <p class="mb-0"><strong>{{ __('messages.status') }}:</strong> {{ $partyUnit->status ? __('messages.active') : __('messages.inactive') }}</p>
                <p class="mb-0"><strong>{{ __('messages.sort_order') }}:</strong> {{ $partyUnit->sort_order }}</p>
              </div>
            </div>
          </div>
        @empty
          <p>{{ __('messages.no_data') }}</p>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection
