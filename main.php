
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Blog</title>
    <link rel="stylesheet" href="{% static 'main.css' %}" />
</head>

<body>
    <div class="blur-overlay">
        <div class="create-container">
            {% include "includes/create.html" %}
        </div>
        <div class="hand-container">
            {% include "includes/hand.html" %}
        </div>
    </div>

    <div class="main-grid">
        <div class="header-text">Son Paylaşımlar ~</div>

        <div class="center-content">
            <?php if(!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="post">
                        <p><small>
                            <?= date('d M H Y:i' , strtotime($post["content"])); ?>
                        </small></p>
                        <div>
                            <?= nl2br(htmlspecialchars($post["content"]));?>
                        </div>
                    </div>
                <?php endforeach?>
            <?php else:?>
                <p>Hiç paylaşım yok.</p>
            <?php endif;?>

            <a href="{% url 'blog_app:new_post' %}" style="text-decoration: none; color: inherit;">
                <button class="write-button">Yazacaklarım Var !</button>
            </a>
        </div>

        <div class="side-left">
             <!--gerekli php kodları gelecek-->
        </div>

        <div class="side-right">
            <!--gerekli php kodları gelecek-->
        </div>
    </div>

    <script src="{% static 'main.js' %}"></script>
</body>

</html>