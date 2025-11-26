<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Başarılı</title>
</head>
<body>

    <h2>Hoş Geldiniz!</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $kullanici_adi = htmlspecialchars($_POST['kullanici'] ?? 'Bilinmiyor');
        
        echo "<p>Giriş başarılı. Sayın **$kullanici**.</p>";

        // Diğer form verilerini de burada yazdırabilirsiniz
        // $sifre = htmlspecialchars($_POST['sifre'] ?? 'Gizli');
        // echo "<p>Şifreniz: $sifre</p>"; 
    } else {
        echo "<p>Form verileri alınamadı.</p>";
    }
    ?>

    <a href="index.php" class="anasyf_btn">
        Anasayfaya Git
    </a>

</body>
</html>