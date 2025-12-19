<?php
session_start();
if (empty($_POST)){
    header("Refresh: 3; url=/giris.html");
    echo "giriş yapmadınız.";
    echo "<p><a href='/giris.html'>Giriş Formu</a></p>";
    exit;
}
try {
  $vt = new PDO("mysql:dbname=litblog;host=localhost;charset=utf8","root", "");
  $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}


// Sorgular ve diğer işlemler burada...
$sql = "select * from uye where kullaniciAd = :kullaniciAd";
$ifade = $vt->prepare($sql);
$ifade->execute(
    [":kullaniciAd" => $_POST["kullanici"]]
);

$kayit = $ifade->fetch(PDO::FETCH_ASSOC);

if($kayit == FALSE){
    header("Refresh: 2; url=/giris.html");
    echo "kullanici adı ve ya şifre hatalı.";
    echo "<p><a href='/giris.html'>Giriş Formu</a></p>";
    exit;
}

if (!password_verify( $_POST["sifre"], $kayit["sifre"])) {
    header("Refresh: ; url=/giris.html");
    echo "Kullanıcı adı veya şifre hatalı!";
    echo "<p><a href='/giris.html'>Giriş Formu</a></p>";
    exit;
}

// Giriş başarılı
header("Refresh: 2; url=/php/posts.php");
echo "Başarıyla giriş yaptınız";
echo "<p><a href='lit_blog_php/php/posts.php'>Post sayfasına gidin</a></p>";
exit;