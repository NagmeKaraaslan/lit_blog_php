<?php

include 'db.php';

$posts = [];
$error = null;

try{
    $stmt = $conn->prepare("SELECT kullaniciAd, title, content, created_at FROM posts ORDER BY created_at DESC");

    if($stmt){
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $error = "Veritabanı sorgusu oluşturulurken bir ahat oluştu.";
    }
}
catch (\PDOException $e){
    $error = "veritabanı hatası oluştu lütfen abğlantınızı kontrol edin.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="staticfiles/posts.css">
</head>
<body>
    <header>
        <p class="son_p">Son Paylaşımlar</p>
    </header>

    <main class="feed">
        <div class="panel1">
            <object data="staticfiles/images/image8.svg"></objectdata></object>
        </div>
        <?php if(!empty($posts)):?>
            <?php foreach ($posts as $post):?>

                <div class="post-mainbox">
                    <div class="post-childbox">
                        <div class="post-header">
                            <div class="kullaniciPp"></div> 
                            
                            <span class="kullaniciAd"><?= htmlspecialchars($post['kullaniciAd']) ?></span>
                            
                            <span class="post-date"><?= htmlspecialchars($post['created_at']) ?></span>
                        </div>

                        <div class="post-body">
                            <span class="post-title"><?= htmlspecialchars($post["title"]) ?></span>
                            <span class="post-content"><?= htmlspecialchars($post["content"])?></span>
                       </div>
                    </div>  
                </div>
                <div class="button">
                    <button>Yazacaklarım var!</button>
                </div>
            <?php endforeach;?>
        <?php else:?>
            <p class="error_msg">
                <?php if($error):?>
                    <?php htmlspecialchars($error)?>
                <?php else:?>
                    Henüz hiç gönderi bulunmamaktadır.
                <?php endif;?>
            </p>
        <?php endif;?>
    </main>
</body>
</html>