<?php
session_start();

if (isset($_SESSION['kullaniciAd']) || empty($_SESSION['kullaniciAd'])) {
    header("Refresh:3,Location: giris.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Gönderi</title>
    <link rel="stylesheet" href="staticfiles/form.css">
</head>

<body>
    <form id="postForm" class="container" action="php/posts.php" method="POST">
        <div class="left-panel">
            <p>Yeni yazını okumak için sabırsızlanıyoruz!</p>
            <button class="button" id="submitBtn" type="submit" tabindex="2">Gönder!</button>
            <button class="button" type="button" id="cancel" onclick="openModal()" tabindex="3">Vazgeçtim.</button>
        </div>
        <div class="right-panel">
            <label for="contentArea">Yeni yazım:</label>
            <textarea name="content" id="contentArea" rows="10" required tabindex="1"></textarea>
        </div>
    </form>

    <div class="modal" id="modal">
        <div class="modal-content">
            <p>
                Merak etme!<br>
                İlham bazen gelir, bazen kaçar; hatta bir ışık misali yanıp sönebilir.
                Tekrar yazmaya karar verdiğinde biz onu okumak için yine burada olacağız.<br>
                Ama yazmaya devam etmek istersen hemen aşağıdaki butonlardan da <strong>devam et</strong>e
                basabilirsin.<br>
                Ya da <strong>Eminim</strong> butonuna basarak form sayfasından çıkabilirsin :) <br><br>
                Kaleminle kal.
            </p>
            <div class="modal-buttons">
                <button id="keepWritin" onclick="closeModal()">Yazmaya Devam Et</button>
                <button id="sureCancel">Eminim</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const cancelBtn = document.getElementById("sureCancel");
            if (cancelBtn) {
                cancelBtn.addEventListener("click", () => {
                    window.location.href = "php/posts.php"; 
                });
            }
            
        });

        function openModal() {
            document.getElementById("modal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }
    </script>
</body>

</html>