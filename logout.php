<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["role"]);
session_destroy();
setcookie("Cuser", " ", time() - 1,"/");
header("Location:/CyberShop/admin/login.php");
?>

