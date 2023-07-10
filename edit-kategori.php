<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="admin.php"</script>';
    }
    $kategori = mysqli_query($koneksi, "SELECT * FROM tb_category WHERE category_id = '".$_GET['id']."'");
    if(mysqli_num_rows($kategori) == 0){
        echo '<script>window.location="data-kategori.php"</script>';
    }
    $k = mysqli_fetch_object($kategori);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> login | TokoKu </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>

<body >
    <!-- header -->
    <header>
        <div class="container">
            <div class="header-logo">
             <a href="dashboard.php"><img src="https://storage.googleapis.com/tokoku/assets/logo.png" href="dashboard.php" class="logo">
             </a>
            </div>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- Content -->
    <div class="section">
        <div class= "container">
            <h3>Edit Data Kategori</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $k->category_name ?>" required>
                    <input type="submit" name="submit" value="Simpan Kategori" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){
                        $nama = ucwords($_POST['nama']);

                        $update = mysqli_query($koneksi, "UPDATE tb_category SET
                                                category_name = '".$nama."'
                                                WHERE category_id = '".$k->category_id."' ");

                        if($update){
                            echo '<script>alert("Edit Data Berhasil!")</script>';
                            echo '<script>window.location="data-kategori.php"</script>';
                        }else{
                            echo 'gagal ' .mysqli_error($koneksi);
                        }
                    }
                ?>
                
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