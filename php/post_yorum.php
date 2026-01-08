<?php
session_start();
require_once 'db.php';
include 'inc/ustmenu.inc.php';

$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($post_id === 0) {
    die("Geçersiz post ID.");
}

$stmt = $conn->prepare("SELECT * FROM posts WHERE id=?");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

include 'inc/postcard.inc.php';

if (!$post) { die("Post bulunamadı."); }
?>

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($post['title']); ?> -Yorumlar-</title>
</head>

<div class="comment-section" style="padding:20px;">
    <h3 class="comments-title">Yorumlar</h3>
    <?php
    $com_stmt = $conn->prepare("SELECT * FROM yorum WHERE post_id = ? ORDER BY created_at DESC");
    $com_stmt->execute([$post_id]);
    $comments = $com_stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php if (count($comments)>0): ?>
        <?php foreach($comments as $c): ?>
        <div class="post-mainbox post comment-item">
                    <div class="post-childbox">
                        <div class="post-header">
                            <div class="kullaniciPp"></div>
                            <span class="kullaniciAd"><?= htmlentities($c['kullanici']) ?></span>
                            <span class="post-date"><?= $c['created_at'] ?></span>
                        </div>
                        <div class="post-body">
                            <span class="post-content">
                                <?= nl2br(htmlentities($c['yorum'])) ?>
                            </span>
                        </div>
                    </div>
        </div> <?php endforeach;?>
    <?php else: ?>
        <p class="no-comment">Henüz yorum yapılmamış.</p>
    <?php endif; ?>

    <hr>
    <?php if(isset($_SESSION['kullaniciAd'])): ?>
        <div class="post-mainbox comment-form-box">
            <h4 class="form-title">Yorum Yaz</h4>
            <form action="yorumkaydet.php" method="POST" class="Comment-from">
                <input type="hidden" name="post_id" value="<?=$post_id?>">
                <textarea name="yorum" class="comment-textarea" placeholder="Düşüncelerini buraya yazabilirsin." required></textarea>
                <button type="submit" class="commentSubButton">Gönder</button>
            </form>
        </div>
    <?php else: ?>
        <div class="loginWarn">Yorum yapmak için giriş yapmalısınız.</div>
    <?php endif; ?>
</div>