<?php
    include 'db.php';

    if(isset($_GET['kullaniciAd'])){
        $kullaniciAd = htmlentities($_GET['kullaniciAd']);
        $stmt = $conn->prepare("SELECT title, content, created_at FROM posts WHERE kullaniciAd = :kullaniciAd ORDER BY created_at DESC");
    }

    if($stmt){
        $stmt -> bind_param(':kullaniciAd', $kullaniciAd);
        $stmt -> execute();

        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }

    //$title = htmlentities($_POST["title"]);
    //$icerik = nl2br(htmlentities($_POST["content"]));

?>