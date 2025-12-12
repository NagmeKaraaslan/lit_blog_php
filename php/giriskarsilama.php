<?php
session_start();
if (empty($_POST)){
    echo "giriş yapmadınız.";
    header("Location:/giris.html");
    echo "<p><a href='giris.html'>Giriş Formu</a></p>";
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
    echo "kullanici adı ve ya şifre hatalı.";
    header("Refresh: 2; url=/giris.html");
    echo "<p><a href='giris.html'>Giriş Formu</a></p>";
    exit;
}

if (!password_verify( $_POST["sifre"], $kayit["sifre"])) {
    echo "Kullanıcı adı veya şifre hatalı!";
    header("Refresh: 2; url=/giris.html");
    echo "<p><a href='giris.html'>Giriş Formu</a></p>";
    exit;
}
