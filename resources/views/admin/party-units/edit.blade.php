@extends('admin.layouts.app')
@section('content')
<div class="container-fluid py-4"><div class="card"><div class="card-header pb-0"><h6>{{ __('messages.update') }} {{ __('messages.party_unit') }}</h6></div><div class="card-body"><form method="POST" action="{{ route('admin.party-units.update',$partyUnit) }}">@csrf @method('PUT') @include('admin.party-units.partials.form',['partyUnit'=>$partyUnit])<button class="btn btn-primary btn-sm">{{ __('messages.update') }}</button></form></div></div></div>
@endsection
@push('scripts')
<script>
(function(){
 const governorate=document.getElementById('governorate_id');
 const district=document.getElementById('district_id');
 const localUnit=document.getElementById('local_unit_id');
 governorate?.addEventListener('change', async function(){
   district.innerHTML = `<option value="">{{ __('messages.select_district') }}</option>`;
   localUnit.innerHTML = `<option value="">{{ __('messages.select_local_unit') }}</option>`;
   if(!this.value) return;
   const res=await fetch(`{{ route('admin.ajax.districts') }}?governorate_id=${this.value}`);
   const data=await res.json();
   (data.results||[]).forEach(item=>district.insertAdjacentHTML('beforeend',`<option value="${item.id}">${item.name}</option>`));
 });
 district?.addEventListener('change', async function(){
   localUnit.innerHTML = `<option value="">{{ __('messages.select_local_unit') }}</option>`;
   if(!this.value) return;
   const res=await fetch(`{{ route('admin.ajax.local-units') }}?district_id=${this.value}`);
   const data=await res.json();
   (data.results||[]).forEach(item=>localUnit.insertAdjacentHTML('beforeend',`<option value="${item.id}">${item.name}</option>`));
 });
})();
</script>
@endpush
