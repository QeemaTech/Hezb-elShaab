@extends('admin.layouts.app')
@section('content')
<div class="container-fluid py-4"><div class="card"><div class="card-header pb-0"><h6>{{ __('messages.update') }} {{ __('messages.governorate') }}</h6></div><div class="card-body"><form method="POST" action="{{ route('admin.governorates.update',$governorate) }}">@csrf @method('PUT') @include('admin.governorates.partials.form',['governorate'=>$governorate]) <button class="btn btn-primary btn-sm">{{ __('messages.update') }}</button></form></div></div></div>
@endsection
