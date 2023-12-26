<?php

include 'y_enerji_DB.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

// ...

if(isset($_POST['delete'])){
    // Check if 'delete_id' is set before using it
    $delete_id = isset($_POST['delete_id']) ? (int)$_POST['delete_id'] : 0; // Cast to int, default to 0 if not set
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_NUMBER_INT); // Ensure it's a valid integer

    try {
        // Debug information
        echo "Delete ID: " . $delete_id . "<br>";

        $delete_playlist = $conn->prepare("DELETE FROM `kriter` WHERE kriter_id = ?");
        $delete_playlist->execute([$delete_id]);

        // Debug information
        echo "Rows affected: " . $delete_playlist->rowCount() . "<br>";

        if($delete_playlist->rowCount() > 0){
            // Successfully deleted, you can add any further logic here
            $message[] = 'Kriter silindi!';
        } else {
            $message[] = 'Kriter zaten silindi!';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



?>



<!DOCTYPE html>
<html lang="tr-TR">
<head>
    <meta http-equiv="content-type" content="text-html"; charset="utf-8">
    <meta charset="UTF-8">
    <meta http-equiv="content-language" content="tr">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link type="image/png" rel="icon" href="images/teias_logo.png">
   <title>Kriterler</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/main.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/admin_header.php'; ?>
<!-- header section ends -->


<!--! add gym section start -->

<section class="menu" id="menu"> 
        <h1 class="heading">Tüm <span>Kriterler</span></h1>
        


        <div class="box-container">
            <div class="boxgymbaslik" style="text-align: center;">
                <h3 class="title" style="margin-bottom: .5rem;">Yeni Kriter Oluştur</h3>
                <a href="add_kriter.php" class="btn">Kriter Ekle</a>
            </div>

            <?php
                $select_playlist = $conn->prepare("SELECT kriter.*, yenilenebilir_enerji.enerji_adi 
                FROM kriter
                INNER JOIN yenilenebilir_enerji ON kriter.enerji_id=yenilenebilir_enerji.enerji_id;
                WHERE admin_id = ? 
                ORDER BY date DESC");
                $select_playlist->execute([$admin_id]);
                if($select_playlist->rowCount() > 0){
                while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){
                    $playlist_id = $fetch_playlist['kriter_id'];
            ?>
            <div class="box">
                <div class="flex">
                    <div><i class="fas fa-circle-dot" style="<?php if($fetch_playlist['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i> <span style="<?php if($fetch_playlist['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fetch_playlist['status']; ?>  </span></div>
                
                </div>
                <div class="flex">
                    <div><i class="fas fa-calendar" ></i>  <span><?= $fetch_playlist['date']; ?></span></div>
                </div>
                  
                
                <h3 class="kriter_adi" style="font-family: 'Poppins';">Kriter: <span><?= $fetch_playlist['kriter_adi']; ?></span> </h3>


                <h3 class="agirlik" style="font-family: 'Poppins';">Ağırlık: <span><?= $fetch_playlist['agirlik']; ?></span></h3>
                <h3 class="birim" style="font-family: 'Poppins';">Birim: <span><?= $fetch_playlist['birim']; ?></span></h3>




                <h3 class="enerji_id" style="font-family: 'Poppins';">Enerji: <span><?= $fetch_playlist['enerji_adi']; ?></span></h3>


                    
                

                <form action="" method="post" class="flex-btn">
                    <input type="hidden" name="delete_id" value="<?= $playlist_id; ?>">
                    <a href="update_kriter.php?get_id=<?= $playlist_id; ?>" class="option-btn">update</a>
                    <input type="submit" value="delete" class="delete-btn" onclick="return confirm('Salonu Silmek İstediğine Emin misin?');" name="delete">
                </form>
                <!--!
                <a href="view_playlist.php?get_id=<?= $playlist_id; ?>" class="btn">view playlist</a>
                -->
            </div>
            <?php
                } 
            }else{
                echo '<p class="empty">no playlist added yet!</p>';
            }
            ?>

        </div>

<!--!
        <div class="box-container">
            <?php
           $select_playlist = $conn->prepare("SELECT * FROM `kriter`");
            $select_playlist->execute();
            if($select_playlist->rowCount() > 0){
                while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="box">
                <p>Salon Başlığı: <span><?= $fetch_playlist['kriter_adi']; ?></span></p>
                <p>Salon Tanımı : <span><?= $fetch_playlist['agirlik']; ?></span></p>
                <img src="../uploaded_files/<?php echo $fetch_playlist["thumb"]; ?>" >
                <p> Salon Görseli : <img src="../uploaded_files/salon6.jpg" ></p>
                <p>Tarih : <span><?= $fetch_playlist['date']; ?></span></p>
                <p>Durum : <span><?= $fetch_playlist['status']; ?></span></p>
                <form action="" method="POST">
                    <input type="hidden" name="delete_id" value="<?= $fetch_playlist['admin_id']; ?>">
                    <input type="submit" value="Rezervasyonu sil" onclick="return confirm('Bu rezervasyonu silmek istediğine emin misin?');" name="delete" class="adminbtn">
                </form>
            </div>
            <?php
                }
            }else{
            ?>
            <div class="box" style="text-align: center;">
                <p>Rezervasyon bulunamadı!</p>
                <a href="dashboard.php" class="adminbtn">Anasayfaya dön</a>
            </div>
            <?php
                }
            ?>
        </div> 
 -->
    </section>


    <!--! add gym section end -->




<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/admin_script.js"></script>
<script>
   document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>

<?php include 'components/message.php'; ?>

</body>
</html>