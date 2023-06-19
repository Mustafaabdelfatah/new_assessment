<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic
Product Version: 8.1.7
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<!-- Mirrored from preview.keenthemes.com/metronic8/demo41/authentication/layouts/creative/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 27 Jan 2023 13:30:48 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Assessment</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="
            The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo,
            Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions.
            Grab your copy now and get life-time updates for free.
        " />
    <meta name="keywords"
        content="
            metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js,
            Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates,
            free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button,
            bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon
        " />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="
            Metronic - Bootstrap Admin Template, HTML, VueJS, React, Angular. Laravel, Asp.Net Core, Ruby on Rails,
            Spring Boot, Blazor, Django, Express.js, Node.js, Flask Admin Dashboard Theme & Template
        " />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
     <link rel="shortcut icon" href="{{ asset('icons/loading.png') }}" style="height: 23px;width:50px" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->



    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('/') }}assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <!--Begin::Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                '../../../../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5FS8GGP');
    </script>
    <!--End::Google Tag Manager -->
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--Begin::Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!--End::Google Tag Manager (noscript) -->

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url("{{ asset('icons/bg10.jpeg') }}");
            }
        </style>
        <!--end::Page bg image-->

        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <!--begin::Image-->
                    {{-- <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="/metronic8/demo41/assets/media/auth/agency.png" alt="">
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="/metronic8/demo41/assets/media/auth/agency-dark.png" alt=""> --}}
                    <!--end::Image-->

                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('icons/agency.png') }}" alt="">

                    <!--begin::Title-->
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">
                        Welcome To Wakeb
                    </h1>
                    <!--end::Title-->

                    <!--begin::Text-->
                    {{-- <div class="text-gray-600 fs-base text-center fw-semibold">
                        In this kind of post, <a href="#" class="opacity-75-hover text-primary me-1">the
                            blogger</a>

                        introduces a person they’ve interviewed <br> and provides some background information about

                        <a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>
                        and their <br> work following this is a transcript of the interview.
                    </div> --}}
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Aside-->

            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <!--begin::Wrapper-->
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <!--begin::Content-->
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">

                            <!--begin::Form-->
                            <form method="POST" action="{{ route('login') }}" class="form w-100"
                                novalidate="novalidate">
                                @csrf
                                <!--begin::Heading-->
                                <div class="text-center mb-11">
                                    <!--begin::Title-->
                                    <h1 class="text-dark fw-bolder mb-3">
                                        Sign In
                                    </h1>
                                    <!--end::Title-->

                                    {{-- <!--begin::Subtitle-->
                                    <div class="text-gray-500 fw-semibold fs-6">
                                        Your Social Campaigns
                                    </div>
                                    <!--end::Subtitle---> --}}
                                </div>
                                <!--begin::Heading-->


                                <!--begin::Separator-->
                                <div class="separator separator-content my-14">
                                    <span class="w-125px text-gray-500 fw-semibold fs-7">Login with email</span>
                                </div>
                                <!--end::Separator-->
                                <!--begin::Input group--->
                                <div class="fv-row mb-8 fv-plugins-icon-container">
                                    <!--begin::Email-->
                                    <input type="text" required autofocus placeholder="Email" name="email"
                                        autocomplete="off" class="form-control bg-transparent">
                                    <!--end::Email-->
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!--end::Input group--->
                                <div class="fv-row mb-3 fv-plugins-icon-container">
                                    <!--begin::Password-->
                                    <input type="password" placeholder="Password" name="password" autocomplete="off"
                                        class="form-control bg-transparent">
                                    <!--end::Password-->
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Input group--->

                                {{-- @if (Route::has('password.request')) --}}
                                <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                {{-- @endif --}}

                                <!--begin::Submit button-->
                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">
                                            Sign In</span>
                                        <!--end::Indicator label-->

                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">
                                            Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                        <!--end::Indicator progress-->
                                    </button>
                                </div>
                                <!--end::Submit button-->

                                <!--begin::Sign up-->

                                <!--end::Sign up-->
                            </form>
                            <!--end::Form-->

                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Footer-->

                        <!--end::Footer-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "{{ asset('/') }}assets/index.html";
    </script>

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('/') }}assets/plugins/global/plugins.bundle.js"></script>
    <script src="{{ asset('/') }}assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->


    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('/') }}assets/js/custom/authentication/sign-in/general.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->



    <svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1"
        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
        style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
        <defs id="SvgjsDefs1002"></defs>
        <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
        <path id="SvgjsPath1004" d="M0 0 "></path>
    </svg>
    <script type="text/javascript" id="">
        ! function(b, e, f, g, a, c, d) {
            b.fbq || (a = b.fbq = function() {
                    a.callMethod ? a.callMethod.apply(a, arguments) : a.queue.push(arguments)
                }, b._fbq || (b._fbq = a), a.push = a, a.loaded = !0, a.version = "2.0", a.queue = [], c = e
                .createElement(f), c.async = !0, c.src = g, d = e.getElementsByTagName(f)[0], d.parentNode.insertBefore(
                    c, d))
        }(window, document, "script", "https://connect.facebook.net/en_US/fbevents.js");
        fbq("init", "738802870177541");
        fbq("track", "PageView");
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=738802870177541&amp;ev=PageView&amp;noscript=1"></noscript>
    <script type="text/javascript" id="">
        try {
            (function() {
                var a = google_tag_manager["GTM-5FS8GGP"].macro(6);
                a = "undefined" == typeof a ? google_tag_manager["GTM-5FS8GGP"].macro(7) : a;
                var b = new Date;
                b.setTime(b.getTime() + 18E5);
                var c = "gtm-session-start";
                b = b.toGMTString();
                var d = "/",
                    e = ".keenthemes.com";
                document.cookie = c + "\x3d" + a + "; Expires\x3d" + b + "; domain\x3d" + e + "; Path\x3d" + d
            })()
        } catch (a) {};
    </script>
    <script type="text/javascript" id="">
        (function() {
            var a = google_tag_manager["GTM-5FS8GGP"].macro(8) - 0 + 1,
                b = ".keenthemes.com";
            document.cookie = "damlPageCount\x3d" + a + ";domain\x3d" + b + ";path\x3d/;"
        })();
    </script>
    <div style="display: none" class="ubey-RecordingScreen-count-down ubey-RecordingScreen-count-down-container">
        <style>
            .ubey-RecordingScreen-count-down-container {
                position: fixed;
                height: 100vh;
                width: 100vw;
                top: 0;
                left: 0;
                z-index: 9999999999999;
                background-color: rgba(0, 0, 0, 0.2);
            }

            .ubey-RecordingScreen-count-down-content {
                position: absolute;
                display: flex;
                top: 50%;
                left: 50%;
                justify-content: center;
                align-items: center;
                color: white;
                height: 15em;
                width: 15em;
                transform: translate(-50%, -100%);
                background-color: rgba(0, 0, 0, 0.6);
                border-radius: 50%;
            }

            #ubey-RecordingScreen-count-count {
                font-size: 14em;
                transform: translateY(-2%);
            }
        </style>
        <div class="ubey-RecordingScreen-count-down-content">
            <span id="ubey-RecordingScreen-count-count"></span>
        </div>
    </div>
</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic8/demo41/authentication/layouts/creative/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 27 Jan 2023 13:30:49 GMT -->

</html>
