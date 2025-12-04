<?php
    include 'db.php';

    if(isset($_GET['kullanici'])){
        $kullaniciAd = htmlentities($_GET['kullanici']);
        $stmt = $conn->prepare("SELECT title, content, created_at FROM posts WHERE kullaniciAd = :kullanici ORDER BY created_at DESC");
    }

    if($stmt){
        $stmt -> bind_param(':kullanici', $kullaniciAd);
        $stmt -> execute();

        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }

    //$title = htmlentities($_POST["title"]);
    //$icerik = nl2br(htmlentities($_POST["content"]));

?>