<?php
$host = 'localhost';
$db = 'litblog';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error) {
    die("Veri tabanı bağlantısı başarısız: ". $conn-mysqli_connect_error());
}

$conn->set_charset("utf8mb4_general_ci");
?>