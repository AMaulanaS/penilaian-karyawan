<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}
$action = mysqli_real_escape_string($con, $_GET['action']);
if($action == "tambah-tempat"){
    $nama_tempat = mysqli_real_escape_string($con, $_POST['nama-tempat']);
    $bagian = mysqli_real_escape_string($con, $_POST['bagian']);
    $disiplin = mysqli_real_escape_string($con, $_POST['disiplin']);
    $kinerja = mysqli_real_escape_string($con, $_POST['kinerja']);
    $prilaku = mysqli_real_escape_string($con, $_POST['prilaku']);
    $kerjasama = mysqli_real_escape_string($con, $_POST['kerjasama']);
    $ketrampilan = mysqli_real_escape_string($con, $_POST['ketrampilan']);
    $deskripsi = mysqli_real_escape_string($con, $_POST['deskripsi']);

    $sql_tambah = mysqli_query($con, "INSERT INTO `tempat`(`id`, `nama`, `bagian_id`, `disiplin`, `kinerja`, `prilaku`, `kerjasama`, `ketrampilan`, `deskripsi`) VALUES (NULL ,'$nama_tempat', '$bagian', '$disiplin','$kinerja','$prilaku','$kerjasama','$ketrampilan','$deskripsi')");
    if($sql_tambah){
        $last_id = mysqli_insert_id($con);
        $return = array(
            "error" => false,
            "pesan"=> "sukses",
            "last"=> $last_id

        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);
}elseif($action == "upload-foto-tempat"){
    $id = mysqli_real_escape_string($con, $_POST['id-tempat2']);
    $nama_file = $_FILES['foto_tempat']['name'];
    $type_file = $_FILES['foto_tempat']['type'];
    $size_file = $_FILES['foto_tempat']['size'];
    $tmp_file = $_FILES['foto_tempat']['tmp_name'];
    $error_file = $_FILES['foto_tempat']['error'];
    $content_file = file_get_contents($tmp_file);
    $upload_file = "images/";
    $ext_file = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $ext_validate = array("jpeg", "jpg", "png", "gif");
    $random = mt_rand(1, 999999);
    $nama_foto = $id . "_" . $random . ".".$ext_file;

    if($error_file == UPLOAD_ERR_OK){
        if(in_array($ext_file, $ext_validate)){
            move_uploaded_file($tmp_file, $upload_file . $nama_foto);
            $insert_foto = mysqli_query($con, "INSERT INTO `foto`(`id_karyawan`, `file`) VALUES ('$id','$nama_foto')");
            if($insert_foto){
                $return = array(
                    "error" => false,
                    "pesan"=> "sukses"
                );
            }else{
                $return = array(
                    "error" => true,
                    "pesan"=> mysqli_error($con)
                );
            }
        }else{
            $return = array(
                "error" => true,
                "pesan"=> mysqli_error($con)
            );
        }
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }

    echo json_encode($return);
}elseif($action == "load-table-foto"){
    $id = mysqli_real_escape_string($con, $_POST['id-tempat2']);
    $query_load_table = mysqli_query($con, "SELECT * FROM `foto` WHERE `id_karyawan`='$id'");
    $count_foto = mysqli_num_rows($query_load_table);
    if($count_foto > 0){
        ?>
        <table class="table">
            <thead>
            <tr>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while($tampil = mysqli_fetch_array($query_load_table)){
                ?>

                <tr>
                    <td>
                        <img width="64" height="64" class="image_fade" src="images/<?php echo $tampil['file']; ?>">
                    </td>

                    <td><button id="btn-delete-foto" name="btn-delete-foto" class="button button-3d button-small nomargin fright" data-foto="<?php echo $tampil['file']; ?>" onclick="konfirmasiHapus(this);">Hapus</button></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?php
    }
}elseif($action == "hapus-foto"){
    $upload_file = "images/";
    $nama_foto = mysqli_real_escape_string($con, $_POST['nama-foto-hapus']);
    $sql_hapus_foto = mysqli_query($con, "DELETE FROM `foto` WHERE `file`='$nama_foto'");
    if($sql_hapus_foto){
        unlink($upload_file.$nama_foto);
        $return = array(
            "error" => false,
            "pesan"=> "sukses"
        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);
}elseif($action == "edit-tempat"){
    $id= mysqli_real_escape_string($con, $_POST['id-tempat1']);
    $nama_tempat = mysqli_real_escape_string($con, $_POST['nama-tempat']);
    $bagian = mysqli_real_escape_string($con, $_POST['bagian']);
    $disiplin = mysqli_real_escape_string($con, $_POST['disiplin']);
    $kinerja = mysqli_real_escape_string($con, $_POST['kinerja']);
    $prilaku = mysqli_real_escape_string($con, $_POST['prilaku']);
    $kerjasama = mysqli_real_escape_string($con, $_POST['kerjasama']);
    $ketrampilan = mysqli_real_escape_string($con, $_POST['ketrampilan']);
    $deskripsi = mysqli_real_escape_string($con, $_POST['deskripsi']);

    $sql_tambah = mysqli_query($con, "UPDATE `tempat` SET `nama`='$nama_tempat', `bagian_id`='$bagian' ,`disiplin`='$disiplin',`kinerja`='$kinerja',`prilaku`='$prilaku',`kerjasama`='$kerjasama',`ketrampilan`='$ketrampilan',`deskripsi`='$deskripsi' WHERE `id`='$id'");
    if($sql_tambah){
        $last_id = mysqli_insert_id($con);
        $return = array(
            "error" => false,
            "pesan"=> "sukses",
            "last"=> $last_id

        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);
}elseif($action == "hapus-tempat"){
    $upload_file = "images/";
    $id= mysqli_real_escape_string($con, $_POST['id-tempat']);
    $sql_foto = mysqli_query($con, "SELECT * FROM `foto` WHERE `id_karyawan`='$id'");
    $query_hapus_tempat = mysqli_query($con, "DELETE FROM `tempat` WHERE `id`='$id'");

    while($hapus_foto = mysqli_fetch_array($sql_foto)){
        $file = $hapus_foto['file'];
        unlink($upload_file.$file);
        $sql_hapus_foto = mysqli_query($con, "DELETE FROM `foto` WHERE `file`='$file'");
        if($sql_hapus_foto){
            $return = array(
                "error" => false,
                "pesan"=> "sukses"
            );
        }else{
            $return = array(
                "error" => true,
                "pesan"=> mysqli_error($con)
            );
        }
    }

    if($query_hapus_tempat){
        $return = array(
            "error" => false,
            "pesan"=> "sukses"
        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }

    echo json_encode($return);
}elseif($action == "pilih-tempat"){
    print_r($_POST);
}elseif($action == "login"){
    $username = mysqli_real_escape_string($con, $_POST['login-form-username']);
    $password = mysqli_real_escape_string($con, $_POST['login-form-password']);


    if(!empty($username) && !empty($password)){
        $password_md5 = md5($password);
        $query_login = mysqli_query($con, "SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password_md5'");
        $count_login = mysqli_num_rows($query_login);
        if($count_login == 1){
            if($result_login = mysqli_fetch_assoc($query_login)){
                $status = $result_login['status'];
                $uid = $result_login['id'];
                $uname = $result_login['username'];
                if(!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['id']= $uid;
                $_SESSION['username'] = $uname;
                $_SESSION['status'] = $status;

                $return = array(
                    "error" => false,
                    "pesan"=> "sukses"
                );
            }
        }else{
            $return = array(
                "error" => true,
                "pesan"=> mysqli_error($con)
            );
        }

    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);

}elseif($action == "register"){
    $username = mysqli_real_escape_string($con, $_POST['register-form-username']);
    $nama_lengkap = mysqli_real_escape_string($con, $_POST['register-form-name']);
    $email = mysqli_real_escape_string($con, $_POST['register-form-email']);
    $password = mysqli_real_escape_string($con, $_POST['register-form-password']);
    $status = '1';

    if(!empty($username) && !empty($nama_lengkap) && !empty($email) && !empty($password)){
        $password_md5 = md5($password);
        $query_register = mysqli_query($con, "INSERT INTO `user`(`username`, `nama_lengkap`, `email`, `password`, `status`) VALUES ('$username','$nama_lengkap','$email','$password_md5','$status')");
        if($query_register){
            $return = array(
                "error" => false,
                "pesan"=> "sukses"
            );
        }else{
            $return = array(
                "error" => true,
                "pesan"=> mysqli_error($con)
            );
        }
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);
}elseif($action=="logout"){
    if(!isset($_SESSION)) {
        session_start();
    }
    session_destroy();
    echo "<script>alert('Logout Berhasil!'); window.location ='login.php' </script>";
}
?>