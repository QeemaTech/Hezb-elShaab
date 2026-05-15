<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-4 rotate-caret"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute start-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{route('admin.dashboard')}}"
            target="_blank">
            <img src="{{asset('dashboard/img/logo.png')}}" width="26px" height="26px"
                class="navbar-brand-img h-100" alt="main_logo">
            <span class="me-1 font-weight-bold">{{ __('messages.'.config('app.name', 'حزب الشعب الجمهوري')) }}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse px-0 w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link " href="{{route('admin.dashboard')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text me-1">{{__('messages.dashboard')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('admin.events.index')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text me-1">{{__('messages.events')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('admin.news.index')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text me-1">{{__('messages.news')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('admin.candidates.index')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-badge text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text me-1">{{__('messages.candidates')}}</span>
                </a>
            </li>
            @canany(['Users','Users List'])
                <li class="nav-item">
                    <a class="nav-link " href="{{route('admin.users.index',['type' => 'admins'])}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text me-1">{{__('messages.admins')}}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="{{route('admin.users.index',['type' => 'active-members'])}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text me-1">{{__('messages.active_members')}}</span>
                    </a>
                </li>
                <!--<li class="nav-item">-->
                <!--    <a class="nav-link " href="{{route('admin.users.index',['type' => 'pending-members'])}}">-->
                <!--        <div-->
                <!--            class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">-->
                <!--            <i class="ni ni-single-02 text-warning text-sm opacity-10"></i>-->
                <!--        </div>-->
                <!--        <span class="nav-link-text me-1">{{__('messages.members_requests')}}</span>-->
                <!--    </a>-->
                <!--</li>-->
            @endcan
            <li class="nav-item">
                <a class="nav-link " href="">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-chat-round text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text me-1">{{__('messages.chats')}}</span>
                </a>
            </li>
            @hasrole('super admin')
                <li class="nav-item">
                    <a class="nav-link " href="">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-key-25 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text me-1">{{__('messages.roles')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('admin.appSettings.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-settings text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text me-1">{{__('messages.app_settings')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('admin.sliders.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-image text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text me-1">{{__('messages.sliders')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('admin.branches.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-square-pin text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text me-1">{{__('messages.branches')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('admin.aboutUs.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-collection text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text me-1">{{__('messages.about_us')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('admin.complaints.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-support-16 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text me-1">{{__('messages.complaints')}}</span>
                    </a>
                </li>
            @endhasrole
        </ul>
    </div>


</aside>
