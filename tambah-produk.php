<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> login | TokoKu </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
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
            <h3>Tambah Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--pilih--</option>
                        <?php 
                            $kategori = mysqli_query($koneksi, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){  
                        ?>
                        <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name']?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea> <br>
                    <select class="input-control" name="status" required>
                        <option value="">--pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Simpan" class="btn">
                </form>
                <?php 
 
                    if(isset($_POST['submit'])){
                        //print_r($_FILES['gambar']);
                        // Menampung inputan dari form
                        $kategori    = $_POST['kategori'];
                        $nama        = $_POST['nama'];
                        $harga       = $_POST['harga'];
                        $deskripsi   = $_POST['deskripsi'];
                        $status      = $_POST['status'];

                        //Menampung data file yang di upload
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'produk'.time().'.'.$type2;

                        //Menampung data format file yang diizinkan
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif', 'bmp');

                        // Validasi format file
                        if(!in_array($type2, $tipe_diizinkan)){

                            // Jika format file tidak ada didalam array

                            echo '<script>alert("Format file tidak diizinkan!")</script>';

                        }else{
                            // Jika format file sesuai yang diizinkan
                            //proses upload
                            move_uploaded_file($tmp_name, './produk/'.$newname);
                            $insert = mysqli_query($koneksi, "INSERT INTO tb_product VALUES (null, '".$kategori."','".$nama."','".$harga."','".$deskripsi."','".$newname."','".$status."',null ) ");
                            if($insert){
                                echo '<script>alert("Tambah Produk Berhasil!")</script>';
                                echo '<script>window.location="data-produk.php"</script>';
                            }else{
                                echo 'gagal ' .mysqli_error($koneksi);
                            }

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

    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>

</html>