<?php

include 'y_enerji_DB.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

if(isset($_POST['submit'])){

   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING); 
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING); 
   $c_pass = sha1($_POST['c_pass']);
   $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);   

   $select_admins = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
   $select_admins->execute([$name]);

   if($select_admins->rowCount() > 0){
      $warning_msg[] = 'Kullanıcı adı zaten alınmış!';
   }else{
      if($pass != $c_pass){
         $warning_msg[] = 'Şifre uyuşmuyor!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admins`(id, name, password) VALUES(?,?,?)");
         $insert_admin->execute([$id, $name, $c_pass]);
         $success_msg[] = 'Başarıyla kaydedildi!';
         header('location:login.php');
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
   <link type="image/png" rel="icon" href="../images/logo_transparent.png">
   <title>Kayıt</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/main.css">

</head>
    <body>

    <!-- register section starts  -->
    <section class="form-container"  >
        <form action="" method="POST" style="width: 700px; height:450px; background-color: #8f6578; border-radius:25px;">
            <h3 style="color:white;">Yeni Kayıt</h3>
            <input type="text" name="name" placeholder="enter username" maxlength="20" class="box" style="text-align: center;" required oninput="this.value.replace(/\s/g,'')">
            <input type="password" name="pass" placeholder="enter password" maxlength="20" class="box" style="text-align: center;" required oninput="this.value.replace(/\s/g,'')">
            <input type="password" name="c_pass" placeholder="confirm password" maxlength="20" class="box" style="text-align: center;" required oninput="this.value.replace(/\s/g,'')">
            <input type="submit" value="kaydol" name="submit" class="adminbtn" >
        </form>
    </section>

    <!-- register section ends  -->


        <?php include 'components/footer.php' ?>

        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <script src="js/admin_script.js"></script>

        <?php
        include 'components/message.php';
        ?>

    </body>
</html>

