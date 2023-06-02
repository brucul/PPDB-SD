<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">{{ env('APP_NAME') }}</a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#"><img src="{{ asset('assets/img/logo-sd.png') }}" width="40%"></a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::routeIs('be.index') ? "active" : "" }}">
                <a class="nav-link" href="{{ route('be.index') }}">
                    <i class="fas fa-th"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Menu</li>
            <li class="{{ Request::routeIs('be.ppdb.*') ? "active" : "" }}">
                <a class="nav-link" href="{{ route('be.ppdb.index') }}">
                    <i class="fas fa-file-lines"></i> <span>Data PPDB</span>
                </a>
            </li>
            @hasrole('superadmin')
            <li class="{{ Request::routeIs('be.user.index') ? "active" : "" }}">
                <a class="nav-link" href="{{ route('be.user.index') }}">
                    <i class="fas fa-users"></i> <span>Data Operator</span>
                </a>
            </li>
            @endhasrole
            <li class="{{ Request::routeIs('be.setting.index') ? "active" : "" }}">
                <a class="nav-link" href="{{ route('be.setting.index') }}">
                    <i class="fas fa-gear"></i> <span>Pengaturan</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
