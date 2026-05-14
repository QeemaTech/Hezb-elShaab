@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h6>{{__('messages.sliders')}}</h6>
                            <a href="{{ route('admin.sliders.create') }}" class="float-end me-1 btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle fa-lg"></i>
                                {{ trans('messages.add_form_title', ['form' => trans(key: 'messages.sliders')]) }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-sliders-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            #
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Image')}}
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            {{__('messages.Actions')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $index => $slider)
                                        <tr data-id="{{$slider->id}}">
                                            <td><span class="text-secondary text-xs font-weight-bold">{{$index+1}}</span></td>
                                            <td class="text-center ">
                                                <img src="{{asset($slider->path_url)}}" class="avatar avatar-lg me-3" alt="user1">
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="javascript:;" class="btn-delete text-danger mx-2" data-url="{{ route('admin.sliders.destroy', $slider->id) }}" title="Delete">
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
