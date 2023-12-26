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
    <title>Alternatifler</title>
    <link type="image/png" rel="icon" href="images/teias_logo.png" id="analogo">
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
          ['Santral Adı', 'Kurulu Güç'],
          <?php
          $query="SELECT santral.santral_adi,alternatif.santral_kapasitesi
          FROM alternatif,santral,kriter
          WHERE alternatif.santral_id=santral.santral_id
          AND kriter.kriter_id=alternatif.kriter_id
          and santral.santral_adi IN('Erzurum Aksu HES','Berta Enerji Grubu','Beyhan Barajı Ve HES','Dicle Barajı Ve HES','Çukurca','Dilektaşı','Doğanlı','Eriç','İvme','Kayraktepe','Kemah','Keskin','Konaktepe','Pervani','Silopi Barajı Ve HES','Silvan','Yusufeli')
          AND kriter.kriter_id=1
          GROUP BY santral.santral_id; ";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $santral_kapasitesiC1=$data['santral_kapasitesi'];
            ?>
            ['<?php echo $santral_adi; ?>', <?php echo $santral_kapasitesiC1; ?>],
            <?php

          }

            ?>


        ]);

        var options = {
          title: 'Kurulum gücü kriterine göre Alternatifler',
          hAxis: {title: 'Alternatifler ',minValue: 0, maxValue: 3},
          vAxis: {title: 'Kurulum Gücü ',minValue: 0, maxValue: 3},
          legend: { position: 'center' },
          height:500,
          width:900,
          seriesType: 'bars',
          series: {5: {type: 'line'}}
          

        };

        var chart = new google.visualization.ComboChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
      
    </script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Santral Adı', 'Yıllık Üretim'],
          <?php
          $query="SELECT santral.santral_adi,alternatif.santral_kapasitesi
          FROM alternatif,santral,kriter
          WHERE alternatif.santral_id=santral.santral_id
          AND kriter.kriter_id=alternatif.kriter_id
          and santral.santral_adi IN('Erzurum Aksu HES','Berta Enerji Grubu','Beyhan Barajı Ve HES','Dicle Barajı Ve HES','Çukurca','Dilektaşı','Doğanlı','Eriç','İvme','Kayraktepe','Kemah','Keskin','Konaktepe','Pervani','Silopi Barajı Ve HES','Silvan','Yusufeli')
          AND kriter.kriter_id=4
          GROUP BY santral.santral_id;";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $santral_kapasitesiC2=$data['santral_kapasitesi'];
            ?>
            ['<?php echo $santral_adi; ?>', <?php echo $santral_kapasitesiC2; ?>],
            <?php

          }

            ?>

        ]);

        var options = {
          title: 'Yıllık Enerji Üretim kapasitesi kriterine göre Alternatifler',
          hAxis: {title: 'Alternatifler',minValue: 0, maxValue: 3},
          vAxis: {title: 'Yıllık Enerji üretim kapasitesi',minValue: 0, maxValue: 3},
          legend: { position: 'center' },
          height:500,
          width:900,
          colors: ['#4DD0E1'],
          seriesType: 'bars',
          series: {5: {type: 'line'}}


        };

        var chart = new google.visualization.ComboChart(document.getElementById('curve_chart2'));

        chart.draw(data, options);
      }
    </script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Santral Adı', 'Hidrolojik Düşü'],
          <?php
          $query="SELECT santral.santral_adi,alternatif.santral_kapasitesi
          FROM alternatif,santral,kriter
          WHERE alternatif.santral_id=santral.santral_id
          AND kriter.kriter_id=alternatif.kriter_id
          and santral.santral_adi IN('Erzurum Aksu HES','Berta Enerji Grubu','Beyhan Barajı Ve HES','Dicle Barajı Ve HES','Çukurca','Dilektaşı','Doğanlı','Eriç','İvme','Kayraktepe','Kemah','Keskin','Konaktepe','Pervani','Silopi Barajı Ve HES','Silvan','Yusufeli')
          AND kriter.kriter_id=5
          GROUP BY santral.santral_id; ";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $santral_kapasitesiC3=$data['santral_kapasitesi'];
            ?>
            ['<?php echo $santral_adi; ?>', <?php echo $santral_kapasitesiC3; ?>],
            <?php

          }

            ?>

        ]);

        var options = {
          title: 'Net Hidrolojik düşü kriterine göre Alternatifler',
          hAxis: {title: 'Alternatifler',minValue: 0, maxValue: 3},
          vAxis: {title: 'Net Hidrolojik düşü',minValue: 0, maxValue: 3},
          legend: { position: 'center' },
          height:500,
          width:900,
          colors: ['#228B22'],
          seriesType: 'bars',
          series: {5: {type: 'line'}}
          

        };

        var chart = new google.visualization.ComboChart(document.getElementById('curve_chart3'));

        chart.draw(data, options);
      }
    </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Santral Adı', 'Depo Kapasitesi'],
          <?php
          $query="SELECT santral.santral_adi,alternatif.santral_kapasitesi
          FROM alternatif,santral,kriter
          WHERE alternatif.santral_id=santral.santral_id
          AND kriter.kriter_id=alternatif.kriter_id
          and santral.santral_adi IN('Erzurum Aksu HES','Berta Enerji Grubu','Beyhan Barajı Ve HES','Dicle Barajı Ve HES','Çukurca','Dilektaşı','Doğanlı','Eriç','İvme','Kayraktepe','Kemah','Keskin','Konaktepe','Pervani','Silopi Barajı Ve HES','Silvan','Yusufeli')
          AND kriter.kriter_id=2
          GROUP BY santral.santral_id;";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $santral_kapasitesiC4=$data['santral_kapasitesi'];
            ?>
            ['<?php echo $santral_adi; ?>', <?php echo $santral_kapasitesiC4; ?>],
            <?php

          }

            ?>

        ]);

        var options = {
          title: 'Depolama Kapasitesi Alanı kriterine göre Alternatifler',
          hAxis: {title: 'Alternatifler',minValue: 0, maxValue: 3},
          vAxis: {title: 'Depolama Kapasitesi',minValue: 0, maxValue: 3},
          legend: { position: 'center' },
          height:500,
          width:900,
          colors: ['#BC8F8F'],
          seriesType: 'bars',
          series: {5: {type: 'line'}}

        };

        var chart = new google.visualization.ComboChart(document.getElementById('curve_chart4'));

        chart.draw(data, options);
      }
    </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Santral Adı', 'Türbin Sayısı'],
          <?php
          $query="SELECT santral.santral_adi,alternatif.santral_kapasitesi
          FROM alternatif,santral,kriter
          WHERE alternatif.santral_id=santral.santral_id
          AND kriter.kriter_id=alternatif.kriter_id
          and santral.santral_adi IN('Erzurum Aksu HES','Berta Enerji Grubu','Beyhan Barajı Ve HES','Dicle Barajı Ve HES','Çukurca','Dilektaşı','Doğanlı','Eriç','İvme','Kayraktepe','Kemah','Keskin','Konaktepe','Pervani','Silopi Barajı Ve HES','Silvan','Yusufeli')
          AND kriter.kriter_id=6
          GROUP BY santral.santral_id; ";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $santral_kapasitesiC5=$data['santral_kapasitesi'];
            ?>
            ['<?php echo $santral_adi; ?>', <?php echo $santral_kapasitesiC5; ?>],
            <?php

          }

            ?>

        ]);

        var options = {
          title: 'Türbin Sayısı kriterine göre Alternatifler',
          hAxis: {title: 'Alternatifler',minValue: 0, maxValue: 3},
          vAxis: {title: 'Türbin Sayısı',minValue: 0, maxValue: 3},
          legend: { position: 'center' },
          height:500,
          width:900,
          pointShape: 'circle',
          colors: ['#EE82EE'],
          seriesType: 'bars',
          series: {5: {type: 'line'}}

        };

        var chart = new google.visualization.ComboChart(document.getElementById('curve_chart5'));

        chart.draw(data, options);
      }
    </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Santral Adı', 'Su Seviyesi'],
          <?php
          $query="SELECT santral.santral_adi,alternatif.santral_kapasitesi
          FROM alternatif,santral,kriter
          WHERE alternatif.santral_id=santral.santral_id
          AND kriter.kriter_id=alternatif.kriter_id
          and santral.santral_adi IN('Erzurum Aksu HES','Berta Enerji Grubu','Beyhan Barajı Ve HES','Dicle Barajı Ve HES','Çukurca','Dilektaşı','Doğanlı','Eriç','İvme','Kayraktepe','Kemah','Keskin','Konaktepe','Pervani','Silopi Barajı Ve HES','Silvan','Yusufeli')
          AND kriter.kriter_id=7
          GROUP BY santral.santral_id; ";
          $res=mysqli_query($conn,$query);
          while($data=mysqli_fetch_array($res)){
            $santral_adi=$data['santral_adi'];
            $santral_kapasitesiC6=$data['santral_kapasitesi'];
            ?>
            ['<?php echo $santral_adi; ?>', <?php echo $santral_kapasitesiC6; ?>],
            <?php

          }

            ?>

        ]);

        var options = {
          title: 'Su Seviyesi kriterine göre Alternatifler',
          hAxis: {title: 'Alternatifler',minValue: 0, maxValue: 3},
          vAxis: {title: 'Su Seviyesi',minValue: 0, maxValue: 3},
          legend: { position: 'center' },
          height:500,
          width:900,
          pointShape: 'circle',
          colors: ['#9ACD32'],
          seriesType: 'bars',
          series: {5: {type: 'line'}}

        };

        var chart = new google.visualization.ComboChart(document.getElementById('curve_chart6'));

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
    <h1 class="heading" style="text-align: center; color: #e4b4b4; padding: 2rem;">Tüm <span>Alternatiflerin</span> Belirlenmesi</h1>
    <p style="font-size: 1.5rem; color: #717171; font-family: 'Poppins', cursive; text-align: center;"> Bu aşamada seçim veya sıralama yapmak için göz önünde bulundurulması gereken tüm
alternatifler karar vericiler tarafından belirlenir.</p>
        <div class="box-container" style="padding: 1rem;">
            <div class="box" id="curve_chart" style="width: 960px; ">
            </div>
            <div class="box" id="curve_chart2"  style="width: 960px;">
            </div>
        </div>
        <div class="box-container">
            <div class="box" id="curve_chart3" style="width: 960px;">
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
