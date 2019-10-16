<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['username']) || $_SESSION['status'] > 0){
    session_destroy();
    header('Location: login.php');
}

?>
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

    <!-- Bootstrap Data Table Plugin -->
    <link rel="stylesheet" href="css/components/bs-datatable.css" type="text/css" />

    <!-- Select-Boxes CSS -->
    <link rel="stylesheet" href="css/components/select-boxes.css" type="text/css" />

    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title>Daftar Karyawan | SPK Karyawan</title>

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
            <h1>Daftar Karyawan</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Daftar Karyawan</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="table-responsive">
                    <table id="daftar-tempat" name="daftar-tempat" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>bagian</th>
                            <th>Nama Karyawan</th>
                            <th>disiplin</th>
                            <th>kinerja</th>
                            <th>prilaku Tersedia</th>
                            <th>kerjasama</th>
                            <th>ketrampilan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No</th>
                            <th>bagian</th>
                            <th>Nama Karyawan</th>
                            <th>Disiplin</th>
                            <th>Harga kinerja</th>
                            <th>prilaku</th>
                            <th>kerjasama</th>
                            <th>ketrampilan</th>
                            <th>Aksi</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $no=0;
                        $sql_tempat = mysqli_query($con, "SELECT a.*, b.bagian FROM `tempat` AS a LEFT JOIN `bagian` AS b ON a.bagian_id=b.bagian_id");
                        while ($tampil = mysqli_fetch_array($sql_tempat)){
                            $no++;
                            $bintang = "<i class=\"icon icon-line-star small\"></i>";
                            $disiplin = $tampil['disiplin'];
							$kinerja = $tampil['kinerja'];
							$prilaku = $tampil['prilaku'];
                            $kerjasama = $tampil['kerjasama'];
                            $ketrampilan = $tampil['ketrampilan'];
                            ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><a href="tempat.php?lihat=<?php echo $tampil['id']; ?>" target="_blank"><?php echo $tampil['bagian']; ?></a></td>
                            <td><a href="tempat.php?lihat=<?php echo $tampil['id']; ?>" target="_blank"><?php echo $tampil['nama']; ?></a></td>
                            <td><?php for($x=0; $x<$disiplin; $x++){echo $bintang;} ?></td>
							<td><?php for($x=0; $x<$kinerja; $x++){echo $bintang;} ?></td>
                            <td><?php for($x=0; $x<$prilaku; $x++){echo $bintang;} ?></td>
                            <td><?php for($x=0; $x<$kerjasama; $x++){echo $bintang;} ?></td>
                            <td><?php for($x=0; $x<$ketrampilan; $x++){echo $bintang;} ?></td>
                            <td>
                                <select style="width: 80pt;" id="action-tempat" name="action-tempat" class="select-hide form-control bottommargin-sm">
                                    <option value="" disabled="disabled" selected>-Pilih-</option>
                                    <option value="edit-tempat" data-tempat="<?php echo $tampil['id']; ?>" data-nama="<?php echo $tampil['nama']; ?>">Ubah Data</option>
                                    <option value="hapus-produk" data-tempat="<?php echo $tampil['id']; ?>" data-nama="<?php echo $tampil['nama']; ?>">Hapus Data</option>
                                </select>
                            </td>
                        </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>

                <!-- MODAL -->

                <div id="konfirmasi-hapus-tempat" name="konfirmasi-hapus-tempat" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Hapus Karyawan</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="nobottommargin">Ingin Menghapus Karyawan?</p>
                                </div>
                                <div class="modal-footer">

                                    <form id="form-hapus-tempat" name="form-hapus-tempat" action="" method="post">
                                        <input id="id-tempat" name="id-tempat" type="hidden" value="">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

                <!-- Notifikasi Area -->
                <div id="notifikasi-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal mengubah!"></div>
                <div id="notifikasi-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil diubah!"></div>

                <div id="notifikasi-hapus-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal Menghapus!"></div>
                <div id="notifikasi-hapus-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil dihapus!"></div>

                <!-- End Notifikasi Area -->

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

<!-- Bootstrap Data Table Plugin -->
<script type="text/javascript" src="js/components/bs-datatable.js"></script>


<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="js/functions.js"></script>
<script>

    $(".select-hide").select2({
        minimumResultsForSearch: Infinity
    });
    $(document).ready(function() {
        $("#daftar-tempat").dataTable();
    });

    $(".select-hide").change(function () {
        var value = $(this).find("option:selected").attr("value");
        var data_tempat = $(this).find("option:selected").data("tempat");
        var data_nama_tempat = $(this).find("option:selected").data("nama");

        switch (value){
            case "edit-tempat":
                location.replace('tambah-karyawan.php?ubah='+data_tempat);
                break;
            case "hapus-produk":
                $("#id-tempat").val(data_tempat);
                $("#konfirmasi-hapus-tempat").modal("show");
                break;
        }
    });
    

    $("#form-hapus-tempat").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=hapus-tempat",
            data: $(this).serialize(),
            success: function (response) {
                $("#konfirmasi-hapus-tempat").modal("hide");

                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-hapus-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-hapus-sukses"));
                }
                //setTimeout(location.reload.bind(location), 3000);
            },
            error: function (error) {

                $("#konfirmasi-hapus-tempat").modal("hide");
                SEMICOLON.widget.notifications($("#notifikasi-hapus-gagal"));
            }
        });
    });

</script>

</body>
</html>