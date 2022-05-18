<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from phantom-themes.com/circl/theme/templates/admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Jul 2021 15:13:26 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Absensi untuk merecord data absensi dari tiap karyawan yang ada">
    <meta name="keywords" content="absensi,electronic-absensi">
    <meta name="author" content="Dycodez">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>E-Absensi Login Pages | Main Pages</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&amp;display=swap" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/apexcharts/apexcharts.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/') ?>images/ic_launcher.png">
    <!-- Theme Styles -->
    <link href="<?= base_url() ?>assets/css/main.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet">

    <script src="<?= base_url() ?>assets/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <script src="<?= base_url() ?>assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>assets/js/main.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>

    <div class="page-container">
        <div class="page-header">
            <?= $this->load->view($structure['header'], '', TRUE); ?>
        </div>
        
        <?php if (@$structure['sidenav']): ?>
            <div class="page-sidebar">
                <?= $this->load->view($structure['sidenav'], '', TRUE); ?>
            </div>
        <?php endif ?>

        <div class="page-content">
            <?php @$structure['content'] ? $this->load->view($structure['content'].'', TRUE) : ''; ?>
        </div>

    </div>



    <!-- Javascripts -->
    
    
</body>

<!-- Mirrored from phantom-themes.com/circl/theme/templates/admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Jul 2021 15:14:22 GMT -->
</html>