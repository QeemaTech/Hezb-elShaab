@extends('admin.layouts.app')
@section('content')
<div class="container-fluid py-4"><div class="card"><div class="card-header pb-0"><h6>{{ __('messages.update') }} {{ __('messages.district') }}</h6></div><div class="card-body"><form method="POST" action="{{ route('admin.districts.update',$district) }}">@csrf @method('PUT') @include('admin.districts.partials.form',['district'=>$district])<button class="btn btn-primary btn-sm">{{ __('messages.update') }}</button></form></div></div></div>
@endsection
