<?php  
    function check($val,$equal)
    {
        if ($val == $equal) {
            echo 'class="active-page"';
        }
    }
?>
<ul class="list-unstyled accordion-menu">
    <li class="sidebar-title">
        Main
    </li>
    <li <?php check($structure['setActivePage']['active'], 'Dashboard') ?>>
        <a href="<?= site_url('Admin/Dashboard') ?>"><i data-feather="home"></i>Dashboard</a>
    </li>
    <!-- <li <?php check($structure['setActivePage']['active'], 'Employee') ?>>
        <a href="#"><i data-feather="user"></i>List Employee</a>
    </li> -->
    <li <?php check($structure['setActivePage']['active'], 'Absen') ?>>
        <a href="<?= site_url('Admin/Absen') ?>"><i data-feather="edit"></i>List Absen</a>
    </li>
    <li <?php check($structure['setActivePage']['active'], 'Report') ?>>
        <a href="<?= site_url('Admin/Absen/report/') ?>"><i data-feather="file"></i>Report</a>
    </li>
</ul>