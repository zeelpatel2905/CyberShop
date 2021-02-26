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
        <title>CyberShop - Forgot Password</title>
        <link rel="icon" type="image/png" href="/CyberShop/images/logo.png">
    </head>
    <body>
        <div id="content">
            <h1>Forgot Password</h1>
            <div class="form">
                <center>
                    <form action="/CyberShop/forgotPassword.php" method="post">
                        <table>
                            <tr>
                                <td>Email ID:</td>
                                <td><input id="Tbox" type="email" name="email" placeholder="Enter Email ID" required></td>
                            </tr>                            
                            <tr>
                                <td></td>
                                <td><input id="Sbtn" type="submit" name="fp" value="Submit">&nbsp;&nbsp;<input id="Rbtn" type="reset" name="reset" value="Reset"></td>
                            </tr>                    
                        </table>
                    </form>
                    <?php
                    if (isset($_REQUEST["role"]))
                    {
                        $_SESSION["fpRole"] = $_REQUEST["role"];
                    }

                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;

include 'config/connection.php';
                    if (isset($_REQUEST["fp"]))
                    {
                        $email = $_REQUEST["email"];
                        $query = "select count(*) as count from tbluser where EmailID='$email'";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($result);
                        $total = $row["count"];
                        if ($total >= 1)
                        {
                            if (filter_var($email, FILTER_VALIDATE_EMAIL))
                            {
                                $_SESSION["fp"] = true;
                                $_SESSION["email"] = $email;

                                echo "<script>";
                                echo "window.location.href='registration.php'";
                                echo "</script>";
                            } else
                            {
                                echo "<br><my class='Red'>Invalid Email ID!</my>";
                            }
                        } else
                        {
                            echo "<br><my class='Red'>Email ID Not Registered!</my>";
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
