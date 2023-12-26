<?php include "y_enerji_DB.php";   ?>
<?php include "chartdb.php";   ?>
<?php
session_start(); ob_start();
require_once("Ayarlar/ayar.php"); 
require_once("ayarlar/fonksiyonlar.php");

if(isset($_COOKIE['admin_id'])){
    $admin_id = $_COOKIE['admin_id'];
 }else{
    $admin_id = '';
    header('location:login.php');
 }

?>
<html>
  <head>
    <meta http-equiv="content-type" content="text-html"; charset="utf-8">
    <meta charset="UTF-8">
    <meta http-equiv="content-language" content="tr">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ci Sonuç Değerleri</title>
    <link type="image/png" rel="icon" href="images/teias_logo.png">
    <script type="text/javascript" src="frameworks/JQuery/jquery-3.6.0.min" language="javascript"></script>
    <link rel="stylesheet" href="css/style.css">
     <!--boxicon css -->
     <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script type="text/javascript" src="Ayarlar/fonksiyonlar.js" language="javascript"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Santral Adı','Ci'],
          <?php
          $query="SELECT s_negatif.Si_negatif / (si_pozitif.Si_pozitif + s_negatif.Si_negatif) as 'Ci' , s_negatif.santral_adi
          from s_negatif,si_pozitif
          WHERE s_negatif.santral_adi=si_pozitif.santral_adi";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $ci=$data['Ci'];
            ?>
            ['<?php echo $santral_adi; ?>' , <?php echo $ci; ?>],
            <?php

          }

            ?>
        ]);

        var options = {
          //title: 'Alternatiflerin Ci değerleri',
          hAxis: {title: 'Alternatifler',minValue: 0, maxValue: 3},
          vAxis: {title: 'Ci',minValue: 0, maxValue: 0.5},
          colors: ['#544854'],
          trendlines: { 0: {
        lineWidth: 10,
        opacity: 0.2,
        

          },
          
          },
          slices: {  4: {offset: 0.2},
                    6: {offset: 0.3},
                    14: {offset: 0.4},
                    15: {offset: 0.5},
          },

        };

        var chart = new google.visualization.PieChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
      
    </script>
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
    <!--! menu section start -->
    <section class="menu2" id="menu"> 
    <h1 class="heading" style="font-size: 1.5rem; color: #e4b4b4; font-family: 'Poppins', cursive; text-align: center; padding:1rem">Ci <span>Sonuç</span> değerleri</h1>
    <p style="font-size: 1.5rem; color: #717171; font-family: 'Poppins', cursive; text-align: center; padding:1rem"> Bu aşamada  Cİ değeri olarak adlandırdığımız İdeal çözüme göreli yakınlık katsayıları hesaplandı.</p>
        <div class="box-container"  >
            <div class="box" id="curve_chart" style="width: 960px; height: 600px; margin:auto; background-color:#544854">     
            </div>
        </div>
        <div class="box-container2">
          <div class="box" style="background-color:#E6E6FA">
          </div>
        </div>
        <div class="box-container2">
      <div class="box2" id="" style="width: 430px; position:absolute; right:660px; bottom:178px;">
        <p><b>Ci* Min Değeri</b></p>

        <p style="color:#544854"><?php echo $santral_adi13; ?></p>
        <p style="color:#544854"><?php echo $Ci; ?></p>
      </div>
      <div class="box2" id="" style="width: 430px; position:absolute; left:660px; bottom:178px;">
        <p><b>Ci* Maks Değeri</b></p>

        <p style="color:#544854"><?php echo $santral_adi14; ?></p>
        <p style="color:#544854"><?php echo $CiMaks; ?></p>
      </div>
    </div>
      </section>
      <script src="js/script.js"></script>
  </body>
</html>
