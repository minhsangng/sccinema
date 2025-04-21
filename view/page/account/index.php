<?php
session_start();

if (!isset($_SESSION["signin"]))
    $action = "signup";
else
    $action = "signin";

echo "<script>
    window.location.href = 'view/page/" . $action . "/index.php'
</script>";
?>

<title>Tài khoản - SC Cinema | Đặt vé xem phim trực tuyến</title>

<div class="section">
    <h2>Đây là tài khoản</h2>
</div>