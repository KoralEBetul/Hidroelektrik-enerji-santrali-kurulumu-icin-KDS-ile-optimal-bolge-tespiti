<?php
try{
    $VeritabaniBaglantisi = new PDO("mysql:host=localhost;dbname=enerji;charset=UTF8","root","");
    // echo "Veri tabanı başarılı";
}catch(PDOException $Hata){
     // echo "Bağlantı Hatası<br /> " . $Hata->getMessage(); //  
    die();
}

function create_unique_id(){
    $str = 'abcçdefgğhıijklmnoöprsştuüvyzABCÇDEFGĞHIİJKLMNOÖPRSŞTUÜVYZ1234567890';
    $rand = array();
    $lenght = strlen($str) - 1;


    for($i = 0; $i <20; $i++){
        $n = mt_rand(0, $lenght);
        $rand[] = $str[$n];
    }
    return implode($rand);
}

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM minumum_c1_vij");
$AyarlarSorgusu->execute();
$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if($AyarSayisi>0){
    $minumum            = $Ayar["minumum"];
    $santral_adi          = $Ayar["santral_adi"];
    
}else{
    //echo "Site Ayar Sorgusu Hatalı"; // 
    die();
}

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM minumum_c2_vij");
$AyarlarSorgusu->execute();
$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if($AyarSayisi>0){
    $santral_adi             = $Ayar["santral_adi"];
    $minumumc2           = $Ayar["kritere_gore_santral_vij"];
    
}else{
    //echo "Site Ayar Sorgusu Hatalı"; // 
    die();
}



$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM maksimum_c2_vij");
$AyarlarSorgusu->execute();
$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if($AyarSayisi>0){
    $santral_adi          = $Ayar["santral_adi"];
    $maksimum            = $Ayar["kritere_gore_santral_vij"];

    
}else{
    //echo "Site Ayar Sorgusu Hatalı"; // 
    die();
}




$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM minumum_c3_vij LIMIT 1");
$AyarlarSorgusu->execute();
$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if($AyarSayisi>0){
    $maksimumc3             = $Ayar["maksimum"];
    $minumumc3           = $Ayar["minumum"];
    
}else{
    //echo "Site Ayar Sorgusu Hatalı"; // 
    die();
}

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM minumum_c4_vij LIMIT 1");
$AyarlarSorgusu->execute();
$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if($AyarSayisi>0){
    $maksimumc4             = $Ayar["maksimum"];
    $minumumc4           = $Ayar["minumum"];
    
}else{
    //echo "Site Ayar Sorgusu Hatalı"; // 
    die();
}

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM minumum_c5_vij LIMIT 1");
$AyarlarSorgusu->execute();
$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if($AyarSayisi>0){
    $maksimumc5             = $Ayar["maksimum"];
    $minumumc5           = $Ayar["minumum"];
    
}else{
    //echo "Site Ayar Sorgusu Hatalı"; // 
    die();
}
$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM minumum_c6_vij LIMIT 1");
$AyarlarSorgusu->execute();
$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if($AyarSayisi>0){
    $maksimumc6             = $Ayar["maksimum"];
    $minumumc6           = $Ayar["minumum"];
    
}else{
    //echo "Site Ayar Sorgusu Hatalı"; // 
    die();
}


$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM ci_sonuc_maks_min LIMIT 1");
$AyarlarSorgusu->execute();
$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if($AyarSayisi>0){
    $maksimumci             = $Ayar["maksimum_ci"];
    $minumumci           = $Ayar["minumum"];
    
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