<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar  flex-column " data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Sidebar navbar-->
    <div class="app-sidebar-navbar flex-grow-1 hover-scroll-overlay-y my-5" id="kt_app_sidebar_primary_navbar"
        data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_primary_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_primary_navbar" data-kt-scroll-offset="5px">
        <!--begin::Navbar-->
        <div  class="app-navbar flex-column flex-center pt-5">
            <!--begin::Navbar item-->

            @checkAdmin()

                @foreach ($usersName as $user)
                    <a href="{{ route('admin.show_user', $user->id) }}" title="{{ $user->name }}"
                        class="btn btn-icon btn-default mx-auto mb-4 ">
                        <div class="symbol symbol-40px symbol-circle">
                            <img src="{{ $user->image_path }}" alt="">
                        </div>
                    </a>
                @endforeach
            @else
            <div  id="child_users">
                @foreach ($get_users as $user)
                    <a href="{{ route('admin.show_user', $user->id) }}" title="{{ $user->name }}"
                        class="btn btn-icon btn-default mx-auto mb-4 ">
                        <div class="symbol symbol-40px symbol-circle">
                            <img src="{{ $user->image_path }}" alt="">

                        </div>
                    </a>
                @endforeach
            </div>
            @endcheckAdmin
            <button id="load-more" style="background:#0984e3" class="btn btn-icon btn-default mx-auto mb-4 "> <span style="color:white;font-size: 20px;">+</span></button>
        </div>
        <!--end::Navbar-->
    </div>
    <!--end::Sidebar navbar-->
</div>
<!--end::Sidebar-->
