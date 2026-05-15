@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.branches.store') }}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">{{ trans('messages.add_form_title', ['form' => trans('messages.branch')]) }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.branches.partials.form', ['branch' => null])

                        <div class="row mt-4">
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm ms-auto">{{ __('messages.create_branch') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
