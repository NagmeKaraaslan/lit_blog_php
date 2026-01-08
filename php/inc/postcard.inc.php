<link rel="stylesheet" href="../staticfiles/posts.css">
<div class="post-mainbox post">
    <div class="post-childbox">
        <div class="post-header">
            <div class="kullaniciPp"></div>

            <span class="kullaniciAd">
                <?= htmlentities($post['kullaniciAd']) ?>
                <a href="post_yorum.php?id=<?= $post['id'] ?>" style="font-weight:100;">> Yorum eklemek için tıklayın</a>
            </span>

            <span class="post-date">
                <?= $post['created_at'] ?>
            </span>
        </div>

        <div class="post-body">
            <span class="post-title"><?= $post['title'] ?></span>
            <span class="post-content"><?= nl2br($post['content']) ?></span>
        </div>
    </div>
</div>
