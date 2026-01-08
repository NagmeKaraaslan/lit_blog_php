<?php
session_start();
session_destroy();
$_SESSION = null;
header("Location: index.php");
echo "<p><a href='index.php'>Ana Sayfa</a></p>";
exit;
?>