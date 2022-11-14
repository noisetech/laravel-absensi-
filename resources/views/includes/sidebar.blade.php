<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        ABSENSI
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    @if (auth()->user()->role->role == 'admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            Manage Users
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-list"></i>
                <span>Manage Users</span>
            </a>
            <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('role') }}">Role</a>
                    <a class="collapse-item" href="{{ route('users') }}">Users</a>
                </div>
            </div>
        </li>




        <!-- Heading -->
        <div class="sidebar-heading">
            Master
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-list"></i>
                <span>Master</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('mapel') }}">Mata Pelajaran</a>
                    <a class="collapse-item" href="{{ route('list-pelajaran') }}">List Pelajaran</a>
                    <a class="collapse-item" href="{{ route('guru') }}">Guru</a>
                    <a class="collapse-item" href="{{ route('kelas') }}">Kelas</a>
                    <a class="collapse-item" href="{{ route('siswa') }}">Siswa</a>
                </div>
            </div>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">
            Absensi
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-list"></i>
                <span>Absensi</span>
            </a>
            <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('mapel') }}">Absensi</a>
                </div>
            </div>
        </li>





        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @elseif (auth()->user()->role->role == 'guru')
        <!-- Heading -->
        <div class="sidebar-heading">
            Master
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-list"></i>
                <span>Master</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('kelas') }}">Kelas</a>
                </div>
            </div>
        </li>
    @elseif (auth()->user()->role->role == 'siswa')
        <!-- Heading -->
        <div class="sidebar-heading">
            Jadwal Pelajaran
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-list"></i>
                <span>Jadwal Pelajaran</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('jadwal-siswa') }}">Jadwal</a>
                </div>
            </div>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
