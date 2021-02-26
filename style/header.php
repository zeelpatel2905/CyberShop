<?php
session_start();
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
        <title>CyberShop - Homepage</title>
        <link rel="stylesheet" type="text/css" href="/CyberShop/style/myCss.css">
        <link rel="icon" type="image/png" href="/CyberShop/images/logo.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </head>
    <body>
        <form action="/CyberShop/logout.php" method="post">
            <table class="header">            
                <tr>
                    <td style="width: 70px;padding-left: 10px;"><img id="logo" src="/CyberShop/images/logo.png"></td> 
                    <td><a style="color:white;text-decoration: none;" href="/CyberShop/index.php">CyberShop</a>&nbsp;&nbsp;&nbsp;&nbsp;<input id="Tbox" type="text" name="searchProduct" placeholder="Search Product">&nbsp;&nbsp;<input id="Sbtn" type="button" name="search" value="Search"></td>
                    <td style="text-align: right;">
                        <a id="Hlink" href="/CyberShop/index.php">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                        if (!isset($_SESSION["user"]) && !isset($_COOKIE["Cuser"]))
                        {
                            echo '<a id="Hlink" href="/CyberShop/registration.php">Registration</a>&nbsp;&nbsp;&nbsp;&nbsp;';
                            /* echo '<div class="dropup">';
                              echo '<a id="Hlink" href="#">Login</a>';
                              echo '<div class="dropup-content">';
                              echo '<a id="Hlink" href="/CyberShop/admin/login.php">Admin</a>';
                              echo '<a id="Hlink" href="/CyberShop/manager/login.php">Manager</a>';
                              echo '<a id="Hlink" href="/CyberShop/employee/login.php">Employee</a>';
                              echo '<a id="Hlink" href="/CyberShop/customer/login.php">Customer</a>';
                              echo '</div>';
                              echo '</div>'; */
                            echo '<a id="Hlink" href="/CyberShop/admin/login.php">Login</a>';
                        } else
                        {
                            if (isset($_SESSION["user"]))
                            {
                                echo "<a id='Ulink' href='/CyberShop/profile.php'>$_SESSION[user]</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                            } else
                            {
                                if (isset($_COOKIE["Cuser"]))
                                {
                                    $credentials = explode(",", $_COOKIE["Cuser"]);
                                    $uname = $credentials[0];
                                    $role = $credentials[1];
                                    $utype = strtolower($role);
                                    echo "<a id='Ulink' href='/CyberShop/profile.php'>$uname</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                                }
                            }
                            echo "<input type='submit' id='lg' name='logout' value='Logout'>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
