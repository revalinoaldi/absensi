<nav class="navbar navbar-expand-lg d-flex justify-content-between">
    <div class="" id="navbarNav">
        <ul class="navbar-nav" id="leftNav">
            <li class="nav-item">
                <a class="nav-link" id="sidebar-toggle" href="#"><i data-feather="arrow-left"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><?= $data['data']['nama'] ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('Karyawan/Dashboard') ?>">Home</a>
            </li>
        </ul>
    </div>
    <div class="logo">
        <a class="navbar-brand" href="<?= site_url('Karyawan/Dashboard') ?>"></a>
    </div>
    <div class="" id="headerNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="<?= base_url() ?>assets/images/avatars/user.jpg" alt=""></a>
                <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
                    <a class="dropdown-item" href="<?= site_url('Karyawan/Dashboard') ?>"><i data-feather="home"></i>Home</a>
                    <a class="dropdown-item" href="<?= site_url('Karyawan/Employee/profile') ?>"><i data-feather="user"></i>Profile</a>
                    <a class="dropdown-item" href="<?= site_url('Karyawan/Task') ?>"><i data-feather="check-circle"></i>List Absen</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= site_url('Logout') ?>"><i data-feather="log-out"></i>Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>