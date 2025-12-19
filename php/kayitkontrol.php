<?php
session_start();
if(empty($_POST["kullanici"])) {
    echo "Kullanici adı girilmemeiş!";
    header("Refresh: 3; url=kayit.html");
    echo "<p><a href='kayit.html'>Kayıt Formu</a></p>";
    exit;
}

$kullanici = trim($_POST["kullanici"]);
if(strlen($kullanici < 3)){
  echo "Kullanıcı isminiz 3karakterden fazla olamlı.";
  header("Refresh: 3; yrl=kayit.html");
  echo "<p><a href='kayitform.html'>Kayıt Formu</a></p>";
  exit;
}


//eposta kontrolu

if(!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)){
    echo "Gerçek bir eposta giriniz.";
    header("Refresh: 3; url=kayit.html");
    echo "<p><a href='kayit.html'>Kayıt Formu</a></p>";
    exit;
}

//şifre kontrolu
if(empty($_POST["sifre1"])) {
  echo "Şifre boş olamaz.";
  header("Refresh: 3; url=kayit.html");
  echo "<p><a href='kayit.html'>Kayıt Formu</a></p>";
  exit;
}

if($_POST["sifre1"] != $_POST["sifre2"]){
  echo "Şifre tekrarı aynı değil.";
  header("Refresh: 3; url=kayit.html");
  echo "<p><a href='kayit.html'>Kayıt Formu</a></p>";
  exit;
}
 
if(strlen($_POST["sifre1"])<3){
  echo "Şifre 3 karakterden uzun olmalı";
  header("Refresh: 3; url=kayit.html");
  echo "<p><a href='kayit.html'>Kayıt Formu</a></p>";
  exit;
}

//sifreyi decode etmek
$sifre = password_hash(($_POST["sifre1"]), PASSWORD_DEFAULT);

var_dump($_POST);

try {
  $vt = new PDO("mysql:dbname=litblog;host=localhost;charset=utf8","root", "");
  $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}



$sql = "INSERT INTO uye (ad, soyad, kullaniciAd, mail, sifre, cinsiyet) values (:ad, :soyad, :kullaniciAd, :mail, :sifre, :cinsiyet)";
$ifade = $vt->prepare($sql);
$ifade->execute(
    [
        ":ad"        => $_POST["ad"],
        ":soyad"     => $_POST["soyad"],
        ":kullaniciAd" => $_POST["kullanici"],
        ":mail"    => $_POST["mail"],
        ":cinsiyet" => $_POST["gen"],
        ":sifre"     => $sifre
    ]
);

$vt = null;
?>