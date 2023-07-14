{{-- menu mobile --}}
@php
    use App\Models\Majors;
    $majors = Majors::query()->get();
@endphp
<div class="responsive-header">
    <div class="responsive-menubar">
        <div class="res-logo"><a href="{{ route('home') }}" title=""><img
                    src="{{ asset('home/images/resource/logo.png') }}" alt="" /></a>
        </div>
        <div class="menu-resaction">
            <div class="res-openmenu">
                <img src="{{ asset('home/images/icon.png') }}" alt="" /> Menu
            </div>
            <div class="res-closemenu">
                <img src="{{ asset('home/images/icon2.png') }}" alt="" /> Close
            </div>
        </div>
    </div>
    <div class="responsive-opensec">
        <div class="responsivemenu">
            <ul>
                <li class="menu-item-has-children">
                    <a href="#" title="">Home</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="#" title="">Ngành nghề</a>
                    <ul>
                        <li><a href="employer_list1.html" title=""> Employer List 1</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#" title="">Nhà tuyển dụng</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="#" title="">Câu hỏi thường hỏi</a>
                </li>
            </ul>
        </div>
        @if (!Auth::guard('user')->check())
            <div class="btn-extars">
                <ul class="account-btns">
                    <li class="signup-popup"><a title=""><i class="la la-key"></i> Sign Up</a></li>
                    <li class="signin-popup"><a title=""><i class="la la-external-link-square"></i>
                            Login</a></li>
                </ul>
            </div>
        @else
            <div class="btns-profiles-sec">
                <span><img src="{{ asset('home/images/resource/profile.jpg') }}"
                        alt="">{{ Auth::guard('user')->user()->name }}<i class="la la-angle-down"></i></span>
                <ul>
                    <li><a href="employer_profile.html" title=""><i class="la la-file-text"></i>Thông tin
                            cá nhân</a></li>
                    <li><a href="employer_manage_jobs.html" title=""><i class="la la-briefcase"></i>Công
                            việc đã ứng tuyển</a></li>
                    <li><a href="employer_transactions.html" title=""><i class="la la-money"></i>Công việc
                            đã ưu thích</a></li>
                    <li><a href="employer_resume.html" title=""><i class="la la-paper-plane"></i>Công việc
                            đã nộp</a>
                    </li>
                    <li><a href="employer_packages.html" title=""><i class="la la-user"></i>Quản lý CV</a>
                    </li>
                    <li><a href="employer_change_password.html" title=""><i class="la la-lock"></i>Đổi mật
                            khẩu</a></li>
                    <li><a href="{{ route('logout') }}" title=""><i class="la la-unlink"></i>Logout</a>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</div>
{{-- header --}}
<header class="stick-top forsticky">
    <div class="menu-sec">
        <div class="container">
            <div class="logo">
                <a href="{{ route('home') }}" title=""><img class="hidesticky"
                        src="{{ asset('home/images/resource/logo.png') }}" alt="" /><img class="showsticky"
                        src="{{ asset('home/images/resource/logo10.png') }}" alt="" /></a>
            </div>
            <!-- Logo -->
            @if (!Auth::guard('user')->check())
                <div class="btn-extars">
                    <ul class="account-btns">
                        <li class="signup-popup"><a title=""><i class="la la-key"></i> Sign Up</a></li>
                        <li class="signin-popup"><a title=""><i class="la la-external-link-square"></i>
                                Login</a></li>
                    </ul>
                </div>
            @else
                <div class="btns-profiles-sec">
                    <span><img src="{{ asset('home/images/resource/profile.jpg') }}"
                            alt="">{{ Auth::guard('user')->user()->name }}<i
                            class="la la-angle-down"></i></span>
                    <ul>
                        <li><a href="{{ route('users.profile.index', Auth::guard('user')->user()->slug) }}"
                                title=""><i class="la la-file-text"></i>Thông tin
                                cá nhân</a></li>
                        <li><a href="employer_manage_jobs.html" title=""><i class="la la-briefcase"></i>Công
                                việc đã ứng tuyển</a></li>
                        <li><a href="employer_transactions.html" title=""><i class="la la-money"></i>Công việc
                                đã ưu thích</a></li>
                        <li><a href="employer_resume.html" title=""><i class="la la-paper-plane"></i>Công việc
                                đã nộp</a>
                        </li>
                        <li><a href="employer_packages.html" title=""><i class="la la-user"></i>Quản lý CV</a>
                        </li>
                        <li><a href="employer_change_password.html" title=""><i class="la la-lock"></i>Đổi mật
                                khẩu</a></li>
                        <li><a href="{{ route('logout') }}" title=""><i class="la la-unlink"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            @endif

            <!-- Btn Extras -->
            <nav>
                <ul>
                    <li class="menu-item-has-children">
                        <a href="{{ route('home') }}" title="">Trang chủ</a>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#" title="">Ngành nghề</a>
                        <ul>
                            @foreach ($majors as $item)
                                <li>
                                    <a href="{{ route('client.nganh-nghe.show', $item->id) }}"
                                        title="">{{ $item->name }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="{{ route('company.index') }}" title="">Nhà tuyển dụng</a>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#" title="">Câu hỏi thường hỏi</a>
                    </li>
                </ul>
            </nav><!-- Menus -->
        </div>
    </div>
</header>
