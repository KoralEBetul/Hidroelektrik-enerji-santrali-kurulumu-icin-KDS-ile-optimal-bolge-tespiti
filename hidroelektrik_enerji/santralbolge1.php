<!DOCTYPE html>
<html lang="TR">
    <head>
    <meta http-equiv="content-type" content="text-html"; charset="utf-8">
    <meta charset="UTF-8">
    <meta http-equiv="content-language" content="tr">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css -->
    <link rel="stylesheet" href="css/style.css">


    <!--boxicon css -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Yönetim paneli
    </title>
    <link type="image/png" rel="icon" href="images/teias_logo.png">
    <script type="text/javascript" src="Ayarlar/fonksiyonlar.js" language="javascript"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    




    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: Because this chart requires geocoding, you'll need mapsApiKey.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Şehir',   'Santral'],
          ['Elazığ', 'Beyhan Barajı ve HES'],  
          ['Diyarbakır', 'Dicle Barajı ve HES'],  
          ['Erzurum', 'Erzurum Aksu HES'],  
          ['Artvin', 'Berta Enerji Grubu'],
          ['Şırnak', 'Silopi Barajı ve HES'],  
          ['Hakkari', 'Çukurca'],
          ['Hakkari', 'Dilektaşı'],
          ['Hakkari', 'Doğanlı'],
          ['Erzincan', 'Eriç'],
          ['Batman', 'İvme'],
          ['Mersin', 'Kayraktepe'],
          ['Erzincan', 'Kemah'],
          ['Siirt', 'Keskin'],
          ['Tunceli', 'Konaktepe'],
          ['Siirt', 'Pervani'],
          ['Diyarbakır', 'Silvan'],
          ['Artvin', 'Yusufeli']




        ]);

        var options = {
          region: 'TR', // Türkiye
        resolution: 'provinces',
          colorAxis: {colors: ['#00853f', 'black', '#e31b23']},
          backgroundColor: '#cdebf6',
          datalessRegionColor: '#f7f2dc',
          defaultColor: '#d0d92c',
        };

        var chart = new google.visualization.GeoChart(document.getElementById('geochart-colors'));
        chart.draw(data, options);
      };
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
        <section class="home">
            <div class="text"><h1 class="" style="font-size: 30px; margin:auto; text-align:center; padding: 2rem;">ÇOK KRİTERLİ KARAR VERME YÖNTEMLERİ İLE <span>TÜRKİYE’DE  HES (HİDROELEKTRİK SANTRAL) 
                </span>SEÇİMİ</h1>
            </div>
            <div class="box-container">
                <div class="santralbolge" style="font-size: 16px; color: #717171; font-family: 'Poppins', cursive; text-align:center;">
                    <h1 style="color: #C17B9E;">HES İçin Yer Seçilmesi</h1>
                    <p style="font-size: 25px; color: #717171; font-family: 'Poppins', cursive;">  Çalışma kapsamında seçilen barajların küçük ve orta büyüklükte olmasına özen gösterilmiştir.
                        Seçilmiş olan barajların hepsi 2000 senesi sonrasında inşa edilmiştir. Çalışmanın tutarlılığı açısından barajlarda gerçekleştirilecek teknik analiz sonuçlarının birbiriyle benzerlik gösterilmesi
                        hususuna dikkat edilmiştir. Bu bağlamda toplam 17 baraj belirlenmiştir. Bu barajlar alfabetik
                        sıraya göre aşağıdaki gibidir: <br> Aksu Barajı (Erzurum), Berta Barajı (Artvin), Beyhan Barajı
                        (Elazığ), Cizre Barajı (Diyarbakır), Çukurca Barajı (Hakkari), Dilektaşı Barajı (Hakkari), Doğanlı
                        Barajı (Hakkari), Eriç Barajı (Erzincan), İvme Barajı (Batman), Kayraktepe Barajı (Mersin),
                        Kemah Barajı (Erzincan), Keskin Barajı (Siirt), Konaktepe Barajı (Tunceli), Pervani Barajı (Siirt),
                        Silopi Barajı (Mardin), Silvan Barajı (Diyarbakır), Yusufeli Barajı (Artvin)
                    </p>
                </div>
            </div>
            <div class="box-container">
                <div class="box" id="geochart-colors" style="width: 1550px; height: 10px; padding:50px; margin:auto; ">
                    
                    
                </div>
            </div>
        </section>
         <!--! menu section start -->
    

        <script src="js/script.js"></script>

    </body>
</html>