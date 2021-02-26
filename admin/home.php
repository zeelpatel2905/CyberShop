<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CyberShop - Admin Home</title>
        <link rel="icon" type="image/png" href="/CyberShop/images/logo.png">
    </head>
    <body>
        <div id="content">
            <h1 style="font-size: 40px;">ADMIN HOME</h1>
            <h1 style="font-size: 40px;">UNDER CONSTRUCTION</h1>
            <h3 style="font-size: 30px;">SITE NEARLY READY</h3>
            <my style="font-size: 10;color:grey">THANK YOU FOR YOUR PATIENCE</my>
        </div>
        <?php
        $role="Admin";
        if (!isset($_SESSION["user"]) && !isset($_COOKIE["Cuser"]))
        {
            $utype = strtolower($role);
            header("Location:/CyberShop/$utype/login.php");
        }
        ?>
        <?php
        require_once '../style/header.php';
        require_once '../style/footer.php';
        ?>        
    </body>
</html>
<?php
ob_end_flush();
?>
