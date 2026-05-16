@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h6>{{__('messages.news')}}</h6>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.exports.news', array_merge(request()->query(), ['format' => 'xlsx'])) }}" class="btn btn-sm btn-outline-success">
                                    Export Excel
                                </a>
                                <a href="{{ route('admin.exports.news', array_merge(request()->query(), ['format' => 'csv'])) }}" class="btn btn-sm btn-outline-secondary">
                                    Export CSV
                                </a>
                                <a href="{{ route('admin.news.create') }}" class="float-end me-1 btn btn-sm btn-primary">
                                    <i class="fa fa-plus-circle fa-lg"></i>
                                    {{ trans('messages.add_form_title', ['form' => trans(key: 'messages.news')]) }}
                                </a>
                            </div>
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
                                            {{__('messages.Title')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Image')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.read_minutes')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Date')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Status')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Created_By')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Actions')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $index => $item)
                                        <tr data-id="{{$item->id}}">
                                            <td><span class="text-secondary text-xs font-weight-bold">{{$index+1}}</span></td>
                                            <td class="text-center "><span class="text-secondary text-xs font-weight-bold">{{$item->title}}</span></td>
                                            <td class="text-center ">
                                                <img src="{{asset($item->image_url)}}" class="avatar avatar-lg me-3" alt="user1">
                                            </td>
                                            <td class="text-center "><span class="text-secondary text-xs font-weight-bold">{{$item->read_minutes}} دقيقة</span></td>
                                            <td class="text-center "><span class="text-secondary text-xs font-weight-bold">{{$item->created_at}} </span></td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($item->status)
                                                <span class="badge badge-sm bg-gradient-success">{{__('messages.active')}}</span>

                                                @else
                                                <span class="badge badge-sm bg-gradient-danger">{{__('messages.inactive')}}</span>

                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex px-2 py-1 justify-content-center">
                                                    <div class="mx-3">
                                                        <img src="{{asset($item->user->image_url)}}" class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$item->user->name}}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{$item->user->email}}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-center align-middle">
                                                <a href="{{route('admin.news.show',$item->slug)}}" class="mx-2 text-info font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{route('admin.news.edit',$item->slug)}}" class="mx-2 text-primary font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <a href="javascript:;" class="btn-delete text-danger mx-2" data-url="{{ route('admin.news.destroy', $item->slug) }}" title="Delete">
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
