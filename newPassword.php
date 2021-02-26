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
        <title>CyberShop - New Password</title>
        <link rel="icon" type="image/png" href="/CyberShop/images/logo.png">
    </head>
    <body>
        <div id="content">
            <div class="form">
                <center>
                    <form action="/CyberShop/newPassword.php" method="post">
                        <table>
                            <tr>
                                <td>New Password:</td>
                                <td><input id="Tbox" type="password" name="newPass" placeholder="Enter New Password" required></td>
                            </tr>
                            <tr>
                                <td>Confirm Password:</td>
                                <td><input id="Tbox" type="password" name="CnewPass" placeholder="Enter Confirm Password" required></td>
                            </tr>                            
                            <tr>
                                <td></td>
                                <td><input id="Sbtn" type="submit" name="np" value="Submit">&nbsp;&nbsp;<input id="Rbtn" type="reset" name="reset" value="Reset"></td>
                            </tr>                    
                        </table>
                    </form>
                    <?php
                    include 'config/connection.php';
                    if (isset($_REQUEST["np"]))
                    {
                        $np = $_REQUEST["newPass"];
                        $cp = $_REQUEST["CnewPass"];
                        if (strlen($np) >=8 && strlen($cp)>=8)
                        {
                            $email = $_SESSION["email"];
                            $utype=$_SESSION["fpRole"];
                            if ($np == $cp)
                            {
                                $query = "update tbluser set Password=md5('$np') where EmailID='$email'";
                                $result = mysqli_query($con, $query);
                                unset($_SESSION["otp"]);
                                unset($_SESSION["email"]);
                                unset($_SESSION["fp"]);
                                echo "<script>";
                                echo "alert('Password updated successfully!');";
                                echo "window.location.href='admin/login.php'";
                                echo "</script>";
                            } else
                            {
                                echo "<br><my class='Red'>New Password and Confirm Password must be same!</my>";
                                
                            }
                        } else
                        {
                            echo "<br><my class='Red'>Password must be 8 character long!</my>";
                            
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
