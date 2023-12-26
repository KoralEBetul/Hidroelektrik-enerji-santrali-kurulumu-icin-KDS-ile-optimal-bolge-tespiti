<?php
$db_name = 'mysql:host=localhost;dbname=hidroelektrik';
$db_user_name = 'root';
$db_user_pass = '';

$conn = new PDO($db_name, $db_user_name, $db_user_pass);
try{
    $VeritabaniBaglantisi = new PDO("mysql:host=localhost;dbname=hidroelektrik;charset=UTF8","root","");
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



// Kurulum gücü Maksimum - Minumum değerleri

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("
SELECT * FROM kurulum_gucune_gore_santral_vij_degerleri
WHERE kurulum_gucune_gore_santral_vij_degerleri.kurulum_gucune_gore_santral_vij IN (
    SELECT MIN(kurulum_gucune_gore_santral_vij_degerleri.kurulum_gucune_gore_santral_vij)
    FROM kurulum_gucune_gore_santral_vij_degerleri
)


");

if (!$AyarlarSorgusu) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu->execute()) {
    die("Execute failed: " . $AyarlarSorgusu->errorInfo()[2]);
}

$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi . "<br>"; //HATAYI GÖRMEK İÇİN EKLEDİM

if ($AyarSayisi > 0) {
   // echo "<pre>";
   // print_r($Ayar);
   // echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi1 = array_key_exists("santral_adi", $Ayar) ? $Ayar["santral_adi"] : 'Santral Adı Bulunamadı';
    $kurulumGucu = array_key_exists("kurulum_gucune_gore_santral_vij", $Ayar) ? $Ayar["kurulum_gucune_gore_santral_vij"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.


// Kurulum gücü Maksimum - Minumum değerleri

$AyarlarSorgusu2 = $VeritabaniBaglantisi->prepare("
SELECT * FROM kurulum_gucune_gore_santral_vij_degerleri
WHERE kurulum_gucune_gore_santral_vij_degerleri.kurulum_gucune_gore_santral_vij IN (
    SELECT MAX(kurulum_gucune_gore_santral_vij_degerleri.kurulum_gucune_gore_santral_vij)
    FROM kurulum_gucune_gore_santral_vij_degerleri
)


");

if (!$AyarlarSorgusu2) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu2->execute()) {
    die("Execute failed: " . $AyarlarSorgusu2->errorInfo()[2]);
}

$AyarSayisi2 = $AyarlarSorgusu2->rowCount();
$Ayar2 = $AyarlarSorgusu2->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi2 . "<br>";

if ($AyarSayisi2 > 0) {
   // echo "<pre>";
   //  print_r($Ayar2);
   //  echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi2 = array_key_exists("santral_adi", $Ayar2) ? $Ayar2["santral_adi"] : 'Santral Adı Bulunamadı';
    $kurulumGucuMaks = array_key_exists("kurulum_gucune_gore_santral_vij", $Ayar2) ? $Ayar2["kurulum_gucune_gore_santral_vij"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.












// Yıllık enerji üretim kapasitesi Maksimum - Minumum değerleri

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("
SELECT * FROM yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri
WHERE yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri.yillik_e_uretim_kap_gore_santral_vij_degeri IN (
    SELECT MIN(yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri.yillik_e_uretim_kap_gore_santral_vij_degeri)
    FROM yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri
);


");

if (!$AyarlarSorgusu) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu->execute()) {
    die("Execute failed: " . $AyarlarSorgusu->errorInfo()[2]);
}

$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi . "<br>";

if ($AyarSayisi > 0) {
   //  echo "<pre>";
   //  print_r($Ayar);
   //  echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi3 = array_key_exists("santral_adi", $Ayar) ? $Ayar["santral_adi"] : 'Santral Adı Bulunamadı';
    $yillik_e_uretimMin = array_key_exists("yillik_e_uretim_kap_gore_santral_vij_degeri", $Ayar) ? $Ayar["yillik_e_uretim_kap_gore_santral_vij_degeri"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.


// Yıllık enerji üretim kapasitesi Maksimum - Minumum değerleri

$AyarlarSorgusu2 = $VeritabaniBaglantisi->prepare("
SELECT * FROM yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri
WHERE yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri.yillik_e_uretim_kap_gore_santral_vij_degeri IN (
    SELECT MAX(yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri.yillik_e_uretim_kap_gore_santral_vij_degeri)
    FROM yillik_e_uretim_kapasitesine_gore_santral_vij_degerleri
);


");

if (!$AyarlarSorgusu2) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu2->execute()) {
    die("Execute failed: " . $AyarlarSorgusu2->errorInfo()[2]);
}

$AyarSayisi2 = $AyarlarSorgusu2->rowCount();
$Ayar2 = $AyarlarSorgusu2->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi2 . "<br>";

if ($AyarSayisi2 > 0) {
    // echo "<pre>";
    // print_r($Ayar2);
    // echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi4 = array_key_exists("santral_adi", $Ayar2) ? $Ayar2["santral_adi"] : 'Santral Adı Bulunamadı';
    $yillik_e_uretimMaks = array_key_exists("yillik_e_uretim_kap_gore_santral_vij_degeri", $Ayar2) ? $Ayar2["yillik_e_uretim_kap_gore_santral_vij_degeri"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.








// Net Hidrolojik düşü Maksimum - Minumum değerleri

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("
SELECT * FROM hidrolojik_düsüye_gore_santral_vij_degerleri
WHERE hidrolojik_düsüye_gore_santral_vij_degerleri.net_hidr_düsüye_gore_santral_vij_degerleri IN (
    SELECT MIN(hidrolojik_düsüye_gore_santral_vij_degerleri.net_hidr_düsüye_gore_santral_vij_degerleri)
    FROM hidrolojik_düsüye_gore_santral_vij_degerleri
);


");

if (!$AyarlarSorgusu) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu->execute()) {
    die("Execute failed: " . $AyarlarSorgusu->errorInfo()[2]);
}

$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi . "<br>";

if ($AyarSayisi > 0) {
    // echo "<pre>";
    // print_r($Ayar);
    // echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi5 = array_key_exists("santral_adi", $Ayar) ? $Ayar["santral_adi"] : 'Santral Adı Bulunamadı';
    $hidr_dusuMin = array_key_exists("net_hidr_düsüye_gore_santral_vij_degerleri", $Ayar) ? $Ayar["net_hidr_düsüye_gore_santral_vij_degerleri"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.


// Net Hidrolojik düşü Maksimum - Minumum değerleri

$AyarlarSorgusu2 = $VeritabaniBaglantisi->prepare("
SELECT * FROM hidrolojik_düsüye_gore_santral_vij_degerleri
WHERE hidrolojik_düsüye_gore_santral_vij_degerleri.net_hidr_düsüye_gore_santral_vij_degerleri IN (
    SELECT MAX(hidrolojik_düsüye_gore_santral_vij_degerleri.net_hidr_düsüye_gore_santral_vij_degerleri)
    FROM hidrolojik_düsüye_gore_santral_vij_degerleri
);


");

if (!$AyarlarSorgusu2) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu2->execute()) {
    die("Execute failed: " . $AyarlarSorgusu2->errorInfo()[2]);
}

$AyarSayisi2 = $AyarlarSorgusu2->rowCount();
$Ayar2 = $AyarlarSorgusu2->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi2 . "<br>";

if ($AyarSayisi2 > 0) {
    // echo "<pre>";
   //  print_r($Ayar2);
   //  echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi6 = array_key_exists("santral_adi", $Ayar2) ? $Ayar2["santral_adi"] : 'Santral Adı Bulunamadı';
    $hidr_dusuMaks = array_key_exists("net_hidr_düsüye_gore_santral_vij_degerleri", $Ayar2) ? $Ayar2["net_hidr_düsüye_gore_santral_vij_degerleri"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.



// Depolama Kapasitesi Alanı Maksimum - Minumum değerleri

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("
SELECT * FROM dep_kapasitesi_alanina_gore_santral_vij_degerleri
WHERE dep_kapasitesi_alanina_gore_santral_vij_degerleri.dep_kapasitesi_alanina_gore_santral_vij_degerleri IN (
    SELECT MIN(dep_kapasitesi_alanina_gore_santral_vij_degerleri.dep_kapasitesi_alanina_gore_santral_vij_degerleri)
    FROM dep_kapasitesi_alanina_gore_santral_vij_degerleri
);


");

if (!$AyarlarSorgusu) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu->execute()) {
    die("Execute failed: " . $AyarlarSorgusu->errorInfo()[2]);
}

$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi . "<br>";

if ($AyarSayisi > 0) {
    // echo "<pre>";
   //  print_r($Ayar);
   //  echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi7 = array_key_exists("santral_adi", $Ayar) ? $Ayar["santral_adi"] : 'Santral Adı Bulunamadı';
    $depo_kapasitesiMin = array_key_exists("dep_kapasitesi_alanina_gore_santral_vij_degerleri", $Ayar) ? $Ayar["dep_kapasitesi_alanina_gore_santral_vij_degerleri"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.


// Depolama Kapasitesi Alanı Maksimum - Minumum değerleri

$AyarlarSorgusu2 = $VeritabaniBaglantisi->prepare("
SELECT * FROM dep_kapasitesi_alanina_gore_santral_vij_degerleri
WHERE dep_kapasitesi_alanina_gore_santral_vij_degerleri.dep_kapasitesi_alanina_gore_santral_vij_degerleri IN (
    SELECT MAX(dep_kapasitesi_alanina_gore_santral_vij_degerleri.dep_kapasitesi_alanina_gore_santral_vij_degerleri)
    FROM dep_kapasitesi_alanina_gore_santral_vij_degerleri
);


");

if (!$AyarlarSorgusu2) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu2->execute()) {
    die("Execute failed: " . $AyarlarSorgusu2->errorInfo()[2]);
}

$AyarSayisi2 = $AyarlarSorgusu2->rowCount();
$Ayar2 = $AyarlarSorgusu2->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi2 . "<br>";

if ($AyarSayisi2 > 0) {
   //  echo "<pre>";
   //  print_r($Ayar2);
  //   echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi8 = array_key_exists("santral_adi", $Ayar2) ? $Ayar2["santral_adi"] : 'Santral Adı Bulunamadı';
    $depo_kapasitesiMaks = array_key_exists("dep_kapasitesi_alanina_gore_santral_vij_degerleri", $Ayar2) ? $Ayar2["dep_kapasitesi_alanina_gore_santral_vij_degerleri"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.



// Türbin sayısı Maksimum - Minumum değerleri

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("
SELECT * FROM turbin_sayisina_gore_santral_vij_degerleri
WHERE turbin_sayisina_gore_santral_vij_degerleri.turbin_sayisina_gore_santral_vij_degerleri IN (
    SELECT MIN(turbin_sayisina_gore_santral_vij_degerleri.turbin_sayisina_gore_santral_vij_degerleri)
    FROM turbin_sayisina_gore_santral_vij_degerleri
);


");

if (!$AyarlarSorgusu) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu->execute()) {
    die("Execute failed: " . $AyarlarSorgusu->errorInfo()[2]);
}

$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi . "<br>";

if ($AyarSayisi > 0) {
    // echo "<pre>";
   //  print_r($Ayar);
   //  echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi9 = array_key_exists("santral_adi", $Ayar) ? $Ayar["santral_adi"] : 'Santral Adı Bulunamadı';
    $turbin_sayisiMin = array_key_exists("turbin_sayisina_gore_santral_vij_degerleri", $Ayar) ? $Ayar["turbin_sayisina_gore_santral_vij_degerleri"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.


// Türbin sayısı Maksimum - Minumum değerleri

$AyarlarSorgusu2 = $VeritabaniBaglantisi->prepare("
SELECT * FROM turbin_sayisina_gore_santral_vij_degerleri
WHERE turbin_sayisina_gore_santral_vij_degerleri.turbin_sayisina_gore_santral_vij_degerleri IN (
    SELECT MAX(turbin_sayisina_gore_santral_vij_degerleri.turbin_sayisina_gore_santral_vij_degerleri)
    FROM turbin_sayisina_gore_santral_vij_degerleri
);


");

if (!$AyarlarSorgusu2) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu2->execute()) {
    die("Execute failed: " . $AyarlarSorgusu2->errorInfo()[2]);
}

$AyarSayisi2 = $AyarlarSorgusu2->rowCount();
$Ayar2 = $AyarlarSorgusu2->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi2 . "<br>";   

if ($AyarSayisi2 > 0) {
    // echo "<pre>";
   //  print_r($Ayar2);
   //  echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi10 = array_key_exists("santral_adi", $Ayar2) ? $Ayar2["santral_adi"] : 'Santral Adı Bulunamadı';
    $turbin_sayisiMaks = array_key_exists("turbin_sayisina_gore_santral_vij_degerleri", $Ayar2) ? $Ayar2["turbin_sayisina_gore_santral_vij_degerleri"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.





// Su seviyesi Maksimum - Minumum değerleri

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("
SELECT * FROM su_seviyesine_gore_santral_vij_degerleri
WHERE su_seviyesine_gore_santral_vij_degerleri.su_seviyesine_gore_santral_vij_degerleri IN (
    SELECT MIN(su_seviyesine_gore_santral_vij_degerleri.su_seviyesine_gore_santral_vij_degerleri)
    FROM su_seviyesine_gore_santral_vij_degerleri
);


");

if (!$AyarlarSorgusu) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu->execute()) {
    die("Execute failed: " . $AyarlarSorgusu->errorInfo()[2]);
}

$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi . "<br>";

if ($AyarSayisi > 0) {
   //  echo "<pre>";
   //  print_r($Ayar);
   //  echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi11 = array_key_exists("santral_adi", $Ayar) ? $Ayar["santral_adi"] : 'Santral Adı Bulunamadı';
    $su_seviyesiMin = array_key_exists("su_seviyesine_gore_santral_vij_degerleri", $Ayar) ? $Ayar["su_seviyesine_gore_santral_vij_degerleri"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.


// Su seviyesi Maksimum - Minumum değerleri

$AyarlarSorgusu2 = $VeritabaniBaglantisi->prepare("
SELECT * FROM su_seviyesine_gore_santral_vij_degerleri
WHERE su_seviyesine_gore_santral_vij_degerleri.su_seviyesine_gore_santral_vij_degerleri IN (
    SELECT MAX(su_seviyesine_gore_santral_vij_degerleri.su_seviyesine_gore_santral_vij_degerleri)
    FROM su_seviyesine_gore_santral_vij_degerleri
);


");

if (!$AyarlarSorgusu2) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu2->execute()) {
    die("Execute failed: " . $AyarlarSorgusu2->errorInfo()[2]);
}

$AyarSayisi2 = $AyarlarSorgusu2->rowCount();
$Ayar2 = $AyarlarSorgusu2->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi2 . "<br>";

if ($AyarSayisi2 > 0) {
 //    echo "<pre>";
 //    print_r($Ayar2);
  //   echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi12 = array_key_exists("santral_adi", $Ayar2) ? $Ayar2["santral_adi"] : 'Santral Adı Bulunamadı';
    $su_seviyesiMaks = array_key_exists("su_seviyesine_gore_santral_vij_degerleri", $Ayar2) ? $Ayar2["su_seviyesine_gore_santral_vij_degerleri"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.






// Ci Sonuç Maksimum - Minumum değerleri

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("
SELECT s_negatif.Si_negatif / (si_pozitif.Si_pozitif + s_negatif.Si_negatif) as Ci , s_negatif.santral_adi
from s_negatif,si_pozitif
WHERE s_negatif.santral_adi=si_pozitif.santral_adi
GROUP by s_negatif.santral_adi
Having Ci = (SELECT min(s_negatif.Si_negatif / (si_pozitif.Si_pozitif + s_negatif.Si_negatif)) as Ci_Max
          FROM s_negatif,si_pozitif
          WHERE s_negatif.santral_adi=si_pozitif.santral_adi);


");

if (!$AyarlarSorgusu) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu->execute()) {
    die("Execute failed: " . $AyarlarSorgusu->errorInfo()[2]);
}

$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi . "<br>";

if ($AyarSayisi > 0) {
   //  echo "<pre>";
   //  print_r($Ayar);
   //  echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi13 = array_key_exists("santral_adi", $Ayar) ? $Ayar["santral_adi"] : 'Santral Adı Bulunamadı';
    $Ci = array_key_exists("Ci", $Ayar) ? $Ayar["Ci"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.


// Ci Sonuç Maksimum - Minumum değerleri

$AyarlarSorgusu2 = $VeritabaniBaglantisi->prepare("
SELECT s_negatif.Si_negatif / (si_pozitif.Si_pozitif + s_negatif.Si_negatif) as Ci , s_negatif.santral_adi
from s_negatif,si_pozitif
WHERE s_negatif.santral_adi=si_pozitif.santral_adi
GROUP by s_negatif.santral_adi
Having Ci = (SELECT max(s_negatif.Si_negatif / (si_pozitif.Si_pozitif + s_negatif.Si_negatif)) as Ci_Max
          FROM s_negatif,si_pozitif
          WHERE s_negatif.santral_adi=si_pozitif.santral_adi);

");

if (!$AyarlarSorgusu2) {
    die("Prepare failed: " . $VeritabaniBaglantisi->errorInfo()[2]);
}

if (!$AyarlarSorgusu2->execute()) {
    die("Execute failed: " . $AyarlarSorgusu2->errorInfo()[2]);
}

$AyarSayisi2 = $AyarlarSorgusu2->rowCount();
$Ayar2 = $AyarlarSorgusu2->fetch(PDO::FETCH_ASSOC);

// echo "Number of rows returned: " . $AyarSayisi2 . "<br>";

if ($AyarSayisi2 > 0) {
   //  echo "<pre>";
  //   print_r($Ayar2);
   //  echo "</pre>";

    // Check for the existence of keys before accessing them
    $santral_adi14 = array_key_exists("santral_adi", $Ayar2) ? $Ayar2["santral_adi"] : 'Santral Adı Bulunamadı';
    $CiMaks = array_key_exists("Ci", $Ayar2) ? $Ayar2["Ci"] : 'Değer Bulunamadı';
} else {
    // Handle the case when no rows are returned
    die("No rows returned from the query.");
}

// Now, inspect the printed information and see if it matches your expectations.


?>