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

?>

<!DOCTYPE html>
<html lang="tr-TR">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link type="image/png" rel="icon" href="../images/logo_transparent.png">
   <title>Yöneticiler</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/main.css">

</head>
<body>
   <!-- header section starts  -->
<?php include 'components/admin_header.php'; ?>
<!-- header section ends -->




<!-- admins section starts  -->

<section class="grid">

   <h1 class="dashboardheading" style="color:#717171;">Yöneticiler</h1>

   <div class="box-container" >

   <div class="box" style="text-align: center; ">
      <p>Yeni bir yönetici oluştur</p>
      <a href="register.php" class="adminbtn"> Kayıt </a>
   </div>

   <?php
      $select_admins = $conn->prepare("SELECT * FROM `admins`");
      $select_admins->execute();
      if($select_admins->rowCount() > 0){
         while($fetch_admins = $select_admins->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" style="text-align: center;" <?php if( $fetch_admins['name'] == 'admin'){ echo 'style="text-align: center;"'; } ?>>
      <p>name : <span><?= $fetch_admins['name']; ?></span></p>
      <form action="" method="POST">
         <input type="hidden" name="delete_id" value="<?= $fetch_admins['id']; ?>">
         <input type="submit" value="Yöneticiyi sil" onclick="return confirm('Bu yöneticiyi silmek istediğine emin misin?');" name="delete" class="adminbtn">
      </form>
   </div>
   <?php
      }
   }else{
   }
   ?>

   </div>

</section>

<!-- admins section ends -->




<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/admin_script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>