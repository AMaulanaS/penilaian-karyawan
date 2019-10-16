<?php
date_default_timezone_set("Asia/Jakarta");

$username = "root";
$password =  "";
$database = "karyawan";
$host = "localhost";

$con = mysqli_connect($host , $username , $password );
mysqli_select_db($con, $database);

if($con  && mysqli_select_db($con, $database)) {
}
else{
    echo "<script>alert('Failed connect to database!');</script>";
}?>