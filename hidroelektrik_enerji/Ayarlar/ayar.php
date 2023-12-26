<?php
try{
    $VeritabaniBaglantisi = new PDO("mysql:host=localhost;dbname=bireysel_antrenor;charset=UTF8","root","");
    // echo "Veri tabanı başarılı";
}catch(PDOException $Hata){
     // echo "Bağlantı Hatası<br /> " . $Hata->getMessage(); //  
    die();
}

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM ayarlar LIMIT 1");
$AyarlarSorgusu->execute();
$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if($AyarSayisi>0){
    $SiteAdi             = $Ayar["SiteAdi"];
    $SiteTitle           = $Ayar["SiteTitle"];
    $SiteDescription     = $Ayar["SiteDescription"];
    $SiteKeywords        = $Ayar["SiteKeywords"];
    $SiteCopyrightMetni  = $Ayar["SiteCopyrightMetni"];
    $SiteLogosu          = $Ayar["SiteLogosu"];
    $SiteLinki           = $Ayar["SiteLinki"];
    $SiteEmailAdresi     = $Ayar["SiteEmailAdresi"];
    $SiteEmailSifresi    = $Ayar["SiteEmailSifresi"];
    $SiteEmailHostAdresi  =      $Ayar["SiteEmailHostAdresi"];
    $SosyalLinkInstagram  =      $Ayar["SosyalLinkInstagram"];
    $SosyalLinkTwitter    =      $Ayar["SosyalLinkTwitter"];
    $SosyalLinkLınkedIn   =      $Ayar["SosyalLinkLinkedin"];
    $SosyalLinkPinterest  =      $Ayar["SosyalLinkPinterest"];
    $SosyalLinkFacebook   =      $Ayar["SosyalLinkFacebook"];
}else{
    //echo "Site Ayar Sorgusu Hatalı"; // 
    die();
}

if(isset($_SESSION["Kullanici"])){
    $KullaniciSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM uye WHERE EmailAdresi = " . $_SESSION["Kullanici"] . " LIMIT 1");
    $KullaniciSorgusu->execute();
    $KullaniciSayisi = $KullaniciSorgusu->rowCount();
    $Kullanici = $KullaniciSorgusu->fetch(PDO::FETCH_ASSOC);

    if($KullaniciSayisi>0){
        $KullaniciID      =      $Kullanici["uyeler_id"];
        $EmailAdresi      =      $Kullanici["EmailAdresi"];
        $Sifre            =      $Kullanici["Sifre"];
        $IsimSoyisim      =      $Kullanici["IsimSoyisim"];
        $TelefonNumarasi  =      $Kullanici["TelefonNumarasi"];
        $uye_dogum_tarihi  =     $Kullanici["uye_dogum_tarihi"];
        $Cinsiyet         =      $Kullanici["Cinsiyet"];
        $Durumu           =      $Kullanici["Durumu"];
        $KayitTarihi      =      $Kullanici["KayitTarihi"];
        $KayitIpAdresi    =      $Kullanici["KayitIpAdresi"];
        $AktivasyonKodu    =     $Kullanici["AktivasyonKodu"];
    }else{
        //echo "Site Kullanici Sorgusu Hatalı<br />" . $Hata->getMessage(); 
        die();
    }
}
?>