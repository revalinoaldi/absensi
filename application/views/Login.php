<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from phantom-themes.com/circl/theme/templates/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Jul 2021 15:15:19 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Absensi untuk merecord data absensi dari tiap karyawan yang ada">
    <meta name="keywords" content="absensi,electronic-absensi">
    <meta name="author" content="Dycodez">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>E-Absensi Login Pages</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/') ?>images/ic_launcher.png">
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&amp;display=swap" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="<?= base_url() ?>assets/css/main.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet">

</head>
<body class="login-page">
    <!--<div class='loader'>-->
    <!--    <div class='spinner-grow text-primary' role='status'>-->
    <!--        <span class='sr-only'>Loading...</span>-->
    <!--    </div>-->
    <!--</div>-->
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 col-lg-4">
                <div class="card login-box-container">
                    <div class="card-body">
                        <div class="authent-logo">
                            <img src="<?= base_url() ?>assets/images/logo%402x.png" alt="">
                        </div>
                        <div class="authent-text">
                            <p>E-ABSENSI</p>
                            <p>Sign-in to Absen</p>
                        </div>

                        <form>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                    <label for="floatingInput">Email address</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info m-b-xs" onclick="loginCLick();" value="">
                                    <div class="d-flex justify-content-center">
                                        <span id="text-signin">Sign-in</span>
                                        <div class="spinner-border" role="status" id="spinnerLoading" hidden="">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Javascripts -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="<?= base_url() ?>assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>assets/js/main.min.js"></script>

    <script type="text/javascript">
        function setSession(val) {
            $.ajax({
                url: '<?= site_url('Login/setSession') ?>',
                method: 'POST',
                data: val,
                dataType: 'json',                   
                success: function(data){
                    if (data.result) {
                        alert(data.message)
                        window.location.href = '<?= site_url('Karyawan/Dashboard') ?>'
                    }else{
                        alert(`Error Login!`)
                    }
                }, error: (err) => {
                    alert(`Error Login 1!`)
                    console.log(err)
                }
            })
        }


        async function loginCLick() {
            event.preventDefault();

            $('#text-signin').attr('hidden',true);
            $('#spinnerLoading').removeAttr('hidden')

            let email = $('#floatingInput').val()
            let pass = $('#floatingPassword').val()
            const a = await fetch('https://api-absensi.firalcreative.my.id/Login', {
                method: 'POST',
                credentials: 'include',
                // mode: 'no-cors',
                headers: {
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                    'token': 'ASecretAccess'
                },
                body: JSON.stringify({
                    email: email,
                    pass: pass
                })
            }).then(response => response.json())
            .then(data => {
                if (data.status) {                    
                    let setData = {
                        key: data.data.key,
                        token: data.data.token,
                        data:{
                            id:data.data.id,
                            email:data.data.email,
                            nama:data.data.nama,
                            level:data.data.level,
                            exp: data.data.expire
                        },
                    };

                    setSession(setData);
                    $('#text-signin').removeAttr('hidden');
                    $('#spinnerLoading').attr('hidden',true);
                }else{
                    alert(`${data.title}\n${data.message}`)
                    $('#text-signin').removeAttr('hidden');
                    $('#spinnerLoading').attr('hidden',true);
                }
            }).catch(err => {
                alert(`Email or Password Incorrect!`)
                    $('#text-signin').removeAttr('hidden');
                    $('#spinnerLoading').attr('hidden',true);
            });
            
            
        }
    </script>
</body>

<!-- Mirrored from phantom-themes.com/circl/theme/templates/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Jul 2021 15:15:19 GMT -->
</html>