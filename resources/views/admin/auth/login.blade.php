@extends('admin.layouts.auth')
@section('content')
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">{{__('messages.wellcome')}}</h4>
                                <p class="mb-0">{{__('messages.Enter_your_email_and_password_to_sign_in')}}</p>
                            </div>
                            <div class="card-body">
                                <form  action="{{route('login.post')}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control form-control-lg" placeholder="{{__('messages.Email')}}" aria-label="Email">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control form-control-lg" placeholder="{{__('messages.Password')}}" aria-label="Password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">{{__('messages.Sign_in')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                        <div class="position-relative  h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                            style="background-image: url('{{asset('dashboard/img/logo.png')}}'); background-size: contain;background-repeat: no-repeat;background-position: center;">
                            <span class="mask  opacity-6"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection('content')
