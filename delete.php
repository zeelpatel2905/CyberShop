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
        <title>CyberShop - Delete Confirmation</title>
        <link rel="icon" type="image/png" href="/CyberShop/images/logo.png">
    </head>
    <body>
        <div id="content">
            <div class="form">
                <center>
                    <form action="delete.php" method="post">
                        <table>
                            <tr>                            
                                <td><my style="font-size:15px;">Are you sure you want</my><br><input id="Sbtn" type="submit" name="yes" value="Yes"></td>
                            <td><my style="font-size:15px;"> to delete account?</my><br><input id="Redbtn" type="submit" name="no" value="No"></td>
                            </tr>                            
                        </table>
                    </form>
                    <?php
                    include 'config/connection.php';
                    if (isset($_REQUEST["yes"]) || isset($_REQUEST["no"]))
                    {
                        if (isset($_SESSION["user"]))
                        {
                            if (isset($_REQUEST["yes"]))
                            {
                                $user = $_SESSION["user"];
                                $role = $_SESSION["role"];
                                $utype = strtolower($role);
                                $query = "delete from tbluser where EmailID='$user'";
                                $result = mysqli_query($con, $query);
                                echo "<script>";
                                echo "alert('Account deleted successfully!');";
                                echo "window.location.href='$role/login.php'";
                                session_destroy();
                                echo "</script>";
                            } else
                            {
                                header("Location:profile.php");
                            }
                        }
                        if (isset($_COOKIE["Cuser"]))
                        {
                            if (isset($_REQUEST["yes"]))
                            {
                                $credentials = explode(",", $_COOKIE["Cuser"]);
                                $uname = $credentials[0];
                                $role = $credentials[1];
                                $utype = strtolower($role);
                                $query = "delete from tbluser where EmailID='$user'";
                                $result = mysqli_query($con, $query);
                                echo "<script>";
                                echo "alert('Account deleted successfully!');";
                                echo "window.location.href='$utype/login.php'";
                                session_destroy();
                                echo "</script>";
                            } else
                            {
                                header("Location:profile.php");
                            }
                        }
                    }
                    ?>
                </center>
            </div>
        </div>
        <?php
        require_once './style/header.php';
        require_once './style/footer.php';
        ?>        
    </body>
</html>
<?php
ob_end_flush();
?>
