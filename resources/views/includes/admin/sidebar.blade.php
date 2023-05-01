<!-- begin::navigation -->
<div class="navigation">
    <div class="navigation-header">
        <span>Navigation</span>
        <a href="#">
            <i class="ti-close"></i>
        </a>
    </div>
    <div class="navigation-menu-body">
        <ul>
            @if (auth('admin')->user() && auth('admin')->user()->is_admin == false)
                <li>
                    <a {{ request()->routeIs('pengawas.dashboard') ? 'class=active ' : '' }}
                        href="{{ route('pengawas.dashboard') }}">
                        <span class="nav-link-icon">
                            <i data-feather="pie-chart"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('pengawas.laporan*') ? 'class=active ' : '' }}
                        href="{{ route('pengawas.laporan.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="activity"></i>
                        </span>
                        <span>Laporan</span>
                    </a>
                </li>
            @elseif (auth('admin')->check())
                <li>
                    <a {{ request()->routeIs('admin.dashboard') ? 'class=active ' : '' }}
                        href="{{ route('admin.dashboard') }}">
                        <span class="nav-link-icon">
                            <i data-feather="pie-chart"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('admin.anggota*') ? 'class=active ' : '' }}
                        href="{{ route('admin.anggota.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="user"></i>
                        </span>
                        <span>Anggota</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('admin.pengurus*') ? 'class=active ' : '' }}
                        href="{{ route('admin.pengurus.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="user"></i>
                        </span>
                        <span>Pengurus</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('admin.pengawas*') ? 'class=active ' : '' }}
                        href="{{ route('admin.pengawas.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="user"></i>
                        </span>
                        <span>Pengawas</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('admin.kas*') ? 'class=active ' : '' }}
                        href="{{ route('admin.kas.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="dollar-sign"></i>
                        </span>
                        <span>Kelola Kas</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('admin.simpanan*') ? 'class=active ' : '' }}
                        href="{{ route('admin.simpanan.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="dollar-sign"></i>
                        </span>
                        <span>Simpanan</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('admin.permintaan-penarikan*') ? 'class=active ' : '' }}
                        href="{{ route('admin.permintaan-penarikan.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="dollar-sign"></i>
                        </span>
                        <span>Permintaan Penarikan</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('admin.pembagian-shu*') ? 'class=active ' : '' }}
                        href="{{ route('admin.pembagian-shu.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="activity"></i>
                        </span>
                        <span>Pembagian SHU</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('admin.laporan*') ? 'class=active ' : '' }}
                        href="{{ route('admin.laporan.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="activity"></i>
                        </span>
                        <span>Laporan</span>
                    </a>
                </li>
            @elseif(auth()->user() && auth()->user()->role == 'PENGURUS')
                <li>
                    <a {{ request()->routeIs('pengurus.dashboard') ? 'class=active ' : '' }}
                        href="{{ route('pengurus.dashboard') }}">
                        <span class="nav-link-icon">
                            <i data-feather="pie-chart"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('pengurus.anggota*') ? 'class=active ' : '' }}
                        href="{{ route('pengurus.anggota.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="user"></i>
                        </span>
                        <span>Anggota</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('pengurus.kas*') ? 'class=active ' : '' }}
                        href="{{ route('pengurus.kas.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="dollar-sign"></i>
                        </span>
                        <span>Kelola Kas</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('pengurus.simpanan*') ? 'class=active ' : '' }}
                        href="{{ route('pengurus.simpanan.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="dollar-sign"></i>
                        </span>
                        <span>Simpanan</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('pengurus.setor-simpanan*') ? 'class=active ' : '' }}
                        href="{{ route('pengurus.setor-simpanan.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="dollar-sign"></i>
                        </span>
                        <span>Setor Simpanan</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('pengurus.riwayat-simpanan*') ? 'class=active ' : '' }}
                        href="{{ route('pengurus.riwayat-simpanan.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="activity"></i>
                        </span>
                        <span>Riwayat Transaksi</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('pengurus.tarik-simpanan*') ? 'class=active ' : '' }}
                        href="{{ route('pengurus.tarik-simpanan.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="dollar-sign"></i>
                        </span>
                        <span>Tarik Simpanan</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('pengurus.laporan*') ? 'class=active ' : '' }}
                        href="{{ route('pengurus.laporan.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="activity"></i>
                        </span>
                        <span>Laporan</span>
                    </a>
                </li>
            @else
                <li>
                    <a {{ request()->routeIs('dashboard') ? 'class=active ' : '' }} href="{{ route('dashboard') }}">
                        <span class="nav-link-icon">
                            <i data-feather="pie-chart"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('anggota.setor-simpanan*') ? 'class=active ' : '' }}
                        href="{{ route('anggota.setor-simpanan.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="dollar-sign"></i>
                        </span>
                        <span>Setor Simpanan</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('anggota.riwayat-simpanan*') ? 'class=active ' : '' }}
                        href="{{ route('anggota.riwayat-simpanan.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="activity"></i>
                        </span>
                        <span>Riwayat Transaksi</span>
                    </a>
                </li>
                <li>
                    <a {{ request()->routeIs('anggota.tarik-simpanan*') ? 'class=active ' : '' }}
                        href="{{ route('anggota.tarik-simpanan.index') }}">
                        <span class="nav-link-icon">
                            <i data-feather="dollar-sign"></i>
                        </span>
                        <span>Tarik Simpanan</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
<!-- end::navigation -->
