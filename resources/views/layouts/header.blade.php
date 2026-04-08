<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="24">
                        <span class="logo-txt">Minia</span>
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="24">
                        <span class="logo-txt">Minia</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <button class="btn btn-primary" type="button">
                        <i class="bx bx-search-alt align-middle"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="d-flex">

            <!-- LANGUAGE -->
            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/images/flags/us.jpg') }}" alt="Header Language" height="16">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                        <img src="{{ asset('assets/images/flags/us.jpg') }}" height="12"> English
                    </a>
                    <a class="dropdown-item" href="#">
                        <img src="{{ asset('assets/images/flags/spain.jpg') }}" height="12"> Spanish
                    </a>
                    <a class="dropdown-item" href="#">
                        <img src="{{ asset('assets/images/flags/germany.jpg') }}" height="12"> German
                    </a>
                </div>
            </div>

            <!-- APPS -->
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown">
                    <i data-feather="grid" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="p-2">
                        <div class="row g-0">
                            <div class="col">
                                <img src="{{ asset('assets/images/brands/github.png') }}" alt="">
                                <span>GitHub</span>
                            </div>
                            <div class="col">
                                <img src="{{ asset('assets/images/brands/bitbucket.png') }}" alt="">
                                <span>Bitbucket</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NOTIF -->
            <div class="dropdown d-inline-block">
                <button class="btn header-item noti-icon position-relative" data-bs-toggle="dropdown">
                    <i data-feather="bell" class="icon-lg"></i>
                    <span class="badge bg-danger rounded-pill">5</span>
                </button>
            </div>

            <!-- USER -->
            <div class="dropdown d-inline-block">
                <button class="btn header-item" data-bs-toggle="dropdown">
                    <div class="dropdown d-inline-block">
                        <button type="button"
                            class="btn header-item bg-light-subtle border-start border-end"
                            id="page-header-user-dropdown"
                            data-bs-toggle="dropdown">

                            <!-- TANPA FOTO -->
                            <span class="d-none d-xl-inline-block ms-1 fw-medium">
                                {{ Auth::user()->name ?? 'User' }}
                            </span>

                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">

                            <div class="dropdown-header">
                                Login sebagai:
                                <strong>{{ Auth::user()->role ?? 'User' }}</strong>
                            </div>

                            <div class="dropdown-divider"></div>

                            <!-- LOGOUT -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item">
                                    <i class="mdi mdi-logout me-1"></i> Logout
                                </button>
                            </form>

                        </div>
                    </div>
                </button>
            </div>

        </div>
    </div>
</header>