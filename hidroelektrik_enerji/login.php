<?php

include 'y_enerji_DB.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING); 
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);  

   $select_admins = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ? LIMIT 1");
   $select_admins->execute([$name, $pass]);
   $row = $select_admins->fetch(PDO::FETCH_ASSOC);

   if($select_admins->rowCount() > 0){
      setcookie('admin_id', $row['id'], time() + 60*60*24*30, '/');
      header('location:index.php');
   }else{
    $warning_msg[] = 'Yanlış kullanıcı adı veya şifre';
   }

}

?>

<!DOCTYPE html>
<html lang="tr-TR">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link type="image/png" rel="icon" href="../images/teias_logo.png">
   <title>Giriş</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/main.css">

</head>
    <body>

    <!-- login section starts  -->
    <section class="form-container">
        <form action="" method="POST">
            <h3 style="color:#8f6578">Hoşgeldiniz!</h3>
            <p>varsayılan ad = <span>Emine Betül K</span> & şifre = <span>12345</span></p>
            <input type="text" name="name" placeholder="enter username" maxlength="20" class="box" required oninput="this.value.replace(/\s/g,'')">
            <input type="password" name="pass" placeholder="enter password" maxlength="20" class="box" required oninput="this.value.replace(/\s/g,'')">
            <input type="submit" value="Giriş Yap" name="submit" class="adminbtn">
        </form>
    </section>

    <!-- login section ends  -->


        <?php include 'components/footer.php' ?>

        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <script src="js/admin_script.js"></script>

        <?php
        include 'components/message.php';
        ?>

    </body>
</html>

