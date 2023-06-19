@php

$nums= isset($_POST['num']) ? $_POST['num'] : $_POST['num']=0;
   $user_id = auth()->user()->id;
    $get_position = auth()->user()->position;
    $position = App\Models\Position::orderBy('parent_id', 'asc')->get();
    if (auth()->user()->position == null) {
        $usersName = App\Models\User::select(['id','name','image'])->whereNot('type',App\Enums\UsersTypesEnums::ADMIN)->take(2+$nums)->get();
    } else {
        $treeRepoIds = App\Services\PositionTreeService::make($position, $get_position->id);
        $get_users = App\Models\User::whereIn('position_id', $treeRepoIds['ids'])->take(2)->get();
    }

@endphp

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
            <div  id="child_users" style="display: flex;
            flex-direction: column;">
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
                @foreach ($get_users as $user)
                    <a href="{{ route('admin.show_user', $user->id) }}" title="{{ $user->name }}"
                        class="btn btn-icon btn-default mx-auto mb-4 ">
                        <div class="symbol symbol-40px symbol-circle">
                            <img src="{{ $user->image_path }}" alt="">

                        </div>
                    </a>
                @endforeach
            @endcheckAdmin
        </div>
            <button id="load-more" style="background:#0984e3" class="btn btn-icon btn-default mx-auto mb-4 "> <span style="color:white;font-size: 20px;">+</span></button>
        </div>
        <!--end::Navbar-->
    </div>
    <!--end::Sidebar navbar-->
</div>
<!--end::Sidebar-->
