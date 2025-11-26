<?php

if(empty($_POST["kullanici"])) {
    echo "Kullanici adı girilmemeiş!";
    header("Refresh: 3; url=kayit.html");
    echo "<p><a href='kayitform.html'>Kayıt Formu</a></p>";
    exit;
}

var_dump($_POST);

try {
  $vt = new PDO("mysql:dbname=site;host=localhost;charset=utf8","root", "");
  $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}



$sql = "INSERT INTO uye (ad, soyad, kullaniciAd, mail, sifre) values (:ad, :soyad, :kullaniciAd, :mail, :sifre)";
$ifade = $vt->prepare($sql);
$ifade->execute(
    [
        ":ad"        => $_POST["ad"],
        ":soyad"     => $_POST["soyad"],
        ":kullaniciAd" => $_POST["kullanici"],
        ":mail"    => $_POST["mail"],
        ":sifre"     => $_POST["sifre1"],
    ]
);

$vt = null;
?>