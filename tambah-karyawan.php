<!DOCTYPE html>
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) || $_SESSION['status'] > 0){
    session_destroy();
    header('Location: login.php');
}
if(isset($_GET['ubah'])){
    $id= mysqli_real_escape_string($con, $_GET['ubah']);
    $selected_default = "";
    $selected = "selected=\"selected\"";
    $sql_cari = mysqli_query($con, "SELECT * FROM `tempat` WHERE `id`='$id'");
    if(mysqli_num_rows($sql_cari) > 0){
        if($tampil_ubah = mysqli_fetch_assoc($sql_cari)){
            $nama = $tampil_ubah['nama'];
            $bagian = $nama = $tampil_ubah['bagian_id'];
            $disiplin = $tampil_ubah['disiplin'];
            $kinerja = $tampil_ubah['kinerja'];
            $prilaku = $tampil_ubah['prilaku'];
            $kerjasama = $tampil_ubah['kerjasama'];
            $ketrampilan = $tampil_ubah['ketrampilan'];
            $deskripsi = $tampil_ubah['deskripsi'];
            $lock_start = "/*";
            $lock_end = "*/";
            $url = "action.php?action=edit-tempat";
            $judul = "Edit Karyawan";
        }
    }
}else{
    $id = "";
    $selected_default = "selected=\"selected\"";
    $nama = "";
    $bagian = "";
    $disiplin = "";
    $kinerja = "";
    $prilaku = "";
    $kerjasama = "";
    $ketrampilan = "";
    $deskripsi = "";
    $lock_start = "";
    $lock_end = "";
    $url= "action.php?action=tambah-tempat";
    $judul = "Tambah Karyawan";

}
?>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="AMaulanaS" />

    <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="css/dark.css" type="text/css" />
    <link rel="stylesheet" href="css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

    <!-- Select-Boxes CSS -->
    <link rel="stylesheet" href="css/components/select-boxes.css" type="text/css" />

    <!-- Bootstrap File Upload CSS -->
    <link rel="stylesheet" href="css/components/bs-filestyle.css" type="text/css" />

    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title><?php echo $judul; ?> |SPK Karyawan</title>

</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Header
    ============================================= -->
    <?php include "header.php"; ?>
    <!-- #header end -->

    <!-- Page Title
    ============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1><?php echo $judul; ?></h1>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active"><?php echo $judul; ?></li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="tabs tabs-alt tabs-tb clearfix" id="tab-tempat">
                    <ul class="tab-nav clearfix">
                        <li><a href="#detail-tempat">Detail</a></li>
                        <li><a href="#foto-tempat-tab">Foto</a></li>
                    </ul>

                    <div class="tab-container">
                        <div class="tab-content clearfix" id="detail-tempat">
                            <form id="form-detail-tempat" name="form-detail-tempat" action="" method="post">
                                <div class="col_full">
                                    <label>Nama Karyawan :</label>
                                    <input type="hidden" name="id-tempat1" id="id-tempat1" value="<?php echo $id; ?>">
                                    <input name="nama-tempat" id="nama-tempat" class="form-control" placeholder="Masukan Nama Tempat" value="<?php echo $nama; ?>" required>
                                </div>
                                <div class="col_full">
                                    <label>bagian :</label>
                                    <select id="bagian" name="bagian" class="select-hide form-control bottommargin-sm">
                                        <option value="" disabled="disabled" <?php echo $selected_default; ?>>-Pilih bagian-</option>
                                        <?php
                                        $sql_bagian = mysqli_query($con, "SELECT * FROM `bagian`");
                                        while($tampil_bagian = mysqli_fetch_array($sql_bagian)){
                                        ?>
                                            <option value="<?php echo $tampil_bagian['bagian_id']; ?>" <?php if($bagian==$tampil_bagian['bagian_id']){echo $selected;} ?>><?php echo $tampil_bagian['bagian']; ?></option>
                                        <?php }?>

                                    </select>
                                </div>
                                <div class="col_half">
                                    <label>disiplin :</label>
                                    <input name="disiplin" type="number" id="disiplin" class="form-control" placeholder="Masukan nilai disiplin" min="1" max="10" value="<?php echo $disiplin; ?>" required>
                                </div>
                                <div class="col_half col_last">
                                    <label>kinerja :</label>
                                    <input name="kinerja" type="number" id="kinerja" class="form-control" placeholder="Masukan nilai kinerja" min="0" max="10" value="<?php echo $kinerja; ?>" required>
                                </div>
                                <div class="col_one_third">
                                    <label>prilaku :</label>
                                    <input name="prilaku" type="number" id="prilaku" class="form-control" placeholder="prilaku  (1 - 10)" min="1" max="10" value="<?php echo $prilaku; ?>" required>
                                </div>
                                <div class="col_one_third">
                                    <label>kerjasama :</label>
                                    <input name="kerjasama" type="number" id="kerjasama" class="form-control" placeholder="kerjasama  (1 - 10)" min="1" max="10" value="<?php echo $kerjasama; ?>" required>
                                </div>
                                <div class="col_one_third col_last">
                                    <label>ketrampilan :</label>
                                    <input name="ketrampilan" type="number" id="ketrampilan" class="form-control" placeholder="ketrampilan  (1 - 10)" min="1" max="10" value="<?php echo $ketrampilan; ?>" required>
                                </div>
                                <div class="col_full">
                                    <label>Deskripsi Karyawan :</label>
                                    <textarea id="deskripsi" name="deskripsi" class="form-control" placeholder="Masukan Deskripsi Mengenai Karyawan."><?php echo $deskripsi; ?></textarea>
                                </div>
                                <div class="coll_full nobottommargin">
                                    <button id="submit" name="submit" class="button button-3d button-black nomargin" value="submit">Submit</button>
                                </div>
                            </form>

                            <!-- Notifikasi Area -->
                            <div id="notifikasi-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal menambahkan!"></div>
                            <div id="notifikasi-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil ditambahkan!"></div>

                            <div id="notifikasi-hapus-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal Menghapus!"></div>
                            <div id="notifikasi-hapus-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil dihapus!"></div>
                            <!-- End -->
                        </div>
                        <div class="tab-content clearfix" id="foto-tempat-tab">
                            <form id="form-foto-tempat" name="form-foto-tempat" action="#" method="POST" enctype="multipart/form-data">
                                <div class="col_half">
                                    <label>Pilih Gambar :</label>
                                    <input type="hidden" name="id-tempat2" id="id-tempat2" value="<?php echo $id; ?>">
                                    <div id="foto-div">
                                        <input id="foto_tempat" name="foto_tempat" type="file" class="file" accept="image/*">
                                    </div>
                                </div>
                            </form>
                            <div id="table-foto">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>
                <!-- MODAL -->
                <div id="konfirmasi-hapus" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Hapus Foto</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="nobottommargin">Ingin Menghapus Foto?</p>
                                </div>
                                <div class="modal-footer">

                                    <form id="form-foto-hapus" name="form-foto-hapus" action="#" method="post">
                                        <input id="nama-foto-hapus" name="nama-foto-hapus" type="hidden" value="">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

            </div>

        </div>

    </section><!-- #content end -->

    <!-- Footer
    ============================================= -->
    <?php include "footer.php"; ?>
    <!-- #footer end -->

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- External JavaScripts
============================================= -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>

<!-- Select-Boxes Plugin -->
<script type="text/javascript" src="js/components/select-boxes.js"></script>

<!-- Bootstrap File Upload Plugin -->
<script type="text/javascript" src="js/components/bs-filestyle.js"></script>

<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" language="JavaScript">

    $(".select-hide").select2({
        minimumResultsForSearch: Infinity
    });

    $(document).ready(function() {
        loadTableFoto();
    });

    function loadTableFoto() {
        $.ajax({
            type : "POST",
            dataType : "HTML",
            url : "action.php?action=load-table-foto",
            data: $("#form-foto-tempat").serialize(),
            success:function (response) {
                $("#table-foto").html(response);
            }
        });
    }

    function konfirmasiHapus(file) {
        $("#konfirmasi-hapus").modal("show");
        var foto = file.getAttribute("data-foto");
        $("#nama-foto-hapus").val(foto);
    }

    $("#form-foto-hapus").submit(function (event) {
        event.preventDefault();
        $("#konfirmasi-hapus").modal("hide");
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=hapus-foto",
            data: $(this).serialize(),
            success: function (response) {

                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-hapus-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-hapus-sukses"));
                }

                loadTableFoto();
            },
            error: function (error) {
                SEMICOLON.widget.notifications($("#notifikasi-hapus-gagal"));
                loadTableFoto();
            }
        });
    });

    $("#form-detail-tempat").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "<?php echo $url; ?>",
            data: $(this).serialize(),
            success: function (response) {

                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-sukses"));
                }
                loadTableFoto();
                $("#id-tempat1").val(response.last);
                $("#id-tempat2").val(response.last);
            },
            error: function (error) {
                alert(error.responseText);
                SEMICOLON.widget.notifications($("#notifikasi-gagal"));
            }

        });
    });

    $("#form-foto-tempat").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "action.php?action=upload-foto-tempat",
            data : new FormData(this),
            contentType :false,
            cache : false,
            processData : false,
            success:function (response) {
                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-sukses"));
                }
                document.getElementById("form-foto-tempat").reset();
                loadTableFoto();
            },
            error: function (error) {
                SEMICOLON.widget.notifications($("#notifikasi-gagal"));
            }
        });
    });
</script>
</body>
</html>