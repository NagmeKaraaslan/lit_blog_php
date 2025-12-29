<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$kayit = [
    'kullaniciAd' => isset($_SESSION['kullaniciAd']) ? htmlentities($_SESSION['kullaniciAd'], ENT_QUOTES | ENT_HTML5, 'UTF-8', false) : '',
    'ad' => isset($_SESSION['ad']) ? htmlentities($_SESSION['ad'], ENT_QUOTES | ENT_HTML5, 'UTF-8', false) : ''
];

if (!isset($_SESSION['kullaniciAd'])) {
    header("Refresh:3; url=/giris.html");
    exit();
}


require_once "db.php";

$posts = [];
$error = null;

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['content'])) {
    // Debug: Log the POST data
    error_log("POST Data: " . print_r($_POST, true));
    
    if (!isset($_SESSION['kullaniciAd'])) {
        header("Location: ../giris.html?hata=yetkisiz");
        exit();
    }
    
    try {
        $content = trim($_POST['content']);
        $kullaniciAd = $_SESSION['kullaniciAd'];
        $title = $_POST['title'];

        if(!empty($content)) {
            $stmtIn = $conn->prepare("INSERT INTO posts (kullaniciAd, title, content, created_at) VALUES(:kullaniciAd, :title, :content, NOW())");

            $stmtIn->execute([
                ':kullaniciAd' => $kullaniciAd,
                ':title' => $title,
                ':content' => $content
            ]);

            //header("Location: posts.php");
            var_dump($result);
            var_dump($stmtIn->errorInfo());
            exit();
            }
    }

    catch (\PDOException $e) {
        $error = "Veritabanına kaydedilirken bir hata oluştu: " . $e->getMessage();
    }
    }

    try {
        $stmtSelect = $conn->prepare("SELECT * FROM posts ORDER BY created_at DESC");
        $stmtSelect -> execute();
        $rawPosts = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
        
        // Tüm post verilerini bir kere işle
        $posts = array_map(function($post) {
            return [
                'kullaniciAd' => htmlentities($post['kullaniciAd'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8', false),
                'title' => htmlentities($post['title'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8', false),
                'content' => htmlentities($post['content'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8', false),
                'created_at' => $post['created_at'] ?? ''
            ];
        }, $rawPosts);
    }
    catch(PDOException $e){
        $error = "listeleme hatası" . $e->getMessage();
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
    <div class="button-container" style="display: flex; gap: 10px; padding: 10px;">
        <div class="profil-button-container">
            <a href="../profil.html"><button class="profil-button">Profilim</button></a>
        </div>
        <div class="new-button-container">
            <a href="form.php"><button class="profil-button">Yazacaklarım Var!</button></a>
        </div>
    </div>
    
    <main class="container">
        <div class="blur-light" id="blur1"></div>
        <div class="blur-light" id="blur2"></div>
        
        <div class="column1">
            <p class="son_p">
                <?php echo htmlentities($kayit['ad'], ENT_QUOTES | ENT_HTML5, 'UTF-8', false) ?> için
                Son Paylaşımlar~
            </p>
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
                                
                                <span class="kullaniciAd"><?= $post['kullaniciAd'] ?></span>
                                
                                <span class="post-date"><?= $post['created_at'] ?></span>
                            </div>

                            <div class="post-body">
                                <span class="post-title"><?= $post["title"] ?></span>
                                <span class="post-content"><?= nl2br($post["content"]) ?></span>
                           </div>
                        </div>  
                    </div>
                <?php endforeach;?>
            <?php else:?>
                <p class="error_msg">
                    <?php if($error):?>
                        <?php echo htmlentities($error, ENT_QUOTES | ENT_HTML5, 'UTF-8', false) ?>
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