<?php include "y_enerji_DB.php";   ?>
<?php include "chartdb.php";   ?>
<?php
session_start(); ob_start();
require_once("Ayarlar/ayar.php"); 
require_once("Ayarlar/fonksiyonlar.php");

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
    <title>Çözüm Değerleri A*</title>
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
          ['Santral Adı','Kurulum Gücü'],
          <?php
          $query="SELECT kurulum_gucune_gore_santral_vij_degerleri.santral_adi,  POWER(kurulum_gucune_gore_santral_vij_degerleri.kurulum_gucune_gore_santral_vij - (SELECT max(kurulum_gucune_gore_santral_vij_degerleri.kurulum_gucune_gore_santral_vij) as maksimum from kurulum_gucune_gore_santral_vij_degerleri ),2) AS 'kurulum_gucu_A'
          FROM kurulum_gucune_gore_santral_vij_degerleri
          GROUP BY kurulum_gucune_gore_santral_vij_degerleri.kurulum_gucune_gore_santral_vij";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $kurulum_gucu_A=$data['kurulum_gucu_A'];
            ?>
            ['<?php echo $santral_adi; ?>' , <?php echo $kurulum_gucu_A; ?>],
            <?php

          }

            ?>

        ]);

        var options = {
          title: 'Kurulum gücü kriterine göre A* değeri',
          hAxis: {title: 'Alternatifler',minValue: 0, maxValue: 3},
          vAxis: {title: 'Kurulum Gücü',minValue: 0, maxValue: 0.03},
          legend: { position: 'center' },
          height:500,
          width:900,
          is3D: true,
          pointShape: 'circle',
          colors: ['BEEB9F'],
          trendlines: { 0: {
            color: 'purple',
        lineWidth: 10,
        opacity: 0.2,
        type: 'exponential'

          },
          1: {
              type: 'linear',
              pointSize: 10,
              pointsVisible: true
            }}

        };

        var chart = new google.visualization.PieChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
      
    </script>


    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Santral Adı','Yıllık Enerji'],
          <?php
          $query="SELECT  yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri.santral_adi, POWER(yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri.yillik_e_uretim_kap_gore_santral_vij_degeri - (SELECT max(yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri.yillik_e_uretim_kap_gore_santral_vij_degeri) as maksimum from yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri ),2) AS 'yillik_enerji_A'
          FROM yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri
          GROUP BY yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri.yillik_e_uretim_kap_gore_santral_vij_degeri";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $yillik_enerji_A=$data['yillik_enerji_A'];
            ?>
            ['<?php echo $santral_adi; ?>' , <?php echo $yillik_enerji_A; ?>],
            <?php

          }

            ?>

        ]);

        var options = {
          title: 'Yıllık Enerji Üretim Kapasitesi kriterine göre A* değeri',
          hAxis: {title: 'Alternatifler',minValue: 0, maxValue: 3},
          vAxis: {title: 'Yıllık Enerji Üretim Kapasitesi',minValue: 0, maxValue: 0.03},
          legend: { position: 'center' },
          height:500,
          width:900,
          is3D: true,
          pointShape: 'circle',
          colors: ['#C06C84'],
          trendlines: { 0: {
            color: 'purple',
        lineWidth: 10,
        opacity: 0.2,
        type: 'exponential'

          },
          1: {
              type: 'linear',
              pointSize: 10,
              pointsVisible: true
            }}

        };

        var chart = new google.visualization.PieChart(document.getElementById('curve_chart2'));

        chart.draw(data, options);
      }
      
    </script>


    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Santral Adı','Hidrolojik Düşü'],
          <?php
          $query="SELECT  hidrolojik_düsüye_gore_santral_vij_degerleri.santral_adi , POWER(hidrolojik_düsüye_gore_santral_vij_degerleri.net_hidr_düsüye_gore_santral_vij_degerleri - (SELECT max(hidrolojik_düsüye_gore_santral_vij_degerleri.net_hidr_düsüye_gore_santral_vij_degerleri) as maksimum from hidrolojik_düsüye_gore_santral_vij_degerleri ),2) AS 'hidrolojik_dusu_A'
          FROM hidrolojik_düsüye_gore_santral_vij_degerleri
          GROUP BY hidrolojik_düsüye_gore_santral_vij_degerleri.net_hidr_düsüye_gore_santral_vij_degerleri";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $hidrolojik_dusu_A=$data['hidrolojik_dusu_A'];
            ?>
            ['<?php echo $santral_adi; ?>' , <?php echo $hidrolojik_dusu_A; ?>],
            <?php

          }

            ?>

        ]);

        var options = {
          title: 'Net Hidrolojik Düşü kriterine göre A* değeri',
          hAxis: {title: 'Alternatifler',minValue: 0, maxValue: 3},
          vAxis: {title: 'Net Hidrolojik Düşü',minValue: 0, maxValue: 0.03},
          legend: { position: 'center' },
          height:500,
          width:900,
          is3D: true,
          pointShape: 'circle',
          colors: ['#79A7A8'],
          trendlines: { 0: {
            color: 'purple',
        lineWidth: 10,
        opacity: 0.2,
        type: 'exponential'

          },
          1: {
              type: 'linear',
              pointSize: 10,
              pointsVisible: true
            }}

        };

        var chart = new google.visualization.PieChart(document.getElementById('curve_chart3'));

        chart.draw(data, options);
      }
      
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Santral Adı','Depo Kapasite'],
          <?php
          $query="SELECT dep_kapasitesi_alanina_gore_santral_vij_degerleri.santral_adi,  POWER(dep_kapasitesi_alanina_gore_santral_vij_degerleri.dep_kapasitesi_alanina_gore_santral_vij_degerleri - (SELECT max(dep_kapasitesi_alanina_gore_santral_vij_degerleri.dep_kapasitesi_alanina_gore_santral_vij_degerleri) as maksimum from dep_kapasitesi_alanina_gore_santral_vij_degerleri ),2) AS 'depo_kapasite_A'
          FROM dep_kapasitesi_alanina_gore_santral_vij_degerleri
          GROUP BY dep_kapasitesi_alanina_gore_santral_vij_degerleri.dep_kapasitesi_alanina_gore_santral_vij_degerleri";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $depo_kapasite_A=$data['depo_kapasite_A'];
            ?>
            ['<?php echo $santral_adi; ?>' , <?php echo $depo_kapasite_A; ?>],
            <?php

          }

            ?>

        ]);

        var options = {
          title: 'Depolama Kapasitesi alanı kriterine göre A* değeri',
          hAxis: {title: 'Alternatifler',minValue: 0, maxValue: 3},
          vAxis: {title: 'Depolama Kapasitesi Alanı',minValue: 0, maxValue: 0.03},
          legend: { position: 'center' },
          height:500,
          width:900,
          is3D: true,
          pointShape: 'circle',
          colors: ['#F5A64A'],
          trendlines: { 0: {
            color: 'purple',
        lineWidth: 10,
        opacity: 0.2,
        type: 'exponential'

          },
          1: {
              type: 'linear',
              pointSize: 10,
              pointsVisible: true
            }}

        };

        var chart = new google.visualization.PieChart(document.getElementById('curve_chart4'));

        chart.draw(data, options);
      }
      
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Santral Adı','Türbin Sayısı'],
          <?php
          $query="SELECT turbin_sayisina_gore_santral_vij_degerleri.santral_adi ,POWER(turbin_sayisina_gore_santral_vij_degerleri.turbin_sayisina_gore_santral_vij_degerleri - (SELECT max(turbin_sayisina_gore_santral_vij_degerleri.turbin_sayisina_gore_santral_vij_degerleri) as maksimum from turbin_sayisina_gore_santral_vij_degerleri ),2) AS 'turbin_sayisi_A'
          FROM turbin_sayisina_gore_santral_vij_degerleri";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $turbin_sayisi_A=$data['turbin_sayisi_A'];
            ?>
            ['<?php echo $santral_adi; ?>' , <?php echo $turbin_sayisi_A; ?>],
            <?php

          }
            ?>

        ]);

        var options = {
          title: 'Türbin Sayısı kriterine göre A* değeri',
          hAxis: {title: 'Alternatifler',minValue: 0, maxValue: 3},
          vAxis: {title: 'Türbin Sayısı',minValue: 0, maxValue: 0.03},
          legend: { position: 'center' },
          height:500,
          width:900,
          is3D: true,
          pointShape: 'circle',
          colors: ['#9932CC'],
          trendlines: { 0: {
            color: 'purple',
        lineWidth: 10,
        opacity: 0.2,
        type: 'exponential'

          },
          1: {
              type: 'linear',
              pointSize: 10,
              pointsVisible: true
            }}

        };

        var chart = new google.visualization.PieChart(document.getElementById('curve_chart5'));

        chart.draw(data, options);
      }
      
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Santral Adı','Su Sayısı'],
          <?php
          $query="SELECT su_seviyesine_gore_santral_vij_degerleri.santral_adi,  POWER(su_seviyesine_gore_santral_vij_degerleri.su_seviyesine_gore_santral_vij_degerleri - (SELECT max(su_seviyesine_gore_santral_vij_degerleri.su_seviyesine_gore_santral_vij_degerleri) as maksimum from su_seviyesine_gore_santral_vij_degerleri ),2) AS 'su_sayisi_A'
          FROM su_seviyesine_gore_santral_vij_degerleri
          GROUP BY su_seviyesine_gore_santral_vij_degerleri.su_seviyesine_gore_santral_vij_degerleri";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $su_sayisi_A=$data['su_sayisi_A'];
            ?>
            ['<?php echo $santral_adi; ?>' , <?php echo $su_sayisi_A; ?>],
            <?php

          }

            ?>

        ]);

        var options = {
          title: 'Su Sayısı kriterine göre A* değeri',
          hAxis: {title: 'Alternatifler',minValue: 0, maxValue: 3},
          vAxis: {title: 'Su Sayısı',minValue: 0, maxValue: 0.03},
          legend: { position: 'center' },
          height:500,
          width:900,
          is3D: true,
          pointShape: 'circle',
          colors: ['#AAB9E8'],
          trendlines: { 0: {
            color: 'purple',
        lineWidth: 10,
        opacity: 0.2,
        type: 'exponential'

          },
          1: {
              type: 'linear',
              pointSize: 10,
              pointsVisible: true
            }}

        };

        var chart = new google.visualization.PieChart(document.getElementById('curve_chart6'));

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
    <h1 class="heading" style="font-size: 1.5rem; color: #e4b4b4; font-family: 'Poppins', cursive; text-align: center; padding:3rem">Tüm <span>Alternatiflerin</span> Çözüm değerleri <b>A*</b></h1>
    <p style="font-size: 1.5rem; color: #717171; font-family: 'Poppins', cursive; text-align: center; padding:1rem"> Bu aşamada Vij matrisi kullanılarak her bir kriter için pozitif ideal ve negatif ideal çözüm değerleri elde edildi</p>
        <div class="box-container">
            <div class="box" id="curve_chart" style="width: 960px; ">
            </div>
            <div class="box" id="curve_chart2" style="width: 960px;">
            </div>
        </div>
        <div class="box-container">
            <div class="box" id="curve_chart3" style="width: 960px; ">   
            </div>
            <div class="box" id="curve_chart4" style="width: 960px;">
            </div>
        </div>
        <div class="box-container">
            <div class="box" id="curve_chart5" style="width: 960px;">
            </div>
            <div class="box" id="curve_chart6" style="width: 960px;">   
            </div>
        </div>
      </section>
      <script src="js/script.js"></script>
  </body>
</html>
