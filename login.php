<!DOCTYPE html>
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}
if (!empty($_SESSION['username'])){
    header('Location: index.php');
}else{
    session_destroy();
}
?>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="AMaulanaS" />


    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="css/dark.css" type="text/css" />
    <link rel="stylesheet" href="css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <title>Selamat datang | SPK Karyawan</title>

</head>

<body class="stretched">

<div id="wrapper" class="clearfix">

    <?php
    include ("header.php");
    ?>
	
    <section id="page-title">
        <div class="container clearfix">
            <h1>Login</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Masuk</li>
            </ol>
        </div>

    </section>

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="accordion accordion-lg divcenter nobottommargin clearfix" style="max-width: 550px;">

                    <div class="acctitle"><i class="acc-closed icon-lock3"></i><i class="acc-open icon-unlock"></i>Masuk ke Akun Anda</div>
                    <div class="acc_content clearfix">
                        <form id="login-form" name="login-form" class="nobottommargin" action="#" method="post">
                            <div class="col_full">
                                <label for="login-form-username">Username:</label>
                                <input type="text" id="login-form-username" name="login-form-username" value="" class="form-control" />
                            </div>

                            <div class="col_full">
                                <label for="login-form-password">Password:</label>
                                <input type="password" id="login-form-password" name="login-form-password" value="" class="form-control" />
                            </div>

                            <div class="col_full nobottommargin">
                                <button class="button button-3d button-black nomargin" id="login-form-submit" name="login-form-submit" value="login">Masuk</button>
                            </div>
                        </form>
                    </div>

                    <div class="acctitle"><i class="acc-closed icon-user4"></i><i class="acc-open icon-ok-sign"></i>Member Baru? Buat Akun</div>
                    <div class="acc_content clearfix">
                        <form id="register-form" name="register-form" class="nobottommargin" action="#" method="post">
                            <div class="col_full">
                                <label for="register-form-username">Username:</label>
                                <input type="text" id="register-form-username" name="register-form-username" value="" class="form-control" />
                            </div>

                            <div class="col_full">
                                <label for="register-form-name">Nama Lengkap:</label>
                                <input type="text" id="register-form-name" name="register-form-name" value="" class="form-control" />
                            </div>

                            <div class="col_full">
                                <label for="register-form-email">Email:</label>
                                <input type="text" id="register-form-email" name="register-form-email" value="" class="form-control" />
                            </div>

                            <div class="col_full">
                                <label for="register-form-password">Password:</label>
                                <input type="password" id="register-form-password" name="register-form-password" value="" class="form-control" />
                            </div>

                            <div class="col_full nobottommargin">
                                <button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register">Daftar Sekarang</button>
                            </div>
                        </form>
                    </div>

                </div>

                <!-- Notifikasi Area -->
                <div id="notifikasi-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal Masuk!"></div>
                <div id="notifikasi-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil Masuk!"></div>

                <div id="notifikasi-gagal-daftar" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal Daftar!"></div>
                <div id="notifikasi-sukses-daftar" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil Daftar!"></div>

            </div>
        </div>
    </section>

 
    <?php include("footer.php"); ?>

</div>
<div id="gotoTop" class="icon-angle-up"></div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script>
    $("#login-form").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=login",
            data: $(this).serialize(),
            success: function (response) {
                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-sukses"));
                    setTimeout(location.reload.bind(location), 3000);
                }
            },
            error: function (error) {

                $("#edit-stok").modal("hide");
                SEMICOLON.widget.notifications($("#notifikasi-gagal"));
            }
        });
    });

    $("#register-form").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=register",
            data: $(this).serialize(),
            success: function (response) {
                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-gagal-daftar"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-sukses-daftar"));
                }
            },
            error: function (error) {

                $("#edit-stok").modal("hide");
                SEMICOLON.widget.notifications($("#notifikasi-gagal-daftar"));
            }
        });
    });
</script>

</body>
</html>