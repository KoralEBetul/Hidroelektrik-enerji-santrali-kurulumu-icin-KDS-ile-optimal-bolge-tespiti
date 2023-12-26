<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'y_enerji_DB.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:kriter.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:kriter.php');
}


if(isset($_POST['submit'])){
    // Debug information
    echo "Update form submitted.<br>";

    // ... rest of the code ...

    $kriter_adi = $_POST['kriter_adi'];
    $kriter_adi = filter_var($kriter_adi, FILTER_SANITIZE_STRING);
    $enerji_id = $_POST['enerji_id'];
    $enerji_id = filter_var($enerji_id, FILTER_SANITIZE_STRING);
    $birim = $_POST['birim'];
    $agirlik = $_POST['agirlik'];
    $agirlik = filter_var($agirlik, FILTER_SANITIZE_STRING);
    $birim = filter_var($birim, FILTER_SANITIZE_STRING);
    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);

    try {
        // Debug information
        echo "Update ID: " . $get_id . "<br>";

        $update_playlist = $conn->prepare("UPDATE `kriter` SET kriter_adi = ?, enerji_id = ?, birim = ?, agirlik = ?, status = ? WHERE kriter_id = ?");
        $update_playlist->execute([$kriter_adi, $enerji_id, $birim, $agirlik, $status, $get_id]);

        // Debug information
        echo "Rows affected: " . $update_playlist->rowCount() . "<br>";



        $success_msg[] = 'Kriter güncellendi!';
        header('location:kriter.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



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
            $message[] = 'Salon silindi!';
        } else {
            $message[] = 'Salon zaten silindi!';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>

<!DOCTYPE html>
<html lang="tr-TR">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link type="image/png" rel="icon" href="images/teias_logo.png">
   <title>Güncelleme Ekranı</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/main.css">

</head>
    <body>
        <!-- header section starts  -->
        <?php include 'components/admin_header.php'; ?>
        <!-- header section ends -->


   <!-- update section starts  -->

        <section class="form-container">

            <?php
                    $select_playlist = $conn->prepare("SELECT * FROM `kriter` WHERE kriter_id = ?");
                    $select_playlist->execute([$get_id]);
                    if($select_playlist->rowCount() > 0){
                    while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){
                        $playlist_id = $fetch_playlist['kriter_id'];
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="old_image" value="<?= $fetch_playlist['thumb']; ?>">
                <p>Durum <span>*</span></p>
                <select name="status" class="box" required>
                    <option value="<?= $fetch_playlist['status']; ?>" selected><?= $fetch_playlist['status']; ?></option>
                    <option value="active">active</option>
                    <option value="deactive">deactive</option>
                </select>
                <p>Kriter adı <span>*</span></p>
                <input type="text" name="kriter_adi" maxlength="100" required placeholder="kriter adını girin" value="<?= $fetch_playlist['kriter_adi']; ?>" class="box">
                <p>Ağırlık <span>*</span></p>
                <textarea name="agirlik" class="box" required placeholder="ağırlık belirtin" maxlength="1000" cols="30" rows="10"><?= $fetch_playlist['agirlik']; ?></textarea>
                

                <p>Enerji Türü <span>*</span></p>
                <select name="enerji_id" class="box" required>
                    <?php
                    // Veritabanından enerji türlerini çek
                    $enerji_turleri = $conn->query("SELECT enerji_id, enerji_adi FROM yenilenebilir_enerji")->fetchAll(PDO::FETCH_ASSOC);

                    // Her enerji türünü seçenek olarak ekle
                    foreach ($enerji_turleri as $enerji) {
                        echo "<option value='{$enerji['enerji_id']}'";
                        // Seçili enerji türünü belirle
                        if ($fetch_playlist['enerji_id'] == $enerji['enerji_id']) {
                            echo " selected";
                        }
                        echo ">{$enerji['enerji_adi']}</option>";
                    }
                    ?>
                </select>


                <p>Birim türü <span>*</span></p>
                <input type="text" name="birim" maxlength="100" required placeholder="birim kodunu girin" value="<?= $fetch_playlist['birim']; ?>" class="box">
                    
        
            
                <input type="submit" value="kriteri güncelle" name="submit" class="adminbtn">
                <div class="flex-btn">
                    <input type="submit" value="sil" class="adminbtn" onclick="return confirm('kriteri silmek istiyor musun?');" name="delete">
                    
                </div>
            </form>
            <?php
                } 
            }else{
                echo '<p class="empty">no playlist added yet!</p>';
            }
            ?>

        </section>

<!-- update section ends -->


        <?php include 'components/footer.php' ?>

        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <script src="js/admin_script.js"></script>

        <?php
        include 'components/message.php';
        ?>

    </body>
</html>

