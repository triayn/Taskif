<li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="nav-item {{ Request::routeIs('task.index') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="{{ route('task.index') }}">
        <i class="fas fa-fw fa-calendar"></i>
        <span>Tugas</span>
    </a>
</li>
<li class="nav-item {{ Request::routeIs('manajemen.list') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('manajemen.list') }}">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>Manajemen Tugas</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-folder"></i>
        <span>Riwayat Tugas</span></a>
</li>