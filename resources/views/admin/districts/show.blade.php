@extends('admin.layouts.app')
@section('content')
<div class="container-fluid py-4">
  <div class="card"><div class="card-header pb-0"><h5>{{ __('messages.district') }}: {{ $district->name }}</h5></div>
    <div class="card-body">
      <p><strong>{{ __('messages.governorate') }}:</strong> {{ $district->governorate->name }}</p>
      <p><strong>{{ __('messages.status') }}:</strong> {{ $district->status ? __('messages.active') : __('messages.inactive') }}</p>
      <p><strong>{{ __('messages.sort_order') }}:</strong> {{ $district->sort_order }}</p>
      <hr>
      <h6>{{ __('messages.local_units') }}</h6>
      <div class="accordion" id="districtLocalAccordion">
        @forelse($district->localUnits as $localUnit)
          <div class="accordion-item border mb-2">
            <h2 class="accordion-header" id="district-local-heading-{{ $localUnit->id }}">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#district-local-collapse-{{ $localUnit->id }}">{{ $localUnit->name }}</button>
            </h2>
            <div id="district-local-collapse-{{ $localUnit->id }}" class="accordion-collapse collapse" data-bs-parent="#districtLocalAccordion">
              <div class="accordion-body">
                <h6>{{ __('messages.party_units') }}</h6>
                <ul class="mb-0">
                  @forelse($localUnit->partyUnits as $partyUnit)
                    <li>{{ $partyUnit->name }}</li>
                  @empty
                    <li>{{ __('messages.no_data') }}</li>
                  @endforelse
                </ul>
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
