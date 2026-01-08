<?php
session_start();
require_once 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['kullaniciAd'])) {

    $post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
    $yorum = isset($_POST['yorum']) ? trim($_POST['yorum']) : '';
    $kullaniciAd = $_SESSION['kullaniciAd'];

    if(!empty($yorum) && $post_id > 0) {
        try {
            $stmt = $conn->prepare("INSERT INTO yorum (post_id, kullanici, yorum, created_at) VALUES (?, ?, ?, NOW())");
            $sit = $stmt-> execute([$post_id, $kullaniciAd ,$yorum]);

            if ($sit) {
                header("Location: post_yorum.php?id=" . $post_id);
                exit();
            }
        }
        catch (PDOException $e) {
            die("Veritabanı hatası: " . $e->getMessage());
        }
    } else {
        header("Location: post_yorum.php?id=" . $post_id . "&hata=bos");
        exit();
    }
} else {
    header("Location: posts.php");
    exit(); }

?>