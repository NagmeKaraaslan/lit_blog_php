<?php
require_once 'db.php';
include 'inc/ustmenu.inc.php';

$posts= [];


if(!empty($_GET['terim']))
    {
    $terim = '%'. $_GET['terim'] .'%';
    $sql= "
        SELECT *
        FROM posts
        WHERE content LIKE :terim1
            OR title LIKE :terim2
        ORDER BY created_at DESC  
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':terim1' => $terim,
        ':terim2' => $terim
    ]);
    $rawPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $posts = array_map(function ($post) {
    return [
        'id' => $post['id'],
        'kullaniciAd' => htmlentities($post['kullaniciAd'], ENT_QUOTES | ENT_HTML5, 'UTF-8'),
        'title' => htmlentities($post['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8'),
        'content' => htmlentities($post['content'], ENT_QUOTES | ENT_HTML5, 'UTF-8'),
        'created_at' => $post['created_at']
        ]   ;
    }, $rawPosts);
}

?>

<main class="container">

    <div class="column1">
        <p class="son_p">Arama Sonuçları</p>
    </div>

    <div class="column2">
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <?php include "inc/postcard.inc.php"; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Sonuç bulunamadı.</p>
        <?php endif; ?>
    </div>

    <div class="column3"></div>

</main>
