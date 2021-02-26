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
        <title>CyberShop - Registration</title>
        <link rel="icon" type="image/png" href="/CyberShop/images/logo.png">
    </head>
    <body>
        <?php
        require 'style/header.php';
        ?>
        <div id="content">
            <div class="form">
                <center>
                    <h1>Registration</h1>
                    <form action="/CyberShop/registration.php" method="post">
                        <table>
                            <tr>
                                <td>First Name:</td>
                                <td><input id="Tbox" type="text" name="fname" placeholder="Enter First Name" required></td>
                            </tr>
                            <tr>
                                <td>Last Name:</td>
                                <td><input id="Tbox" type="text" name="lname" placeholder="Enter Last Name" required></td>
                            </tr>
                            <tr>
                                <td>Gender:</td>
                                <td><input type="radio" name="gender" value="Male">Male <input type="radio" name="gender" value="Female">Female</td>
                            </tr>
                            <tr>
                                <td>Email ID:</td>
                                <td><input id="Tbox" type="email" name="email" placeholder="Enter Email ID" required></td>
                            </tr>
                            <tr>
                                <td>Contact No:</td>
                                <td><input id="Tbox" type="text" name="contact" placeholder="Enter Contact No" required></td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td><input id="Tbox" type="password" name="password" placeholder="Enter Password" required></td>
                            </tr>
                            <tr>
                                <td>User Type:</td>
                                <td>
                                    <select name="utype">
                                        <option value="null">Select User Type</option>
                                        <option value="Admin">Admin</option>
                                        <!--<option value="Manager">Manager</option>-->
                                        <option value="Employee">Employee</option>
                                        <option value="Customer">Customer</option>
                                    </select>
                                </td>
                            </tr>                            
                            <tr>
                                <td></td>
                                <td><input id="Sbtn" type="submit" name="register" value="Register">&nbsp;&nbsp;<input id="Rbtn" type="reset" name="reset" value="Reset"></td>
                            </tr>                    
                        </table>
                    </form>
                    <?php

                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;

if (isset($_SESSION["fp"]))
                    {
                        $email = $_SESSION["email"];
                        require 'PHPMailer/src/Exception.php';
                        require 'PHPMailer/src/PHPMailer.php';
                        require 'PHPMailer/src/SMTP.php';
                        $rndno = rand(100000, 999999); //OTP generate
                        $_SESSION["otp"] = $rndno;
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = 587;
                        $mail->SMTPAuth = true;
                        $mail->Username = 'contact.cybershop@gmail.com';
                        $mail->Password = 'cyber@shop83';
                        $mail->SMTPSecure = 'tls';
                        $mail->setFrom('contact.cybershop@gmail.com');
                        $mail->addAddress($email);
                        $mail->Subject = 'CyberShop - Forgot Password';
                        $message_body = "Dear " . $_SESSION["email"] . ",\n\nYour OTP For Reset Password is " . $rndno . "\n\n\nThanks & Regards \nCyberShop - Online Computer Shop";
                        $mail->Body = $message_body;
                        $mail->send();
                        echo "<script>";
                        echo "alert('OTP sent successfully!');";
                        echo "window.location.href='otp.php'";
                        echo "</script>";
                    }
                    if (isset($_SESSION["otp"]))
                    {
                        $email = $_SESSION["email"];
                        require 'PHPMailer/src/Exception.php';
                        require 'PHPMailer/src/PHPMailer.php';
                        require 'PHPMailer/src/SMTP.php';
                        $rndno = rand(100000, 999999); //OTP generate
                        $_SESSION["otp"] = $rndno;
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = 587;
                        $mail->SMTPAuth = true;
                        $mail->Username = 'contact.cybershop@gmail.com';
                        $mail->Password = 'cyber@shop83';
                        $mail->SMTPSecure = 'tls';
                        $mail->setFrom('contact.cybershop@gmail.com');
                        $mail->addAddress($email);
                        $mail->Subject = 'CyberShop - Registration';
                        $message_body = "Hi! " . $fname . " " . $lname . " Welcome To CyberShop,\n\nYour OTP For Registration is " . $rndno . "\n\n\nThanks & Regards \nCyberShop - Online Computer Shop";
                        $mail->Body = $message_body;
                        $mail->send();
                        echo "<script>";
                        echo "alert('OTP sent successfully!');";
                        echo "window.location.href='otp.php'";
                        echo "</script>";
                    }
                    if (isset($_REQUEST["register"]))
                    {
                        include 'config/connection.php';
                        $query = "select count(*) as count from tbluser where UserType='Admin'";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($result);
                        if ($row["count"] >= 1 && $_REQUEST["utype"] == "Admin")
                        {
                            echo "<script>";
                            echo "alert('Only one admin can register!');";
                            echo "window.location.href='index.php'";
                            echo "</script>";
                        } else
                        {
                            if (isset($_REQUEST["gender"]) && $_REQUEST["utype"] != "null")
                            {

                                include 'config/connection.php';
                                $fname = $_REQUEST["fname"];
                                $lname = $_REQUEST["lname"];
                                $gender = $_REQUEST["gender"];
                                $email = $_REQUEST["email"];
                                $contact = $_REQUEST["contact"];
                                $password = $_REQUEST["password"];
                                $utype = $_REQUEST["utype"];
                                if (filter_var($email, FILTER_VALIDATE_EMAIL))
                                {
                                    $query = "select count(*) as count from tbluser where EmailID='$email'";
                                    $result = mysqli_query($con, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    $total = $row["count"];
                                    if ($total >= 1)
                                    {
                                        echo "<br><my class='Red'>Email ID already registered!</my>";
                                    } else if (!preg_match('/^[0-9]{10}+$/', $contact))
                                    {
                                        echo "<br><my class='Red'>Invalid Contact No!</my>";
                                    } else if (!preg_match("/^[a-zA-z]*$/", $fname))
                                    {
                                        echo "<br><my class='Red'>Invalid First Name!</my>";
                                    } else if (!preg_match("/^[a-zA-z]*$/", $lname))
                                    {
                                        echo "<br><my class='Red'>Invalid Last Name!</my>";
                                    } else
                                    {
                                        $_SESSION["fname"] = $_REQUEST["fname"];
                                        $_SESSION["lname"] = $_REQUEST["lname"];
                                        $_SESSION["gender"] = $_REQUEST["gender"];
                                        $_SESSION["email"] = $_REQUEST["email"];
                                        $_SESSION["contact"] = $_REQUEST["contact"];
                                        $_SESSION["password"] = $_REQUEST["password"];
                                        $_SESSION["utype"] = $_REQUEST["utype"];
                                        if (strlen($password) < 8)
                                        {
                                            echo "<br><my class='Red'>Password must be 8 character long!</my>";
                                        } else
                                        {
                                            require 'PHPMailer/src/Exception.php';
                                            require 'PHPMailer/src/PHPMailer.php';
                                            require 'PHPMailer/src/SMTP.php';
                                            $rndno = rand(100000, 999999); //OTP generate
                                            $_SESSION["otp"] = $rndno;
                                            $mail = new PHPMailer(true);
                                            $mail->isSMTP();
                                            $mail->Host = 'smtp.gmail.com';
                                            $mail->Port = 587;
                                            $mail->SMTPAuth = true;
                                            $mail->Username = 'contact.cybershop@gmail.com';
                                            $mail->Password = 'cyber@shop83';
                                            $mail->SMTPSecure = 'tls';
                                            $mail->setFrom('contact.cybershop@gmail.com');
                                            $mail->addAddress($email);
                                            $mail->Subject = 'CyberShop - Registration';
                                            $message_body = "Hi! " . $fname . " " . $lname . " Welcome To CyberShop,\n\nYour OTP For Registration is " . $rndno . "\n\n\nThanks & Regards \nCyberShop - Online Computer Shop";
                                            $mail->Body = $message_body;
                                            $mail->send();
                                            echo "<script>";
                                            echo "alert('OTP sent successfully!');";
                                            echo "window.location.href='otp.php'";
                                            echo "</script>";
                                        }
                                    }
                                } else
                                {
                                    echo "<br><my class='Red'>Invalid Email ID!</my>";
                                }
                            } else
                            {
                                echo "<br><my class='Red'>Please fill all the details!</my>";
                            }
                        }
                    }
                    ?>
                </center>
            </div>
        </div>
<?php
require_once './style/header.php';
require './style/footer.php';
?>        
    </body>
</html>
        <?php
        ob_end_flush();
        ?>
