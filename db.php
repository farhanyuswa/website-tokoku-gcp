<?php
    $host = "34.128.80.144";
    $username = "root";
    $password = "ab234";
    $database = "db_tokoku";

    // Membuat koneksi ke database
    $koneksi = mysqli_connect($host, $username, $password, $database);

    // Memeriksa koneksi
    if (!$koneksi) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
    
?>
