<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Klinik Botolempangang</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a class="nav-link"
                 href="{{ url('dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Pages</li>
            <li class="{{ Request::is('data-dokter') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('data-dokter') }}"><i class="fas fa-user-md">
                    </i> <span>Data Dokter</span>
                </a>
            </li>
            <li class="{{ Request::is('data-perawat') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('data-perawat') }}"><i class="fas fa-user-nurse">
                    </i> <span>Data Perawat</span>
                </a>
            </li>
            <li class="{{ Request::is('data-pasien') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('data-pasien') }}"><i class="fas fa-user-injured">
                    </i> <span>Data Pasien</span>
                </a>
            </li>
            <li class="{{ Request::is('data-riwayat') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('data-riwayat') }}"><i class="fas fa-user-edit">
                    </i> <span>Data Riwayat Pasien</span>
                </a>
            </li>
            <!-- <li class="{{ Request::is('data-user') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('data-user') }}"><i class="fas fa-users">
                    </i> <span>Data User</span>
                </a>
            </li> -->


<!-- 

            <li class="nav-item dropdown {{ $type_menu === 'auth' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Login</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('auth-forgot-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-forgot-password') }}">Forgot Password</a>
                    </li>
                    <li class="{{ Request::is('auth-login') ? 'active' : '' }}">
                        <a href="{{ url('auth-login') }}">Login</a>
                    </li>
                    <li class="{{ Request::is('auth-login2') ? 'active' : '' }}">
                        <a class="beep beep-sidebar"
                            href="{{ url('auth-login2') }}">Login 2</a>
                    </li>
                    <li class="{{ Request::is('auth-register') ? 'active' : '' }}">
                        <a href="{{ url('auth-register') }}">Register</a>
                    </li>
                    <li class="{{ Request::is('auth-reset-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-reset-password') }}">Reset Password</a>
                    </li>
                </ul>
            </li> -->
        </ul>
    </aside>
</div>
