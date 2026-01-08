<div class="post-mainbox comment-form-box">
    <?php if(isset($_SESSION['kullaniciAd'])): ?>
        <h4 class="form-title">Yorum Yaz</h4>
        <form action="yorumkaydet.php" method="POST" class="Comment-from">
            <input type="hidden" name="post_id" value="<?=$post_id?>">
            <textarea name="yorum" class="comment-textarea" placeholder="Düşüncelerini buraya yazabilirsin." required></textarea>
</div>