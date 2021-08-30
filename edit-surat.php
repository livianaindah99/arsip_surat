<?php
    error_reporting(0);
    include 'db.php';

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

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Edit Surat</h3>
            <div class="box">
            <form action="" method="POST" enctype="multipart/form-data">
                    <label for="fname">Nomor Surat</label>
                    <input type="text" name="no_surat" class="input-control" placeholder="Nomor Surat" value="<?php echo $s['no_surat'] ?>">
                    <label for="fname">Kategori</label>
                    <select class="input-control" name="jenis_kategori">
                        <option value="">--Pilih--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori_id DESC");
                            while($r = mysqli_fetch_array($kategori)) {
                        ?>
                        <option value="<?php echo $r['kategori_id'] ?>"><?php echo $r['jenis_kategori'] ?></option>
                        <?php } ?>
                    </select>
                    <br><label for="fname">Judul</label>
                    <input type="text" name="judul" class="input-control" placeholder="Judul" value="<?php echo $s->judul ?>">
                   
                    <label for="fname">File Surat (PDF)</label>
                    <input type="file" name="file_surat" class="input-control" value="<?php echo $s->file_surat ?>" required>
                    
                    <br><input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])) {
                        //menampung data inputan form
                        $nosurat   = $_POST['no_surat'];
                        $judul     = $_POST['judul'];
                        $kategori  = $_POST['jenis_kategori'];
                        $filesurat = $_POST['file_surat'];

                        //menampung data gambar yg baru
                        $filename = $_FILES['file_surat']['name'];
                        $tmp_name = $_FILES['file_surat']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'surat'.time().'.'.$type2;

                        //menampung data format file yg diizinkan
                        $tipe_diizinkan = array('pdf');

                        //validasi jika admin ganti gambar apa yg dilakukan
                        if ($filename != '') {
                            if(!in_array($type2, $tipe_diizinkan)) {
                                echo '<script>alert("Format file tidak diizinkan")</script>';
                            } else {
                                //hapus gambar lama
                                unlink('./surat/'.$filesurat);
                                //ganti gambar baru
                                move_uploaded_file($tmp_name, './surat/'.$newname);
                                $namasurat = $newname;
                            }

                        } else {
                            //jika admin tdk ganti gambar
                            $namasurat = $filesurat;
                        }
                        
                        //query update data produk sayur
                        $update = mysqli_query($conn, "UPDATE tb_surat SET
                                        no_surat = '".$nosurat."',
                                        kategori_id = '".$kategori."',
                                        judul = '".$judul."',
                                        file_surat = '".$namasurat."'
                                        WHERE id = '".$s->id."'
                                           ");

                        if($update) {
                            echo '<script>alert("Ubah Surat Berhasil!")</script>';
                            echo '<script>window.location="index.php"</script>';
                        } else {
                            echo 'Gagal Nih!'.mysqli_error($conn);
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <p><a href="index.php" class="btn">Kembali</a></p>
    
</body>
</html>