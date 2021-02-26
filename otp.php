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
        <title>CyberShop - OTP</title>
        <link rel="icon" type="image/png" href="/CyberShop/images/logo.png">
    </head>
    <body>
        <div id="content">
            <div class="form">
                <center>
                    <form action="/CyberShop/otp.php" method="post">
                        <table>
                            <tr>
                                <td>OTP:</td>
                                <td><input id="Tbox" type="text" name="otp" placeholder="Enter OTP" required></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><a href="registration.php">Resend OTP</a></td>
                            </tr>                            
                            <tr>
                                <td></td>
                                <td>
                                    <?php
                                    if (isset($_SESSION["fp"]))
                                    {
                                        echo "<input id='Sbtn' type='submit' name='registerotp' value='Submit'>&nbsp;&nbsp;";
                                    } else
                                    {
                                        echo "<input id='Sbtn' type='submit' name='registerotp' value='Register'>&nbsp;&nbsp;";
                                    }
                                    ?>
                                    <input id="Rbtn" type="reset" name="reset" value="Reset"></td>
                            </tr>                    
                        </table>
                    </form>
                    <?php

                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;

if (isset($_REQUEST["register"]))
                    {
                        if (isset($_REQUEST["gender"]) && $_REQUEST["utype"] != "null")
                        {
                            include 'config/connection.php';
                            $fname = $_SESSION["fname"];
                            $lname = $_SESSION["lname"];
                            $gender = $_SESSION["gender"];
                            $email = $_SESSION["email"];
                            $contact = $_SESSION["contact"];
                            $password = $_SESSION["password"];
                            $utype = $_SESSION["utype"];
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
                                //echo "window.location.href='otp.php?fname=$fname&lname=$lname&gender=$gender&email=$email&contact=$contact&password=$password&utype=$utype'";
                                echo "</script>";
                            }
                        } else
                        {
                            echo "<br><my class='Red'>Please fill all the details!</my>";
                        }
                    }
                    ?>
                    <?php
                    if (isset($_REQUEST["registerotp"]))
                    {
                        include 'config/connection.php';
                        $rotp = $_REQUEST["otp"];
                        $otp = $_SESSION["otp"];
                        if (strlen($rotp) == 6)
                        {
                            if ($rotp == $otp)
                            {
                                if (isset($_SESSION["fp"]))
                                {
                                    echo "<script>";
                                    echo "window.location.href='newPassword.php'";
                                    echo "</script>";
                                } else
                                {
                                    $fname = $_SESSION["fname"];
                                    $lname = $_SESSION["lname"];
                                    $gender = $_SESSION["gender"];
                                    $email = $_SESSION["email"];
                                    $contact = $_SESSION["contact"];
                                    $password = $_SESSION["password"];
                                    $utype = $_SESSION["utype"];
                                    $date = date("Y-m-d");
                                    $genderChar = "";
                                    if ($gender == "Male")
                                    {
                                        $genderChar = "M";
                                    }
                                    if ($gender == "Female")
                                    {
                                        $genderChar = "F";
                                    }
                                    $query = "insert into tbluser (FirstName, LastName, Gender, EmailID, ContactNo, Password, UserType, RegistrationDate) values ('$fname','$lname','$genderChar','$email','$contact',md5('$password'),'$utype','$date')";
                                    mysqli_query($con, $query);
                                    session_destroy();
                                    echo "<script>";
                                    echo "alert('Registration successful!');";
                                    echo "window.location.href='index.php'";
                                    echo "</script>";
                                }
                            } else
                            {
                                echo "<br><my class='Red'>Invalid OTP!</my>";
                                
                            }
                        } else
                        {
                            echo "<br><my class='Red'>OTP must be of 6 digit!</my>";
                            
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