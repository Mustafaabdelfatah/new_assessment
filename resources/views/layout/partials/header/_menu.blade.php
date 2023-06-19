@php
    use App\Enums\UsersTypesEnums;

    $UserAction = App\Models\RateAction::where('user_id' , auth()->user()->id)
    ->whereIn('status', [App\Enums\RateStatusEnums::ACTIVE, App\Enums\RateStatusEnums::RETURNED])
    // ->orWhere('status' ,App\Enums\RateStatusEnums::RETURNED)
    ->first();
    // dd($UserAction);
    $admin = App\Models\User::where(['type' => App\Enums\UsersTypesEnums::ADMIN])
        ->pluck('id')
        ->toArray();
@endphp
    <!--begin::Menu wrapper-->
<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
     data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
     data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
     data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
     data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
    <!--begin::Menu-->
    <div class=" menu
            menu-rounded
            menu-active-bg
            menu-state-primary
            menu-column
            menu-lg-row
            menu-title-gray-700
            menu-icon-gray-500
            menu-arrow-gray-500
            menu-bullet-gray-500
            my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0
        "
         id="kt_app_header_menu" data-kt-menu="true">
        <!--begin:Menu item-->
        <div data-kt-menu-placement="bottom-start"
             class="menu-item show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
            <!--begin:Menu link--><a href="{{ url('/') }}" class="menu-link"><span
                    class="menu-title">Dashboards</span><span class="menu-arrow d-lg-none"></span></a>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px">
                {{-- @include('layout.partials.header._menu.__dashboards') --}}

            </div>
            <!--end:Menu sub-->
        </div>
        {{-- @dd($admin); --}}
        {{-- @if (in_array(auth()->user()->id, $admin) ||
    auth()->user()->AssessManager()->count() > 0)
        @endif --}}
        @checkAdmin()

        <div class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <a href="{{ url('users') }}" class="menu-link"><span class="menu-title">Users
                </span><span class="menu-arrow d-lg-none"></span></a>
        </div>
        <div class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <a href="{{ route('admin.positions.index') }}" class="menu-link"><span class="menu-title">Positions
                </span><span class="menu-arrow d-lg-none"></span></a>
        </div>

        <div class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <a href="{{ route('admin.questions.index') }}" class="menu-link"><span class="menu-title">Questions
                </span><span class="menu-arrow d-lg-none"></span></a>
        </div>
        <div class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <a href="{{ url('categories') }}" class="menu-link"><span class="menu-title">Category
                </span><span class="menu-arrow d-lg-none"></span></a>
        </div>
        @endcheckAdmin()

        @if (auth()->user()->AssessmentManager()->count() > 0 || auth()->user()->type == UsersTypesEnums::ADMIN)
            {{-- <div class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                <a href="{{ route('admin.rates') }}" class="menu-link"><span class="menu-title">Rates </span><span
                        class="menu-arrow d-lg-none"></span></a>
            </div> --}}

            <div class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                <a href="{{ route('admin.show.rated_users') }}" class="menu-link"><span class="menu-title">Rates </span><span
                        class="menu-arrow d-lg-none"></span></a>
            </div>

            <div class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                <a href="{{ route('admin.assessments.index') }}" class="menu-link"><span class="menu-title">Assessment
                    </span><span class="menu-arrow d-lg-none"></span></a>
            </div>


        @endif
        @if (auth()->user()->type == UsersTypesEnums::ADMIN)
        <div class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <a href="{{ url('/setting') }}" class="menu-link"><span class="menu-title">Setting
                    </span><span class="menu-arrow d-lg-none"></span></a>
        </div>

        @endif

        @if(auth()->user()->type == UsersTypesEnums::ADMIN)
            <div class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                <a href="{{ url('/rated_users') }}" class="menu-link"><span class="menu-title">Rated Users
                    </span><span class="menu-arrow d-lg-none"></span></a>
            </div>
        @endif

        @if ($UserAction)
            <div class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                <a href="{{ route('admin.actions') }}" class="menu-link"><span class="menu-title">Actions
                    </span><span class="menu-arrow d-lg-none"></span></a>
            </div>
        @endif

        <!--end:Menu item-->

    </div>
    <!--end::Menu-->
</div>
<!--end::Menu wrapper-->
