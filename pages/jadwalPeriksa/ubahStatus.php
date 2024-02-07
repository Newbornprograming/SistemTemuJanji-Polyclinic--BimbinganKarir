<?php
include '../../config/koneksi.php';
session_start();

    $id = $_GET['id'];
    $status = $_GET['status'];

    if($status == '1'){
        $queryUbahStatus = mysqli_query($mysqli,"UPDATE jadwal_periksa SET status = '0' WHERE id = '$id'");

        if ($queryUbahStatus) {
            echo '<script>alert("Jadwal tidak aktif");window.location.href="../../jadwalPeriksa.php";</script>';
        }
        else{
            echo '<script>alert("Error");window.location.href="../../jadwalPeriksa.php";</script>';
        }
    }
    else if ($status == '0') {
        $queryUbahStatus = mysqli_query($mysqli,"UPDATE jadwal_periksa SET status = '1' WHERE id = '$id'");
        
        if ($queryUbahStatus) {
            echo '<script>alert("Jadwal aktif");window.location.href="../../jadwalPeriksa.php";</script>';
        }
        else{
            echo '<script>alert("Error");window.location.href="../../jadwalPeriksa.php";</script>';
        }
    }

mysqli_close($mysqli);
?>