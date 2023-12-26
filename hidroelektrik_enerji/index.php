<?php include "chartdb.php";   ?>
<?php include "y_enerji_DB.php";   ?>
<?php

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

?>
<?php
session_start(); ob_start();
require_once("Ayarlar/ayar.php"); 
require_once("Ayarlar/fonksiyonlar.php");

?>


<!DOCTYPE html>
<html lang="tr-TR">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link type="image/png" rel="icon" href="images/teias_logo.png">
   <title>Yönetim Paneli</title>
   <script type="text/javascript" src="Ayarlar/fonksiyonlar.js" language="javascript"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!--boxicon css -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<nav class="sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                        <a href="index.php"><img src="images/teias_logo.png" alt="logo"></a>
                    </span>
                    <div class="text header-text">
                        <span class="name" style="margin: auto;">Teiaş</span>
                        <span class="profession">Yönetim paneli</span>

                    </div>
                </div>
                <i class='bx bx-chevron-right toggle'></i>
            </header>
            <div class="menu-bar">
                <div class="menu">
                    <li class="search-box">
                        <i class='bx bx-search-alt icon'></i>
                        <input type="text" placeholder="Ara...">
                    </li>
                    <ul class="menu-links">
                        <li class="nav-link">

                            <a href="santralbolge1.php">
                                <i class='bx bx-map icon'></i>
                                <span class="text nav-text">Santral bölgeleri</span>
                            </a>
                        </li>
                        <li class="nav-link">

                            <a href="chart1.php">
                                <i class='bx bx-bar-chart-alt-2 icon'></i>
                                <span class="text nav-text">Alternatifler</span>
                            </a>
                        </li>
                        <li class="nav-link">

                            <a href="rijdegerleri1.php">
                                <i class='bx bx-line-chart icon'></i>
                                <span class="text nav-text">Rij değerleri </span>
                            </a>
                        </li>
                        <li class="nav-link">

                            <a href="vijdegerleri1.php">
                                <i class='bx bx-scatter-chart icon'></i>
                                <span class="text nav-text">Vij değerleri</span>
                            </a>
                        </li>
                        <!-- Çözüm Değerleri Menüsü -->
                        <li class="nav-link">
                            <a href="#">
                                <i class='bx bx-pie-chart icon'></i>
                                <span class="text nav-text">Çözüm Değerleri</span>
                            </a>
                            <ul class="submenu">
                                <li class="nav-link">
                                    <a href="cozumdegerleri1.php">
                                        <span class="text nav-text">Çözüm Değerleri *</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="cozumdegerlerinegatif1.php">
                                        <span class="text nav-text">Çözüm Değerleri -</span>
                                    </a>
                                </li>
                                <!-- Diğer Çözüm Değerleri alt menü öğeleri buraya eklenebilir -->
                            </ul>
                        </li>
                        <!-- Çözüm Değerleri Menüsü -->
                        <li class="nav-link">
                            <a href="sidegerleri1.php">
                                <i class='bx bxs-chart icon'></i>
                                <span class="text nav-text">Si Değerleri</span>
                            </a>
                        </li>
                        <li class="nav-link">

                            <a href="cisonuc1.php">
                                <i class='bx bx-bookmarks icon'></i>
                                <span class="text nav-text">Analiz</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="bottom-content">
                    <li class="">
                        <a href="components/admin_logout.php" onclick="return confirm('Bu web sitesinden çıkmak istiyor musun?'); ">
                            <i class='bx bx-log-out icon'></i>
                            <span class="text nav-text">Çıkış</span>
                        </a>
                    </li>
                    <li class="mode">
                        <div class="moon-sun">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                        </div>
                        <span class="mode-text text">Dark Mode</span>
                        <div class="toggle-switch">
                            <span class="switch">

                            </span>
                        </div>
                    </li>
                </div>
            </div>
        </nav>
<!-- header section ends -->


<!-- dashboard section starts  -->

<section class="dashboard">

   <h1 class="dashboardheading" style="padding: 2rem;"></h1>

    <div class="box-container">

        <div class="box">
            <?php
                $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ? LIMIT 1");
                $select_profile->execute([$admin_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <h3>Hoşgeldiniz!</h3>
            <p><?= $fetch_profile['name']; ?></p>
            <a href="update.php" class="adminbtn">Profili güncelle</a>
        </div>
        <div class="box">
            <h3>Hızlı seçim</h3>
            <p>Giriş yap veya Kaydol</p>
            <a href="login.php" class="adminbtn" style="margin-right: 1rem;">Giriş</a>
            <a href="register.php" class="adminbtn" style="margin-left: 1rem;">Kaydol</a>
        </div>
        <div class="box">
            <?php
                $select_admins = $conn->prepare("SELECT * FROM `admins`");
                $select_admins->execute();
                $count_admins = $select_admins->rowCount();
            ?>
            <h3><?= $count_admins; ?></h3>
            <p>Toplam admin</p>
            <a href="admins.php" class="adminbtn">Yöneticileri görüntüle</a>
        </div>

        <div class="box">
            <h3>Kriterler</h3>
            <p>Düzenle veya Yeni oluştur</p>
            <a href="kriter.php" class="adminbtn" style="margin-right: 1rem;">Düzenle</a>
            <a href="add_kriter.php" class="adminbtn" style="margin-left: 1rem;">Oluştur</a>
        </div>
        <div class="box">
            <?php
                // Örnek kriter: antrenor_bookings tablosundaki durumu 'onaylandı' olan kayıtları say
                $select_bookings = $conn->prepare("SELECT COUNT(*) as count FROM `kriter` WHERE status = 'active'");
                $select_bookings->execute();
                $result = $select_bookings->fetch(PDO::FETCH_ASSOC);
                $count_bookings = $result['count'];
            ?>
            <h3><?= $count_bookings; ?></h3>
            <p>Onaylanmış Aktif Kriter Sayısı</p>
            <a href="kriter.php" class="adminbtn">Kriterleri görüntüle</a>
        </div>
        <div class="box">
            <?php
                // Örnek kriter: antrenor_bookings tablosundaki durumu 'onaylandı' olan kayıtları say
                $select_bookings = $conn->prepare("SELECT COUNT(*) as count FROM `kriter` WHERE status = 'deactive'");
                $select_bookings->execute();
                $result = $select_bookings->fetch(PDO::FETCH_ASSOC);
                $count_bookings = $result['count'];
            ?>
            <h3><?= $count_bookings; ?></h3>
            <p>Beklemedeki Kriter Sayısı</p>
            <a href="kriter.php" class="adminbtn">Kriterleri görüntüle</a>
        </div>
        <div class="box">
            <?php
                // Örnek kriter: antrenor_bookings tablosundaki durumu 'onaylandı' olan kayıtları say
                $select_bookings = $conn->prepare("SELECT COUNT(*) as count FROM `santral` WHERE enerji_id = 6
                GROUP BY enerji_id");
                $select_bookings->execute();
                $result = $select_bookings->fetch(PDO::FETCH_ASSOC);
                $count_bookings = $result['count'];
            ?>
            <h3><?= $count_bookings; ?></h3>
            <p>Baraj Sayısı</p>
            <a href="santral.php" class="adminbtn">Barajları görüntüle</a>
        </div>
        <div class="box">
            <?php
                // Örnek kriter: antrenor_bookings tablosundaki durumu 'onaylandı' olan kayıtları say
                $select_bookings = $conn->prepare("SELECT COUNT(*) as count FROM `alternatif`");
                $select_bookings->execute();
                $result = $select_bookings->fetch(PDO::FETCH_ASSOC);
                $count_bookings = $result['count'];
            ?>
            <h3><?= $count_bookings; ?></h3>
            <p>Alternatifler</p>
            <a href="alternatif.php" class="adminbtn">Alternatifleri görüntüle</a>
        </div>
        




    </div>

</section>


<!-- dashboard section ends -->





<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/admin_script.js"></script>
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>