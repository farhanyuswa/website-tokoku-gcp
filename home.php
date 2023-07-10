<?php 
    include 'db.php';
    $kontak = mysqli_query($koneksi, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> TokoKu </title>
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

    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!-- category -->
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php 
                    $kategori = mysqli_query($koneksi, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                 
                ?>
                    <a href="produk.php?kat=<?php echo $k['category_id'] ?>">
                        <div class="col-5">
                            <img src= "https://storage.googleapis.com/tokoku/assets/category.png" width="55px" style="margin-bottom:1px;">
                            <p><?php echo $k['category_name'] ?></p>
                        </div>
                    </a>

                <?php }}else{ ?>
                    <p>Kategori Tidak Ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- new product -->
    <div class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php 
                    $produk = mysqli_query($koneksi, "SELECT * FROM tb_product ORDER BY product_id DESC LIMIT 8");
                    if(mysqli_num_rows($produk) >0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                    <a href="detail-produk.php?id=<?php echo $p['product_id']?>">
                        <div class="col-4">
                            <img src="produk/<?php echo $p['product_image'] ?>">
                            <p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
                            <p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Produk Tidak Ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->admin_address ?></p>

            <h4>Email</h4>
            <p><?php echo $a->admin_email ?></p>

            <h4>Nomer Hp</h4>
            <p><?php echo $a->admin_telp ?></p>

            <small>Copyright &copy; 2023 - Tokoku.</small>
        </div>
    </div>
</body>

</html>