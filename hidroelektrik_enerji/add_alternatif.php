<?php

include 'y_enerji_DB.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

if(isset($_POST['delete'])){

   $delete_id = $_POST['delete_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_delete = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
   $verify_delete->execute([$delete_id]);

   if($verify_delete->rowCount() > 0){
      $delete_admin = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
      $delete_admin->execute([$delete_id]);
      $success_msg[] = 'Yönetici silindi!';
   }else{
      $warning_msg[] = 'Yönetici zaten silindi!';
   }

}

if(isset($_POST['submit'])){

    $alternatif_id  = create_unique_id();
    $santral_id = isset($_POST['santral_id']) ? (int)$_POST['santral_id'] : 0;
    $kriter_id = isset($_POST['kriter_id']) ? (int)$_POST['kriter_id'] : 0;
    
    // Ensure they are valid integers
    $santral_id = filter_var($santral_id, FILTER_SANITIZE_NUMBER_INT);
    $kriter_id = filter_var($kriter_id, FILTER_SANITIZE_NUMBER_INT);

    $santral_kapasitesi = $_POST['santral_kapasitesi'];
    $santral_kapasitesi = filter_var($santral_kapasitesi, FILTER_SANITIZE_STRING);

 
    $add_playlist = $conn->prepare("
    INSERT INTO `alternatif` (alternatif_id, santral_id, kriter_id, santral_kapasitesi, admin_id) 
    VALUES (?, ?, ?, ?, ?)");
        $add_playlist->execute([$alternatif_id, $santral_id, $kriter_id, $santral_kapasitesi, $admin_id]);

        // Fetch the santral_adi for display
        $select_santral_adi = $conn->prepare("SELECT santral_adi FROM santral WHERE santral_id = ?");
        $select_santral_adi->execute([$santral_id]);
        $santral_info = $select_santral_adi->fetch(PDO::FETCH_ASSOC);
        $santral_adi = $santral_info ? $santral_info['santral_adi'] : 'Unknown Santral';

        $success_msg[] = "Yeni Alternatif '{$santral_adi}' oluşturuldu!";
        header("location:alternatif.php");
    
    
 
 }




?>

<!DOCTYPE html>
<html lang="tr-TR">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link type="image/png" rel="icon" href="images/teias_logo.png">
   <title>Kriter ekle</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/main.css">

</head>
<body>
  
<!-- header section starts  -->
<?php include 'components/admin_header.php'; ?>
<!-- header section ends -->

<!-- add gym section starts  -->

<section class="form-container">

   <form action="" method="POST" enctype="multipart/form-data">
    <p>Santral <span>*</span></p>
    <select name="santral_id" required class="box">
    <?php
    // Fetch santral_id and santral_adi from the database
    $select_santral = $conn->prepare("SELECT * FROM santral");
    $select_santral->execute();
    $santrals = $select_santral->fetchAll(PDO::FETCH_ASSOC);

    // Loop through the results and create options
    foreach ($santrals as $santral) {
        echo '<option value="' . $santral['santral_id'] . '">' . $santral['santral_adi'] . '</option>';
    }
    ?>
</select>

    <!-- For Kriter -->
    <p>Kriter <span>*</span></p>
    <select name="kriter_id" required class="box">
        <?php
        // Fetch kriter_id and kriter_adi from the database
        $select_kriter = $conn->prepare("SELECT kriter_id, kriter_adi FROM kriter");
        $select_kriter->execute();
        $kriterler = $select_kriter->fetchAll(PDO::FETCH_ASSOC);

        // Loop through the results and create options
        foreach ($kriterler as $kriter) {
            echo '<option value="' . $kriter['kriter_id'] . '">' . $kriter['kriter_adi'] . '</option>';
        }
        ?>
    </select>
    <p>Santral Kapasitesi <span>*</span></p>
    <input type="text" class="box" name="santral_kapasitesi" maxlength="100" 
    placeholder="Santral kapasitesi girin" required>
    
    <input type="submit" value="Kriter oluştur" name="submit" class="adminbtn">

   </form>

</section>

<!-- add gym section ends -->




<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/admin_script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>