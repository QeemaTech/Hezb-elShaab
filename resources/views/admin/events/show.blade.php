@extends('admin.layouts.app')


@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">

                <div class="card shadow-sm">
                    {{-- Event Banner --}}
                    @if ($event->image)
                        <a href="{{ $event->image_url }}" target="_blank">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="card-img-top"
                                style="max-height: 350px; object-fit: cover;">
                        </a>
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Title --}}
                                <h2 class="fw-bold">{{ $event->title }}</h2>

                                {{-- Basic Info --}}
                                <ul class="list-unstyled text-muted mb-3">
                                    <li class="mt-4">
                                        <strong>{{ __('messages.Date') }} : </strong>
                                        {{ \Carbon\Carbon::parse($event->date)->format('d M Y, h:i A') }}
                                    </li>


                                    <li class="mt-4">
                                        <strong>{{ __('messages.address') }} : </strong>
                                        @if ($event->latitude && $event->longitude)
                                            <a href="https://maps.google.com/?q={{ $event->latitude }},{{ $event->longitude }}"
                                                target="_blank" class="text-info">
                                                {{ $event->address }}
                                            </a>
                                        @else
                                            <span class="text-muted">{{ $event->address ?? 'No address provided' }}</span>
                                        @endif

                                    </li>
                                    <li class="mt-4">
                                        <strong>{{ __('messages.Status') }} : </strong>
                                        @if ($event->status)
                                            <span class="badge bg-success">{{ __('messages.active') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('messages.inactive') }}</span>
                                        @endif
                                    </li>
                                    <li class="mt-4">
                                        <strong>{{ __('messages.privacy_status') }} : </strong>
                                        @if ($event->is_private)
                                            <span class="badge bg-secondary">{{ __('messages.private') }}</span>
                                        @else
                                            <span class="badge bg-success">{{ __('messages.public') }}</span>
                                        @endif
                                    </li>
                                    <li class="mt-4"><strong>{{ __('messages.Created_By') }} : </strong>
                                        {{ $event->user->name ?? 'Deleted User' }}</li>
                                </ul>

                            </div>
                            <div class="col-md-6">
                                {{-- Video --}}
                                @if ($event->video)
                                    <div class="mb-4 text-end">
                                        <video controls style="max-width: 100%; height: auto;max-height: 300px">
                                            <source src="{{ asset('storage/' . $event->video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        {{-- Description --}}
                        <div class="mb-4">
                            <h5>Description</h5>
                            <div class="border p-3">
                                <p>{!! $event->description ?? 'No description provided.' !!}</p>
                            </div>
                        </div>

                        {{-- Rules --}}
                        <div class="mb-4">
                            <h5>Rules</h5>
                            <div class="border p-3">
                                <p>{!! $event->rules ?? 'No rules specified.' !!}</p>
                            </div>
                        </div>
                        <hr class="horizontal dark">

                        {{-- Users --}}
                        @if ($event->is_private)
                            <div class="mb-5">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-3">{{ __('messages.event_users') }}</h5>
                                    <button id="btnAddEventUser"
                                        class="btn btn-primary">{{ __('messages.add_event_user') }}</button>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                #
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ __('messages.name') }}
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ __('messages.email') }}
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ __('messages.phone') }}
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ __('messages.role') }}
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ __('messages.Status') }}
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ __('messages.Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($event->allowedUsers as $index => $user)
                                            <tr data-id="{{ $user->id }}">
                                                <td><span
                                                        class="text-secondary text-xs font-weight-bold">{{ $index + 1 }}<span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex px-2 py-1 justify-content-center">
                                                        <div class="mx-3">
                                                            <img src="{{ asset($user->image_url) }}"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center "><span
                                                        class="text-secondary text-xs font-weight-bold">{{ $user->email }}<span>
                                                </td>
                                                <td class="text-center "><span
                                                        class="text-secondary text-xs font-weight-bold">{{ $user->phone }}<span>
                                                </td>
                                                <td class="text-center "><span
                                                        class="text-secondary text-xs font-weight-bold">{{ __('messages.' . $user->role) }}<span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($user->status)
                                                        <span
                                                            class="badge badge-sm bg-gradient-success">{{ __('messages.active') }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-sm bg-gradient-danger">{{ __('messages.inactive') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="{{ route('admin.users.show', $user->uuid) }}"
                                                        class="mx-2 text-info font-weight-bold" data-toggle="tooltip"
                                                        data-original-title="Edit user">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn-delete text-danger mx-2"
                                                        data-url="{{ route('admin.events.remove-user', ['event' => $event->id, 'user' => $user->id]) }}"
                                                        title="Delete">
                                                        <i class="fa fa-minus"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        {{-- Organizers --}}
                        <div class="mb-5">
                            <h5 class="mb-3">{{ __('messages.organizers') }}</h5>
                            @if ($event->organizers->count())
                                <ul class="list-inline">
                                    @foreach ($event->organizers as $organizer)
                                        <li class="list-inline-item">
                                            <span class="badge bg-primary">{{ $organizer->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>{{ __('messages.no_organizers') }}</p>
                            @endif
                        </div>


                        {{-- Sponsors --}}
                        <div class="mb-5">
                            <h5 class="mb-3">{{ __('messages.sponsors') }}</h5>
                            @if ($event->sponsors->count())
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach ($event->sponsors as $sponsor)
                                        <div class="text-center" style="width: 120px;">
                                            @if ($sponsor->image)
                                                <img src="{{ asset('storage/' . $sponsor->image) }}"
                                                    alt="{{ $sponsor->name }}"
                                                    style="max-width: 100%; max-height: 80px; object-fit: contain;">
                                            @endif
                                            <p class="mt-1 mb-0">{{ $sponsor->name }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>{{ __('messages.no_sponsors') }}</p>
                            @endif
                        </div>

                        {{-- Back Button --}}
                        <div class="text-end">

                            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                                {{ __('messages.back') }}
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            // تأكد ان jQuery و SweetAlert2 و select2 محملين في الصفحة

            $('#btnAddEventUser').on('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: '{{ __('messages.add_event_user') }}',
                    html: `
                            <div class="form-group text-start">
                                <label class="form-control-label">{{ __('messages.event_users') }}</label>
                                <select name="event_users[]" id="swal_event_users" class="form-control" multiple style="width:100%"></select>
                            </div>
                        `,
                    showCancelButton: true,
                    confirmButtonText: '{{ __('messages.save') }}',
                    cancelButtonText: '{{ __('messages.cancel') }}',
                    didOpen: () => {
                        setTimeout(() => {
                            $('#swal_event_users').select2({
                                dropdownParent: $('.swal2-popup'),
                                placeholder: '{{ __('messages.select_event_users') }}',
                                ajax: {
                                    url: '{{ route('ajax-list', ['type' => 'users']) }}',
                                    dataType: 'json',
                                    delay: 250,
                                    processResults: function(data) {
                                        return {
                                            results: data.results.map(user => ({
                                                id: user.id,
                                                text: user.text
                                            }))
                                        };
                                    },
                                    cache: true
                                }
                            });
                        }, 100);

                    },
                    preConfirm: () => {
                        const selectedUsers = $('#swal_event_users').val();
                        if (!selectedUsers || selectedUsers.length === 0) {
                            Swal.showValidationMessage(
                                '{{ __('messages.please_select_at_least_one_user') }}');
                            return false;
                        }
                        return selectedUsers;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const selectedUsers = result.value;

                        $.ajax({
                            url: '{{ route('admin.events.add-users', ['event' => $event->id ?? 0]) }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                users: selectedUsers
                            },
                            success: function(response) {
                                Swal.fire('{{ __('messages.success') }}', '{{ __('messages.users_added_successfully') }}', 'success');
                            },
                            error: function() {
                                Swal.fire('{{ __('messages.error') }}', '{{ __('messages.failed_to_add_users') }}', 'error');
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
