<header class="header">

    <div class="top_bar background-color-orange">
        <div class="top_bar_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                            <ul class="top_bar_contact_list">
                                <li>
                                    <i class="fa fa-phone coll" aria-hidden="true"></i>
                                    <div class="contact-no">0123 4567 8912</div>
                                </li>
                                <li>
                                    <i class="fa fa-envelope coll" aria-hidden="true"></i>
                                    <div class="email"><a
                                            href="https://demo.technosarjan.com/cdn-cgi/l/email-protection"
                                            class="__cf_email__"
                                            data-cfemail="c3a6bba2aeb3afa683a9aca1b7a6ada7eda0acae">[email&#160;protected]</a>
                                    </div>
                                </li>
                            </ul>
                            <div class=" ml-auto ">
                                <div class="search_button search"><i
                                        class="large material-icons search-icone">search</i></div>
                                <div class="hamburger menu_mm  search_button transparent search display"><i
                                        class="large material-icons font-color-white  search-icone  menu_mm ">menu</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header_container background-color-orange-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justify-content-start">
                        <div class="logo_container">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('asset/imags/logo.png') }}" class="logo-text" alt="">
                            </a>
                        </div>
                        <nav class="main_nav_contaner ml-auto"
                            style="display: flex;
                        justify-content: center;
                        align-items: center;">
                            <ul class="main_nav mr-5">
                                <li class="dropdown active ">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Home
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="index.html">Home variation 1</a></li>
                                        <li><a href="index2.html">Home variation 2</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Job
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="job_category.html">Job List</a></li>
                                        <li><a href="job_detail.html">Job Detail</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog_page.html"> Blog</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                            @if (Auth::guard('user')->check())
                                <div class="dropdown Post-Jobs dropdown-menu-mobile">
                                    <div class="ml-2" style="width: 200px">
                                        <div class="title"
                                            style="background: #fafafa;
                                        border-radius: 20px;">
                                            <a href="{{ route('users.profile.index', Auth::guard('user')->user()->slug) }}"
                                                style="display: flex;
                                        align-items: center;
                                        justify-content: space-evenly;">
                                                <img src="https://www.topcv.vn/images/avatar-default.jpg" width="30"
                                                    style="border-radius: 15px ">
                                                <span class="fullname"
                                                    style="color: #f26522; font-weight: 500">{{ Auth::guard('user')->user()->name }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="Post-Jobs ml-3">
                                    <a href="{{ route('users.login.index') }}" class="">
                                        Đăng nhập
                                    </a>
                                </div>
                                <div class="Post-Jobs search-seeker">
                                    <a href="" class="">
                                        Đăng ký
                                    </a>
                                </div>
                            @endif
                            <div class="hamburger menu_mm menu-vertical">
                                <i class="large material-icons font-color-white menu_mm menu-vertical">menu</i>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- menu mobiel --}}
    <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
        <div class="menu_close_container">
            <div class="menu_close">
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="search">
            <form action="#" class="header_search_form menu_mm">
                <input type="search" class="search_input menu_mm" placeholder="Search" required="required">
                <button
                    class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
                    <i class="fa fa-search menu_mm" aria-hidden="true"></i>
                </button>
            </form>
        </div>
        <nav class="menu_nav">
            <ul class="menu_mm">
                <li class="dropdown menu_mm">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Home
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.html">Home 1</a></li>
                        <li><a href="index2.html">Home 2</a></li>
                    </ul>
                </li>
                <li class="dropdown menu_mm">
                    <a class="dropdown-toggle menu_mm" data-toggle="dropdown" href="#">Job
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu menu_mm">
                        <li class="menu_mm"><a href="job_category.html">Job List</a></li>
                        <li class="menu_mm"><a href="job_detail.html">Job Detail</a></li>
                    </ul>
                </li>
                <li class="menu_mm"><a href="blog_page.html">Blog</a></li>
                <li class="menu_mm"><a href="about_us.html">About</a></li>
                <li class="menu_mm"><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>
