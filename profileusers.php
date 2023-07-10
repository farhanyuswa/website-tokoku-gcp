<?php
session_start();

include("db.php");

// Memeriksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit();
}

// Mendapatkan informasi pengguna dari session
$email = $_SESSION['valid'];
$username = $_SESSION['username'];
$age = $_SESSION['age'];
$nohp = $_SESSION['noho'];

// Memperbarui profil pengguna
if (isset($_POST['submit'])) {
    $newUsername = mysqli_real_escape_string($koneksi, $_POST['username']);
    $newAge = mysqli_real_escape_string($koneksi, $_POST['age']);
    $newNohp = mysqli_real_escape_string($koneksi, $_POST['nohp']);

    // Memperbarui informasi pengguna di database
    $updateQuery = "UPDATE users SET Username='$newUsername', Age='$newAge', Nohp='$newNohp' WHERE Email='$email'";
    mysqli_query($koneksi, $updateQuery);

    // Memperbarui informasi pengguna di session
    $_SESSION['username'] = $newUsername;
    $_SESSION['age'] = $newAge;
    $_SESSION['noho'] = $newNohp;

    if($updateQuery){
        echo '<script>alert("Ubah Data Berhasil!")</script>';
        echo '<script>window.location="profileusers.php"</script>';
    }else{
        echo 'gagal ' .mysqli_error($koneksi);
    }
}

// Mengubah kata sandi pengguna
if (isset($_POST['ubah_password'])) {
    $newPassword = mysqli_real_escape_string($koneksi, $_POST['new_password']);
    $confirmPassword = mysqli_real_escape_string($koneksi, $_POST['confirm_password']);

    // Memeriksa kecocokan kata sandi saat ini
    $passwordQuery = "SELECT Password FROM users WHERE Email='$email'";
    $passwordResult = mysqli_query($koneksi, $passwordQuery);
    $row = mysqli_fetch_assoc($passwordResult);
    // Memeriksa kecocokan kata sandi baru dan konfirmasi kata sandi
    if ($newPassword === $confirmPassword) {
        // Menghasilkan hash kata sandi baru
        $newPassword;
        // Memperbarui kata sandi pengguna di database
        $updateQueryy = "UPDATE users SET Password='$newPassword' WHERE Email='$email'";
        mysqli_query($koneksi, $updateQueryy);
        if($updateQueryy){
            echo '<script>alert("Ubah Data Berhasil!")</script>';
            echo '<script>window.location="profileusers.php"</script>';
        }else{
                echo 'gagal ' .mysqli_error($koneksi);
            }
    } else {
        // Menampilkan pesan kesalahan jika kata sandi baru dan konfirmasi tidak cocok
        echo "<div class='message'>New password and confirm password do not match.</div>";
    }

}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Profile | TokoKu </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>


<body >
    <!-- header -->
    <header>
        <div class="container">
            <div class="header-logo">
             <a href="home.php"><img src="https://storage.googleapis.com/tokoku/assets/logo.png" class="logo">
             </a>
            </div>
            <ul>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="profileusers.php">Profil</a></li>
                <li><a href="keluaruser.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- Content -->
    <div class="section">
        <div class= "container">
            <h3>Profil</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="username" placeholder="Username" class="input-control" id="username" value="<?php echo $username; ?>" required>
                    <input type="text" name="nohp" placeholder="No HP" class="input-control" id="nohp" value="<?php echo $nohp; ?>" required>
                    <input type="text" name="email" placeholder="Email" class="input-control" id="email" value="<?php echo $email; ?>" readonly>
                    <input type="text" name="age" placeholder="Umur" class="input-control" id="age" value="<?php echo $age; ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>
            </div>

            <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name='new_password' id='new_password' placeholder="Password Baru" autocomplete='off' class="input-control" required>
                    <input type="password" name='confirm_password' placeholder="Konfirmasi Password" id='confirm_password' autocomplete='off' class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                </form>
            </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2023 - Tokoku.</small>
        </div>
    </footer>
</body>

</html>