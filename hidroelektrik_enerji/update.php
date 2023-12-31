<?php

include 'y_enerji_DB.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

$select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ? LIMIT 1");
$select_profile->execute([$admin_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING); 

   if(!empty($name)){
      $verify_name = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
      $verify_name->execute([$name]);
      if($verify_name->rowCount() > 0){
         $warning_msg[] = 'Kullanıcı adı zaten alınmış!';
      }else{
         $update_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
         $update_name->execute([$name, $admin_id]);
         $success_msg[] = 'Kullanıcı adı güncellendi!';
      }
   }

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $fetch_profile['password'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $c_pass = sha1($_POST['c_pass']);
   $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $warning_msg[] = 'Eski şifre eşleşmedi!!';
      }elseif($c_pass != $new_pass){
         $warning_msg[] = 'Yeni şifre eşleşmedi!';
      }else{
         if($new_pass != $empty_pass){
            $update_password = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
            $update_password->execute([$c_pass, $admin_id]);
            $success_msg[] = 'Şifre güncellendi!';
            header('location:login.php');
         }else{
            $warning_msg[] = 'Lütfen yeni şifre giriniz!';
         }
      }
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

<form action="" method="POST" style="background-color: #8f6578;">
   <h3 style=" color:white;">Profili Güncelle</h3>
   <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
   <input type="password" name="old_pass" placeholder="eski şifreyi girin" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
   <input type="password" name="new_pass" placeholder="yeni şifreyi girin" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
   <input type="password" name="c_pass" placeholder="yeni şifreyi onayla" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
   <input type="submit" value="güncelle" name="submit" class="adminbtn">
</form>

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

