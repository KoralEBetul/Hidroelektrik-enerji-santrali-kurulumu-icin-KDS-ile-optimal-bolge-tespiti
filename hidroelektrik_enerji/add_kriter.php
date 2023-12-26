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

    $kriter_id = create_unique_id();
    $kriter_adi = $_POST['kriter_adi'];
    $kriter_adi = filter_var($kriter_adi, FILTER_SANITIZE_STRING);
    $agirlik = $_POST['agirlik'];
    $agirlik = filter_var($agirlik, FILTER_SANITIZE_STRING);
    $enerji_id = $_POST['enerji_id'];
    $enerji_id = filter_var($enerji_id, FILTER_SANITIZE_STRING);
    $birim = $_POST['birim'];
    $birim = filter_var($birim, FILTER_SANITIZE_STRING);
    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);
 
 
    $add_playlist = $conn->prepare("INSERT INTO `kriter`(kriter_id, kriter_adi, enerji_id, birim, agirlik, admin_id, status) VALUES(?,?,?,?,?,?,?)");
    $add_playlist->execute([$kriter_id, $kriter_adi, $enerji_id, $birim, $agirlik, $admin_id, $status]);
 
 
    $success_msg[] = 'Yeni Kriter oluşturuldu!';
    header('location:kriter.php');
    
    
 
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
    <p>Statü <span>*</span></p>
    <select name="status" required class="box">
        <option value="active">Aktif</option>
        <option value="deactive">Aktif değil</option>
    </select>
    <p>Kriter adı <span>*</span></p>
    <input type="text" class="box" name="kriter_adi" maxlength="100" 
    placeholder="Kriter başlığını girin" required>
    <p>Enerji id <span>*</span></p>
    <select name="enerji_id" required class="box">
        <option value="1">Rüzgar</option>
        <option value="2">Güneş</option>
        <option value="3">Biyokütle</option>
        <option value="4">Hidrojen</option>
        <option value="5">Dalga</option>
        <option value="6">Hidroelektrik</option>
        <option value="7">Jeotermal</option>
    </select>
    <p>Birim <span>*</span></p>
    <input type="text" class="box" name="birim" maxlength="100" 
    placeholder="Birim kodunu girin" required>
    <p>Ağırlık <span>*</span></p>
    <textarea name="agirlik" class="box" cols="30" required 
    placeholder="Kriter ağırlığını tanımlayın" maxlength="1000" rows="10" >
    </textarea>
    
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