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
        <title>CyberShop - Admin Login</title>
        <link rel="icon" type="image/png" href="/CyberShop/images/logo.png">
    </head>
    <body>
        <div id="content">
            <h1>Login</h1>
            <div class="form">
                <center>
                    <form action="login.php" method="post">
                        <table>
                            <tr>
                                <td>Email ID:</td>
                                <td><input id="Tbox" type="email" name="username" placeholder="Enter Email ID" required></td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td><input id="Tbox" type="password" name="password" placeholder="Enter Password" required></td>
                            </tr>
                            <tr>
                            <tr>
                                <td></td>
                                <td><input type="checkbox" name="remember">Remember me</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><a href="../forgotPassword.php?role=Admin">Forgot Password</a></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>New User Register <a href="../registration.php">Here</a></td>
                            </tr>                            
                            <tr>
                                <td></td>
                                <td><input id="Sbtn" type="submit" name="loginu" value="Login">&nbsp;&nbsp;<input id="Rbtn" type="reset" name="reset" value="Reset"></td>
                            </tr>                    
                        </table>
                    </form>
                    <?php
                    include '../config/connection.php';
                    if (isset($_SESSION["user"]))
                    {
                        $role = $_SESSION["role"];
                        $utype = strtolower($role);
                        header("Location:/CyberShop/$utype/home.php");
                    }
                    if (isset($_COOKIE["Cuser"]))
                    {
                        $credentials = explode(",", $_COOKIE["Cuser"]);
                        $uname = $credentials[0];
                        $role = $credentials[1];
                        $utype = strtolower($role);
                        header("Location:/CyberShop/$utype/home.php");
                    }
                    if (isset($_REQUEST["loginu"]))
                    {
                        $utype = "Admin";
                        $uname = $_REQUEST["username"];
                        $password = $_REQUEST["password"];
                        if (!filter_var($uname, FILTER_VALIDATE_EMAIL))
                        {
                            echo "<br><my class='Red'>Invalid Email ID!</my>";
                        } else if (strlen($password) < 8)
                        {
                            echo "<br><my class='Red'>Password must be 8 character long!</my>";
                        }
                        else
                        {
                            $query = "select UserType from tbluser where EmailID='$uname' and Password=md5('$password')";
                            $rs = mysqli_query($con, $query);
                            if (!$row = mysqli_fetch_assoc($rs))
                            {
                                echo "<br><my class='Red'>Invalid Email ID/Password!</my>";
                            } else
                            {
                                $utype= strtolower($row["UserType"]);
                                if (isset($_REQUEST["remember"]))
                                {
                                    $credentials = $uname . "," . $utype;
                                    setcookie("Cuser",$credentials,time()+60*60*24*7,"/");
                                }
                                $_SESSION["user"] = $uname;
                                $_SESSION["role"] = $utype;
                                header("Location:/CyberShop/$utype/home.php");
                            }
                        }
                    }
                    ?>
                </center>
            </div>
        </div>
        <?php
        require_once '../style/header.php';
        require_once '../style/footer.php';
        ?>        
    </body>
</html>
<?php
ob_end_flush();
?>
