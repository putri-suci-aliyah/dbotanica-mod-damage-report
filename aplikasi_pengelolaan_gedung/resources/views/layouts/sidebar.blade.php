<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Dashboard</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->is('dashboard*') ? 'active' : '' }}" href="{{ url('dashboard') }}" aria-expanded="false">
                        <i class="mdi mdi-adjust"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                @if (auth()->user()->is_super_admin)
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">Data Master</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->is('divisi*') ? 'active' : '' }}" href="{{ url('divisi') }}" aria-expanded="false">
                            <i class="icon-layers"></i>
                            <span class="hide-menu">Divisi</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ url('users') }}" aria-expanded="false">
                            <i class="mdi mdi-account-multiple"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>
                @endif

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Pengelolaan Gedung</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->is('perbaikan*') ? 'active' : '' }}" href="{{ url('perbaikan') }}" aria-expanded="false">
                        <i class="mdi mdi-arrange-bring-forward"></i>
                        <span class="hide-menu">Temuan Kerusakan</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->is('pengerjaan_perbaikan*') ? 'active' : '' }}" href="{{ url('pengerjaan_perbaikan') }}" aria-expanded="false">
                        <i class="mdi mdi-hospital-building"></i>
                        <span class="hide-menu">Perbaikan Kerusakan</span>
                    </a>
                </li>


                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->is('selesai_perbaikan*') ? 'active' : '' }}" href="{{ url('selesai_perbaikan') }}" aria-expanded="false">
                        <i class="mdi mdi-marker-check"></i>
                        <span class="hide-menu">Selesai Perbaikan</span>
                    </a>
                </li>

                @if (auth()->user()->is_super_admin)
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">Laporan</span>
                    </li>

                    <li class="sidebar-item">
                        <a
                            class="sidebar-link waves-effect waves-dark sidebar-link"
                            data-toggle="modal"
                            data-target="#searchModal"
                            aria-expanded="false">
                            <i class="mdi mdi-file-excel-box"></i>
                            <span class="hide-menu">Unduh Ke Excel</span>
                        </a>
                    </li>


                    {{-- <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">Utility</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('backup.db') }}" aria-expanded="false">
                            <i class="fas fa-download"></i>
                            <span class="hide-menu">Backup</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="form-wizard.html" aria-expanded="false">
                            <i class="fas fa-upload"></i>
                            <span class="hide-menu">Restore</span>
                        </a>
                    </li> --}}
                @endif

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Logout</span>
                </li>
                <li class="sidebar-item">
                    <a
                        class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('logout') }}"
                        aria-expanded="false"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-directions"></i>
                        <span class="hide-menu">Log Out</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
