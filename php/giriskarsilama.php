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
        $kullanici = htmlspecialchars($_POST['kullanici'] ?? 'Bilinmiyor');
        
        header("Refresh: 3; url=kayit.html");
        echo "<p><a href='kayit.html'>Kayıt Formu</a></p>";
    } else {
        echo "<p>Form verileri alınamadı.</p>";
    }

    

    ?>

    <a href="posts.php">
        Post sayfasına git.
    </a>
</body>
</html>