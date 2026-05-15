@extends('admin.layouts.app')
@section('content')
<div class="container-fluid py-4"><div class="card"><div class="card-header pb-0"><h6>{{ __('messages.create') }} {{ __('messages.district') }}</h6></div><div class="card-body"><form method="POST" action="{{ route('admin.districts.store') }}">@csrf @include('admin.districts.partials.form',['district'=>null])<button class="btn btn-primary btn-sm">{{ __('messages.create') }}</button></form></div></div></div>
@endsection
