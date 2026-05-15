@extends('admin.layouts.app')
@section('content')
<div class="container-fluid py-4"><div class="card"><div class="card-header pb-0"><h6>{{ __('messages.create') }} {{ __('messages.governorate') }}</h6></div><div class="card-body"><form method="POST" action="{{ route('admin.governorates.store') }}">@csrf @include('admin.governorates.partials.form',['governorate'=>null]) <button class="btn btn-primary btn-sm">{{ __('messages.create') }}</button></form></div></div></div>
@endsection
