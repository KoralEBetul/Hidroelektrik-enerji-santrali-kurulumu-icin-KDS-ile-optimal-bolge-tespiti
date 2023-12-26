<?php

include 'y_enerji_DB.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

// ...

if(isset($_POST['delete'])){
    // Check if 'delete_id' is set before using it
    $delete_id = isset($_POST['delete_id']) ? (int)$_POST['delete_id'] : 0; // Cast to int, default to 0 if not set
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_NUMBER_INT); // Ensure it's a valid integer

    try {
        // Debug information
        echo "Delete ID: " . $delete_id . "<br>";

        $delete_playlist = $conn->prepare("DELETE FROM `santral` WHERE santral_id = ?");
        $delete_playlist->execute([$delete_id]);

        // Debug information
        echo "Rows affected: " . $delete_playlist->rowCount() . "<br>";

        if($delete_playlist->rowCount() > 0){
            // Successfully deleted, you can add any further logic here
            $message[] = 'Santral silindi!';
        } else {
            $message[] = 'Santral zaten silindi!';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}




?>



<!DOCTYPE html>
<html lang="tr-TR">
<head>
    <meta http-equiv="content-type" content="text-html"; charset="utf-8">
    <meta charset="UTF-8">
    <meta http-equiv="content-language" content="tr">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link type="image/png" rel="icon" href="images/teias_logo.png">
   <title>Santral</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/main.css">
   <style>
    section {
        margin: 40px; /* Örnek: Kenar boşluğunu büyütme */
    }

    .boxgymbaslik {
        font-size: 24px; /* Örnek: Yazı boyutunu büyütme */
        text-align: center;
        margin-bottom: 30px; /* Örnek: Boşluğu büyütme */
    }

    .box {
        border: 2px solid #ddd; /* Örnek: Sınır kalınlığını büyütme */
        border-radius: 10px; /* Örnek: Köşe yuvarlama miktarını artırma */
        padding: 20px; /* Örnek: İç boşluğu büyütme */
        margin-bottom: 30px;
    }

    table {
        width: 120%; /* Örnek: Tablo genişliğini büyütme */
        border-collapse: collapse;
        margin-top: 30px;
        font-size: 20px;
    }

    th, td {
        border: 2px solid #ddd;
        padding: 12px; /* Örnek: Hücre iç boşluğunu büyütme */
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-size: 18px; /* Örnek: Başlık yazı boyutunu büyütme */
    }

    .delete-btn {
        padding: 8px 16px; /* Örnek: Buton boyutunu büyütme */
        border-radius: 5px;
        cursor: pointer;
    }

    .empty {
        font-size: 18px; /* Örnek: Yazı boyutunu büyütme */
        text-align: center;
        color: #777;
        margin-top: 30px;
    }

    .add-alternative-btn {
    background-color: #4CAF50; /* Yeşil arka plan rengi */
    color: #fff; /* Beyaz metin rengi */
    padding: 10px 20px; /* Butonun iç içe geçmiş iç boşluğu */
    text-align: center; /* Metni ortala */
    text-decoration: none; /* Metin altı çizgisi olmasın */
    display: inline-block; /* Metni blok öğe olarak göster */
    font-size: 16px; /* Metin boyutu */
    margin: 4px 2px; /* Dış boşluk */
    cursor: pointer; /* İmleci el simgesi yap */
    border-radius: 5px; /* Kenarları yuvarla */
}

.add-alternative-btn:hover {
    background-color: #45a049; /* Hover durumunda arka plan rengini değiştir */
}

</style>



</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/admin_header.php'; ?>
<!-- header section ends -->


<!--! add gym section start -->

<section > 
        <h1 class="heading">Tüm <span>Hidroelektrik</span> Santral Alternatifleri</h1>
        


        <div >
            <div class="boxgymbaslik" style="text-align: center;">
                <h3 class="title" style="margin-bottom: .5rem;">Yeni Santral Oluştur</h3>
                <a href="add_santral.php" class="btn">Santral Ekle</a>
            </div>

            
            <div class="box">
                <?php
                    // Örnek kriter: enerji_id'si 6 olan hidroelektrik santralları listele
                    $select_santrals = $conn->prepare("
                        SELECT santral.*, yenilenebilir_enerji.enerji_adi 
                        FROM santral
                        INNER JOIN yenilenebilir_enerji ON santral.enerji_id = yenilenebilir_enerji.enerji_id
                        WHERE santral.enerji_id = 6
                        ORDER BY santral.santral_id");
                    $select_santrals->execute();
                    $santrals = $select_santrals->fetchAll(PDO::FETCH_ASSOC);
                ?>
                

                <!-- Tablo oluşturulması -->
                <table>
                    <tbody>
                        <?php foreach ($santrals as $santral): ?>
                            <tr>
                                <td><?= $santral['santral_id']; ?></td>
                                <td><?= $santral['enerji_adi']; ?></td>
                                <td><?= $santral['santral_adi']; ?></td> <!-- İhtiyaca göre sütunları buraya ekleyin -->
                                <td>




                                <form method="post" action="">
                                    <input type="hidden" name="delete_id" value="<?= $santral['santral_id']; ?>">
                                    <input type="submit" value="delete" class="delete-btn" onclick="return confirm('Santralı Silmek İstediğine Emin misin?');" name="delete">
                                </form>
                                <form method="get" action="add_alternatif.php">
                                    <input type="hidden" name="santral_id" value="<?= $santral['santral_id']; ?>">
                                    <input type="submit" value="Alternatif Ekle" class="add-alternative-btn">
                                </form>
                                    




                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
                
            

        </div>


    </section>


    <!--! add gym section end -->




<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/admin_script.js"></script>
<script>
   document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>

<?php include 'components/message.php'; ?>

</body>
</html>