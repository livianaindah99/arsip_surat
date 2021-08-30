<?php
    include 'db.php';

    if(isset($_GET['ids'])) {
        $surat = mysqli_query($conn, "SELECT file_surat FROM tb_surat WHERE id = '".$_GET['ids']."' ");
        $p = mysqli_fetch_object($surat);
        
        unlink('./surat/'.$p->file_surat);

        $delete = mysqli_query($conn, "DELETE FROM tb_surat WHERE id = '".$_GET['ids']."' ");
        echo '<script>window.location="index.php"</script>';
    }
?>
