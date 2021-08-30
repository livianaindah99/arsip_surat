<?php
    include 'db.php';
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
    <div class="judul">
        <br><h2>Arsip Surat</h2>
        <br><p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.</p>
        <p>Klik "Lihat" pada kolom aksi untuk menampilkan surat.</p>
    </div>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Surat" class="box-cari" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kategori" value="<?php echo $_GET['kategori'] ?>">
                <input type="submit" name="cari" value="Cari Surat" class="btn-cari">
            </form>
        </div>
    </div>

    <!-- content -->
    <div class="section">
        <div class="container">
            <div class="box">
            <?php
                    $surat = mysqli_query($conn, "SELECT * FROM tb_surat ORDER BY id DESC");
                    if (mysqli_num_rows($surat) > 0) {
                        while($s = mysqli_fetch_array($surat)) { 
                ?>
                <?php }} else { ?>
                    <p>Data tidak ada</p>
                <?php } ?>
               <table border="1" cellspacing="0" class="table">
                   <thead>
                       <tr>
                            <th width="150px">No Surat</th>
                            <th width="150px">Kategori</th>
                            <th width="150px">Judul</th>
                            <th width="180px">Waktu Pengarsipan</th>
                            <th width="245px">Aksi</th>                          
                       </tr>
                   </thead>
                   <tbody>
                   <?php
                            $no = 1;
                            $surat = mysqli_query($conn, "SELECT * FROM tb_surat LEFT JOIN tb_kategori USING(kategori_id) ORDER BY id DESC");
                            if(mysqli_num_rows($surat) > 0) {
                            while($row = mysqli_fetch_array($surat)){
                       ?>
                       <tr>
                           <td><?php echo  $row['no_surat'] ?></td>
                           <td><?php echo  $row['jenis_kategori'] ?></td>
                           <td><?php echo  $row['judul'] ?></td>
                           <td><?php echo  $row['waktu_arsip'] ?></td>
                           <td>
                               <a href="unduh-surat.php?file=surat/<?=$row['file_surat']?>" class="btn-unduh">Unduh</a> <a href="proses-hapus.php?ids=<?php echo $row['id'] ?>" class="btn-hapus" onclick="return confirm('Apakah anda yakin ingin menghapus arsip surat ini?')">Hapus</a> <a href="detail-surat.php?id=<?php echo $row['id'] ?>" class="btn-detail">Lihat>></a>
                           </td>
                       </tr>
                       <?php }} else { ?>
                           <tr>
                               <td colspan="8">Tidak Ada Data</td>
                           </tr>
                       <?php } ?>
                   </tbody>
               </table>
            </div>
        </div>
    </div>

    <p><a href="arsipkan-surat.php" class="btn">Arsipkan Surat</a></p>
    <section></section>

</body>
</html>