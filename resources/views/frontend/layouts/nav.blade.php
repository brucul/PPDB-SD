<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container" align="left">
        <ul class="navbar-nav">
            <li class="nav-item {{ Request::routeIs('fe.index') ? "active" : "" }}">
                <a href="{{ route('fe.index') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
