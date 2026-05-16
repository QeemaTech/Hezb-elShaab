@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">

            <div class="card shadow-sm">

                {{-- User Image --}}
                @if ($user->image)
                    <a href="{{ $user->image_url }}" target="_blank">
                        <img src="{{ $user->image_url }}" alt="{{ $user->name }}" class="card-img-top" style="max-height: 300px; object-fit: cover;">
                    </a>
                @endif

                <div class="card-body">
                    <div class="row">

                        {{-- Name --}}
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">{{ __('messages.name') }}</h5>
                            <p class="text-muted">{{ $user->name }}</p>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">{{ __('messages.email') }}</h5>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>

                        {{-- Phone --}}
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">{{ __('messages.phone') }}</h5>
                            <p class="text-muted">{{ $user->phone ?? __('messages.not_provided') }}</p>
                        </div>
                        {{-- National ID --}}
                        @if($user->national_id)
                            <div class="col-md-6 mb-3">
                                <h5 class="fw-bold">{{ __('messages.national_id') }}</h5>
                                <p class="text-muted">{{ $user->national_id ?? __('messages.national_id') }}</p>
                            </div>
                        @endif
                        @if ($user->member)

                            {{-- National ID --}}
                            <div class="col-md-6 mb-3">
                                <h5 class="fw-bold">{{ __('messages.national_id') }}</h5>
                                <p class="text-muted">{{ $user->member->national_id ?? __('messages.national_id') }}</p>
                            </div>

                            {{-- Membership number --}}
                            <div class="col-md-6 mb-3">
                                <h5 class="fw-bold">{{ __('messages.membership_number') }}</h5>
                                <p class="text-muted">{{ $user->member->membership_number ?? __('messages.not_provided') }}</p>
                            </div>

                        {{-- BD --}}
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">{{ __('messages.birth_date') }}</h5>
                            <p class="text-muted">{{ $user->birth_date?->format('Y-m-d') ?? __('messages.not_provided') }}</p>
                        </div>

                        {{-- Governorate --}}
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">{{ __('messages.governorate') }}</h5>
                            <p class="text-muted">{{ $user->governorate?->name ?? __('messages.not_provided') }}</p>
                        </div>

                        {{-- Member Status --}}
                        <div class="col-md-6 mb-3">
                                <h5 class="fw-bold">{{ __('messages.member_status') }}</h5>
                                <p class="text-muted">
                                    @if ($user->member_status == 'active')
                                        <span class="badge bg-success">{{ __('messages.active') }}</span>
                                    @elseif ($user->member_status == 'rejected')
                                        <span class="badge bg-danger">{{ __('messages.rejected') }}</span>

                                    @else
                                        <span class="badge bg-warning">{{ __('messages.pending') }}</span>
                                    @endif
                                </p>
                            </div>

                            @if ($user->member_reviewed_by && $user->memberReviewedBy)
                                <div class="col-md-6 mb-3">
                                    <h5 class="fw-bold">{{ __('messages.reviewed_by') }}</h5>
                                    <p class="text-muted">{{ $user->memberReviewedBy->name }}</p>
                                </div>
                            @endif

                        @endif

                        {{-- Role --}}
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">{{ __('messages.role') }}</h5>
                            <p class="text-muted">{{ ucfirst($user->role) }}</p>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">{{ __('messages.status') }}</h5>
                            @if ($user->status)
                                <span class="badge bg-success">{{ __('messages.active') }}</span>
                            @else
                                <span class="badge bg-secondary">{{ __('messages.inactive') }}</span>
                            @endif
                        </div>

                        {{-- Created By (optional if you store it) --}}
                        @if ($user->created_by)
                            <div class="col-md-6 mb-3">
                                <h5 class="fw-bold">{{ __('messages.created_by') }}</h5>
                                <p class="text-muted">{{ $user->creator->name ?? __('messages.deleted_user') }}</p>
                            </div>
                        @endif

                        {{-- Created At --}}
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">{{ __('messages.created_at') }}</h5>
                            <p class="text-muted">{{ $user->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                    @if ($user->member && ($user->member_status ?? 'pending') === 'pending')
                        @can('Users Member Action')
                            <div class="d-flex gap-3">
                                {{-- Accept Button --}}
                                <div class="text-end mt-4">
                                    <button class="btn btn-success action-btn" data-action="accept" data-id="{{ $user->id }}">
                                        {{ __('messages.accept_request') }}
                                    </button>
                                </div>
                                {{-- Reject Button --}}
                                <div class="text-end mt-4">
                                    <button class="btn btn-danger action-btn" data-action="reject" data-id="{{ $user->id }}">
                                        {{ __('messages.reject_request') }}
                                    </button>
                                </div>
                            </div>
                        @endcan
                    @endif

                    {{-- Back Button --}}
                    <div class="text-end mt-4">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            {{ __('messages.back') }}
                            <i class="fas fa-arrow-left ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@push('scripts')
  <script>
    $(document).on('click', '.btn-success', function () {
        let userId = "{{ $user->id }}"; // أو ممكن تاخدها من data-id في الزر
        Swal.fire({
            title: 'تأكيد القبول',
            text: "هل أنت متأكد من قبول هذا الطلب؟",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، اقبل',
            confirmButtonColor: '#2dce89',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/users/' + userId + '/accept', // عدل المسار حسب الروت عندك
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        Swal.fire('تم!', 'تم قبول الطلب بنجاح.', 'success');
                        // تحديث الصفحة أو إزالة العنصر
                        location.reload();
                    },
                    error: function () {
                        Swal.fire('خطأ!', 'حدث خطأ أثناء العملية.', 'error');
                    }
                });
            }
        });
    });

    $(document).on('click', '.btn-danger', function () {
        let userId = "{{ $user->id }}";
        Swal.fire({
            title: 'تأكيد الرفض',
            text: "هل أنت متأكد من رفض هذا الطلب؟",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، ارفض',
            confirmButtonColor: '#f5365c',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/users/' + userId + '/reject',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        Swal.fire('تم!', 'تم رفض الطلب بنجاح.', 'success');
                        location.reload();
                    },
                    error: function () {
                        Swal.fire('خطأ!', 'حدث خطأ أثناء العملية.', 'error');
                    }
                });
            }
        });
    });
</script>

@endpush
@endsection
