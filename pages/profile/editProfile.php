<?php
include("../../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idDokter = $_POST['idDokter'];
    // Ambil nilai dari form
    $nama = $_POST["nama"];
    $no_hp = $_POST["no_hp"];
    $alamat = $_POST['alamat'];

    $query = "UPDATE dokter SET 
    nama = '$nama', 
    no_hp = '$no_hp',
    alamat = '$alamat'
    WHERE id = '$idDokter'";

    // Eksekusi query
    if (mysqli_query($mysqli, $query)) {
        echo '<script>';
        echo 'alert("Data dokter berhasil diubah!");';
        echo 'window.location.href = "../../profile.php";';
        echo '</script>';
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
    
}
mysqli_close($mysqli);
?>