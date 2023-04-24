        <!-- Header -->
        <div class="header d-print-none">
            <div class="header-container">
                <div class="header-left">
                    <div class="navigation-toggler">
                        <a href="#" data-action="navigation-toggler">
                            <i data-feather="menu"></i>
                        </a>
                    </div>

                    <div class="header-logo">
                        <a href=index.html>
                            <img class="logo" src="{{ asset('backend/assets/media/image/logo.png') }}" alt="logo">
                        </a>
                    </div>
                </div>

                <div class="header-body">
                    <div class="header-body-left">
                    </div>

                    <div class="header-body-right">
                        <ul class="navbar-nav">
                            @if (auth('admin')->check())
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" title="User menu"
                                        data-toggle="dropdown">
                                        <span class="ml-2 d-sm-inline d-none">{{ auth('admin')->user()->nama }}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                        <div class="text-center py-4">
                                            <h5 class="text-center">{{ auth('admin')->user()->nama }}</h5>
                                            <div class="mb-3 small text-center text-muted">Admin</div>
                                            <a href="{{ route('admin.profil.index') }}"
                                                class="btn btn-outline-light btn-rounded">Manage Your
                                                Account</a>
                                        </div>
                                        <div class="list-group text-center">
                                            <form action="{{ route('admin.logout') }}" method="post">
                                                @csrf
                                                <a href="#" class="list-group-item text-danger"
                                                    onclick="$(this).closest('form').submit();">Sign Out!</a>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @elseif (auth()->user() && auth()->user()->role == 'PENGURUS')
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" title="User menu"
                                        data-toggle="dropdown">
                                        <span class="ml-2 d-sm-inline d-none">{{ auth()->user()->nama }}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                        <div class="text-center py-4">
                                            <h5 class="text-center">{{ auth()->user()->nama }}</h5>
                                            <div class="mb-3 small text-center text-muted">PENGURUS</div>
                                            <a href="{{ route('pengurus.profil.index') }}"
                                                class="btn btn-outline-light btn-rounded">Manage Your
                                                Account</a>
                                        </div>
                                        <div class="list-group text-center">
                                            <form action="{{ route('pengurus.logout') }}" method="post">
                                                @csrf
                                                <a href="#" class="list-group-item text-danger"
                                                    onclick="$(this).closest('form').submit();">Sign Out!</a>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @elseif (auth()->check())
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" title="User menu"
                                        data-toggle="dropdown">
                                        <span class="ml-2 d-sm-inline d-none">{{ auth()->user()->nama }}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                        <div class="text-center py-4">
                                            <h5 class="text-center">{{ auth()->user()->nama }}</h5>
                                            <div class="mb-3 small text-center text-muted">Anggota</div>
                                            <a href="{{ route('anggota.profil.index') }}"
                                                class="btn btn-outline-light btn-rounded">Manage Your
                                                Account</a>
                                        </div>
                                        <div class="list-group text-center">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <a href="#" class="list-group-item text-danger"
                                                    onclick="$(this).closest('form').submit();">Sign Out!</a>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item header-toggler">
                        <a href="#" class="nav-link">
                            <i data-feather="arrow-down"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ./ Header -->
