<nav class="navbar navbar-expand-lg main-navbar bg-dark">
    <a href="{{ route('fe.index') }}" class="navbar-brand sidebar-gone-hide">{{env('APP_NAME')}}</a>
    <a href="{{ route('be.auth.login') }}" class="btn btn-outline-white btn-icon icon-right ml-auto sidebar-gone-hide">Masuk sebagai admin <i class="fas fa-right-to-bracket"></i></a>

    <div class="navbar-nav">
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>
</nav>
