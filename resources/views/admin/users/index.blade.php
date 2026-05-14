@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h6>{{__('messages.users')}}</h6>
                            @canany(['Users Create', 'Users'])
                            <a href="{{ route('admin.users.create') }}" class="float-end me-1 btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle fa-lg"></i>
                                {{ trans('messages.add_form_title', ['form' => trans(key: 'messages.user')]) }}
                            </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            #
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.name')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.email')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.phone')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.user_type')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.role')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Status')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Actions')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr data-id="{{$user->id}}">
                                            <td><span class="text-secondary text-xs font-weight-bold">{{$index+1}}<span></td>
                                            <td class="text-center">
                                                <div class="d-flex px-2 py-1 justify-content-center">
                                                    <div class="mx-3">
                                                        <img src="{{asset($user->image_url)}}" class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$user->name}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center "><span class="text-secondary text-xs font-weight-bold">{{$user->email}}<span></td>
                                            <td class="text-center "><span class="text-secondary text-xs font-weight-bold">{{$user->phone}}<span></td>
                                            <td class="text-center "><span class="text-secondary text-xs font-weight-bold">{{__('messages.'.$user->role)}}<span></td>
                                            <td class="text-center ">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    @if(count($user->roles) > 0)
                                                    {{$user->roles[0]->name}}
                                                    @else
                                                    --
                                                    @endif
                                                <span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($user->status)
                                                <span class="badge badge-sm bg-gradient-success">{{__('messages.active')}}</span>

                                                @else
                                                <span class="badge badge-sm bg-gradient-danger">{{__('messages.inactive')}}</span>

                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="{{route('admin.users.show',$user->uuid)}}" class="mx-2 text-info font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @canany(['Users Update', 'Users'])
                                                    <a href="{{route('admin.users.edit',$user->uuid)}}" class="mx-2 text-primary font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                                                        <i class="fa fa-pen"></i>
                                                    </a>
                                                @endcan
                                                @canany(['Users Delete', 'Users'])
                                                    <a href="javascript:;" class="btn-delete text-danger mx-2" data-url="{{ route('admin.users.destroy', $user->uuid) }}" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
