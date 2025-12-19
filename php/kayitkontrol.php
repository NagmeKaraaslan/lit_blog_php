<?php
session_start();
if(empty($_POST["kullanici"])) {
    header("Refresh: 3; url=kayit.html");
    echo "Kullanici adı girilmemiş!";
    echo "<p><a href='../kayit.html'>Kayıt Formu</a></p>";
    exit;
}

$kullanici = trim($_POST["kullanici"]);
if(strlen($kullanici < 3)){
  header("Refresh: 3; url=kayit.html");
  echo "Kullanıcı isminiz 3karakterden fazla olamlı.";
  echo "<p><a href='kayitform.html'>Kayıt Formu</a></p>";
  exit;
}


//eposta kontrolu

if(!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)){
    header("Refresh: 3; url=kayit.html");
    echo "Gerçek bir eposta giriniz.";
    echo "<p><a href='kayit.html'>Kayıt Formu</a></p>";
    exit;
}

//şifre kontrolu
if(empty($_POST["sifre1"])) {
  header("Refresh: 3; url=kayit.html");
  echo "Şifre boş olamaz.";
  echo "<p><a href='kayit.html'>Kayıt Formu</a></p>";
  exit;
}

if($_POST["sifre1"] != $_POST["sifre2"]){
  header("Refresh: 3; url=kayit.html");
  echo "Şifre tekrarı aynı değil.";
  echo "<p><a href='kayit.html'>Kayıt Formu</a></p>";
  exit;
}
 
if(strlen($_POST["sifre1"])<3){
  header("Refresh: 3; url=kayit.html");
  echo "Şifre 3 karakterden uzun olmalı";
  echo "<p><a href='kayit.html'>Kayıt Formu</a></p>";
  exit;
}

//sifreyi decode etmek
$sifre = password_hash(($_POST["sifre1"]), PASSWORD_DEFAULT);

try {
    $vt = new PDO(
        "mysql:dbname=litblog;host=localhost;charset=utf8",
        "root",
        ""
    );
    $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "DB bağlantı hatası: " . $e->getMessage();
    exit;
}

try {
    $sql = "INSERT INTO uye 
    (kullaniciAd, ad, soyad, mail, sifre, cinsiyet)
    VALUES
    (:kullaniciAd, :ad, :soyad, :mail, :sifre, :cinsiyet)";

    $ifade = $vt->prepare($sql);
    $ifade->execute([
        ":kullaniciAd" => $_POST["kullanici"],
        ":ad"          => $_POST["ad"],
        ":soyad"       => $_POST["soyad"],
        ":mail"        => $_POST["mail"],
        ":sifre"       => password_hash($_POST["sifre1"], PASSWORD_DEFAULT),
        ":cinsiyet"    => $_POST["gen"]
    ]);
    echo "Kayıt başarılı, giriş sayfasına yönlendiriliyorsunuz...";
    header("Refresh: 2; url=../giris.html");
    exit;
} catch (PDOException $e) {
    echo "Kayıt hatası: " . $e->getMessage();
    exit;
}
?>