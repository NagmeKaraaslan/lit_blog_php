<div class="header">

    <div class="search-box">
        <form action="arama.php" method="GET">
            <input type="text" name="terim" placeholder="Ara...">
            <button type="submit">Ara</button>
        </form>
    </div>

    <div class="nav">
        <?php if (!isset($_SESSION['kullaniciAd'])) { ?>
            <a href="../giris.html">Giriş Yap</a>
            <a href="../kayit.html">Kayıt Ol</a>
        <?php } else { ?>
            <a href="form.php">Yeni Gönderi</a>
            <a href="cikis.php">Çıkış</a>
        <?php } ?>
    </div>

</div>
