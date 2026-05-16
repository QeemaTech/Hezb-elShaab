@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h6>{{__('messages.candidates')}}</h6>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.exports.candidates', array_merge(request()->query(), ['format' => 'xlsx'])) }}" class="btn btn-sm btn-outline-success">
                                    Export Excel
                                </a>
                                <a href="{{ route('admin.exports.candidates', array_merge(request()->query(), ['format' => 'csv'])) }}" class="btn btn-sm btn-outline-secondary">
                                    Export CSV
                                </a>
                                <a href="{{ route('admin.candidates.create') }}" class="float-end me-1 btn btn-sm btn-primary">
                                    <i class="fa fa-plus-circle fa-lg"></i>
                                    {{ trans('messages.add_form_title', ['form' => trans(key: 'messages.candidates')]) }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-candidates-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            #
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Name')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Image')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Brief')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Created_At')}}
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
                                    @foreach ($candidates as $index => $candidate)
                                        <tr data-id="{{$candidate->id}}">
                                            <td><span class="text-secondary text-xs font-weight-bold">{{$index+1}}</span></td>
                                            <td class="text-center "><span class="text-secondary text-xs font-weight-bold">{{$candidate->name}}</span></td>
                                            <td class="text-center ">
                                                <img src="{{asset($candidate->image_url)}}" class="avatar avatar-lg me-3" alt="user1">
                                            </td>
                                            <td class="text-center ">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($candidate->brief), 65) }}
                                                </span>
                                            </td>
                                            <td class="text-center "><span class="text-secondary text-xs font-weight-bold">{{$candidate->created_at}} </span></td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($candidate->status)
                                                <span class="badge badge-sm bg-gradient-success">{{__('messages.active')}}</span>

                                                @else
                                                <span class="badge badge-sm bg-gradient-danger">{{__('messages.inactive')}}</span>

                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="{{route('admin.candidates.show',$candidate->slug)}}" class="mx-2 text-info font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{route('admin.candidates.edit',$candidate->slug)}}" class="mx-2 text-primary font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <a href="javascript:;" class="btn-delete text-danger mx-2" data-url="{{ route('admin.candidates.destroy', $candidate->slug) }}" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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
