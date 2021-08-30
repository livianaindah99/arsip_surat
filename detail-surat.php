<?php
    error_reporting(0);
    include 'db.php';
    
    $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori WHERE kategori_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($kategori);

    $surat = mysqli_query($conn, "SELECT * FROM tb_surat WHERE id = '".$_GET['id']."' ");
    $s = mysqli_fetch_object($surat);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARSIP SURAT</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <input type="checkbox" id="check">
    <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
        <header>MENU</header>
        <ul>
            <li><a href="index.php"><i class="fas fa-star"></i>Arsip</a></li>
            <li><a href="about.php"><i class="fas fa-info-circle"></i>About</a></li>
        </ul>
    </div>

     <!-- detail produk -->
     <div class="section">
        <div class="container">
            <h3>Arsip Surat >> Lihat</h3>
            <div class="box">
                <div class="col-2">
                    <h4>No Surat : <?php echo $s->no_surat ?></h4>
                    <h4>Judul : <?php echo $s->judul ?></h4>
                    <h4>Kategori : <?php echo $p->kategori_id ?></h4>
                    <h4>Waktu Unggah : <?php echo $s->waktu_arsip ?></h4>
                    <div class="col-2">  
                        <object data="surat/<?php echo $s->file_surat ?>" width="600" height="700"></object>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p><a href="index.php" class="btn">Kembali</a></p>
    <p><a href="edit-surat.php?id=<?php echo $row['id'] ?>" class="btn-edit">Edit/Ganti File</a></p>
    <p><a href="unduh-surat.php?file=<?=$row['file_surat']?>" class="btn-unduh2">Unduh</a></p>
</body>
</html>