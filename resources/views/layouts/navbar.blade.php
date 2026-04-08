
        {{-- SIDEBAR --}}
        <div class="vertical-menu">
            <div data-simplebar class="h-100">

                @php $role = auth()->user()->role; @endphp

                <div id="sidebar-menu">
                    <ul class="metismenu list-unstyled" id="side-menu">

                        <li class="menu-title">Menu</li>

                        {{-- DASHBOARD --}}
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <i data-feather="home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        {{-- ADMIN --}}
                        @if($role == 'admin')
                        <li>
                            <a href="{{ route('user') }}">
                                <i data-feather="users"></i>
                                <span>Kelola User</span>
                            </a>
                        </li>

                        @endif

                    </ul>
                </div>

            </div>
        </div>
      