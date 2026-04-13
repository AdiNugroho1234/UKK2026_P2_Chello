
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

                        <li>
                            <a href="{{ route('Tarif.tarif') }}">
                                <i data-feather="dollar-sign"></i>
                                <span>Tarif Parkir</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('Kendaraan.kendaraan') }}">
                                <i data-feather="truck"></i>
                                <span>Kendaraan</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('Area.area') }}">
                                <i data-feather="map"></i>
                                <span>Area Parkir</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('Aktivitas.aktivitas') }}">
                                <i data-feather="activity"></i>
                                <span>Log Aktivitas</span>
                            </a>
                        </li>
                        @endif

                        {{-- PETUGAS --}}
                        @if($role == 'petugas')
                        <li>
                            <a href="{{ route('Kendaraan.kendaraan') }}">
                                <i data-feather="truck"></i>
                                <span>Kendaraan</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('Transaksi.masuk') }}">
                                <i data-feather="clock"></i>
                                <span>masuk</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('Transaksi.keluar') }}">
                                <i data-feather="clock"></i>
                                <span>keluar</span>
                            </a>
                        </li>
                        @endif

                        {{-- OWNER --}}
                        @if($role == 'owner')
                        <li>
                            <a href="{{ route('Riwayat.riwayat') }}">
                                <i data-feather="clock"></i>
                                <span>Riwayat</span>
                            </a>
                        </li>
                        @endif

                    </ul>
                </div>

            </div>
        </div>
      