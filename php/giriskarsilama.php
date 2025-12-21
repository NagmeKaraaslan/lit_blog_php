<?php
session_start();
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

$kullanici = trim($_POST["kullaniciAd"]);
// Sorgular ve diğer işlemler burada...
$sql = "select * from uye where kullaniciAd = :kullaniciAd";
$ifade = $vt->prepare($sql);
$ifade->execute(
    [":kullaniciAd" => $kullanici]
);

$kayit = $ifade->fetch(PDO::FETCH_ASSOC);

if($kayit === false){
    header("Refresh: 2; url=../giris.html");
    echo "kullanici adı ve ya şifre hatalı.";
    echo "<p><a href='../giris.html'>Giriş Formu</a></p>";
    exit;
}

$passwordMatch = password_verify($_POST["sifre"], $kayit["sifre"]);
echo "<p>Password verification: " . ($passwordMatch ? 'MATCH' : 'NO MATCH') . "</p>";

if (!$passwordMatch) {

    header("Refresh: 3; url=../giris.html");
    echo "Kullanıcı adı veya şifre hatalı!";
    echo "<p><a href='../giris.html'>Giriş Formu</a></p>";
    exit;
}

$_SESSION['kullaniciAd'] = htmlentities($kayit['kullaniciAd']);
$_SESSION['ad'] = htmlentities($kayit['ad']);
// Giriş başarılı
header("Refresh:3; url=posts.php");
echo "Başarıyla giriş yaptınız";
echo "<p><a href='posts.php'>Post sayfasına gidin</a></p>";
?>