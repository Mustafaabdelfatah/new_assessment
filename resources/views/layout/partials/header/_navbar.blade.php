<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::Search-->

    <!--end::Search-->
    <!--begin::Notifications-->
    <div class="app-navbar-item ms-1 ms-lg-5">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom">
            <i class="fonticon-alarm fs-2"></i>
        </div>
        @if (auth()->user()->unreadNotifications()->count() > 0)
            <span
                class="notifispan bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle  animation-blink"
                style="    margin: -27px 0px 0 20px;
            ">
            </span>
        @endif
        @include('partials.menus._notifications-menu')

        <!--end::Menu wrapper-->
    </div>

    <!--begin::User menu-->
    <div class="app-navbar-item ms-5" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <div class="cursor-pointer symbol symbol-35px symbol-md-45px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            @if(auth()->user()->image_path)
            <img src="{{auth()->user()->image_path}}" style="width: 40px;height:40px;border-radius:50%;margin:0 10px" alt="User Image">
            @else
            <span class="svg-icon svg-icon-muted svg-icon-3hx">
                <svg width="18" height="18" viewBox="0 0 18 18"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3"
                        d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z"
                        fill="currentColor" />
                    <path
                        d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z"
                        fill="currentColor" />
                    <rect x="7" y="6" width="4" height="4" rx="2"
                        fill="currentColor" />
                </svg>
            </span>
            @endif

            {{-- <img class="symbol symbol-circle symbol-35px symbol-md-45px"
                src="{{ asset('assets') }}/media/avatars/default.webp" alt="user" /> --}}
        </div>
        @include('partials.menus._user-account-menu')

        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->
    <!--begin::Header menu toggle-->
    <div class="app-navbar-item d-lg-none ms-2 me-n3" title="Show header menu">
        <div class="btn btn-icon btn-active-color-primary w-30px h-30px w-md-35px h-md-35px"
            id="kt_app_header_menu_toggle">
            <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
            <span class="svg-icon svg-icon-2 svg-icon-md-1"><svg width="24" height="24" viewBox="0 0 24 24"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                        fill="currentColor" />
                    <path opacity="0.3"
                        d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
    </div>
    <!--end::Header menu toggle-->
</div>
<!--end::Navbar-->
