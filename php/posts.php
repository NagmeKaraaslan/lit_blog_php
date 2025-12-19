<?php
session_start();

if (!isset($_SESSION['kullaniciAd'])) {
    header("Location: giris.html");
    exit();
}


include '../db.php';

$posts = [];
$error = null;

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['content'])) {
    if (!isset($_SESSION['kullaniciAd'])) {
        header("Location: ../giris.html?hata=yetkisiz");
        exit();
    }
    try {
        $content = trim($_POST['content']);
        $kullaniciAd = $_SESSION['kullaniciAd'];
        $title = $_POST['title'];

        if(!empty($content)) {
            $stmt = $conn->prepare("INSERT INTO posts (kullaniciAd, title, content, created_at) VALUES(:kullaniciAd, :title, :content, NOW())");

            $stmt->execute([
                ':kullaniciAd' => $kullaniciAd,
                ':title' => $title,
                ':content' => $content
            ]);

            header("Location: posts.php");
            exit();
            }
    }

    catch (\PDOException $e) {
        $error = "Veritabanına kaydedilirken bir hata oluştu: " . $e->getMessage();
    }
    }

    if($stmt){
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $error = "Veritabanı sorgusu oluşturulurken bir hata oluştu.";
    }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../staticfiles/posts.css">
</head>
<body>
    <div class="profil-button-container">
        <a href="../profil.html"><button class="profil-button">Profilim</button></a>
    </div>
    
    <main class="container">
        <div class="blur-light" id="blur1"></div>
        <div class="blur-light" id="blur2"></div>
        
        <div class="column1">
            <p class="son_p">Son Paylaşımlar -</p>
            <img src="../staticfiles/images/image8.svg" class="line_image" alt="ART HAS NO RULES">
        </div>

        <div class="column2">
            <img src="../staticfiles/images/image9.svg" class="canBlurImage" alt="I was created to">
            <?php if(!empty($posts)):?>
                <?php foreach ($posts as $post):?>
                    <div class="post-mainbox post">
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
        </div>

        <div class="column3">
            <img src="../staticfiles/images/image4.svg" class="line_image" alt="Butterfly">
            <div class="button">
                <button>Yazacaklarım var!</button>
            </div>
        </div>
    </main>
    
    <img src="../staticfiles/images/image3.svg" class="canBlurImage hand-writing" alt="Hand Writing">
    <script src="../staticfiles/posts.js"></script>
</body>
</html>