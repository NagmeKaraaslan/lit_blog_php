<?php
    $kullanici = htmlentities($_POST["kullanici"]);
    $title = htmlentities($_POST["title"]);
    $icerik = nl2br(htmlentities($_POST["content"]));

    echo "<h3><?php echo $baslik; ?></h3>";
    echo "<p><?php echo $baslik; ?></p>
"

?>