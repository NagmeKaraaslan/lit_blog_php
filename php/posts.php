<?php
    include 'db.php';

    if(isset($_GET['kullanici'])){
        $kullaniciAd = htmlentities($_GET['kullanici']);
        $stmt = $conn->prepare("");
    }

    //$title = htmlentities($_POST["title"]);
    //$icerik = nl2br(htmlentities($_POST["content"]));

?>