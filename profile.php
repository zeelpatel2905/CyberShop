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
        <title>CyberShop - User Profile</title>
        <link rel="stylesheet" type="text/css" href="/CyberShop/style/myCss.css">
        <link rel="icon" type="image/png" href="/CyberShop/images/logo.png">
    </head>
    <body>
        <div id="content-left">
            <h1>User Profile</h1>
            <?php
            include 'config/connection.php';
            if (isset($_SESSION["user"]))
            {
                if (isset($_SESSION["user"]) && isset($_SESSION["role"]))
                {
                    $email = $_SESSION["user"];
                    $role = $_SESSION["role"];
                }
                $query = "select * from tbluser where EmailID='$email' and UserType='$role'";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<table>";
                echo "<form action='profile.php' method='post'>";
                echo "<tr><td style='width:100px'><img height='80px' width='80px' src='images/user.png'></td><td style='width:280px;'><span style='font-size:20px;'>$row[FirstName] $row[LastName]</span><input style='margin-left:90px;' id='Dbtn' type='submit' name='deleteAc' value='Delete Account'>";
                echo "<br><my style='font-size:15px;'>$row[EmailID]</my><br><my style='font-size:15px;color:grey'>$role</my><br></td></tr>";
                echo "</table>";
                echo '<div class="form">';
                echo "<table>";
                echo "<tr><td><my style='font-size:18px;color:grey'>Basic Details</my><td></td></tr>";
                echo "<tr><td>First Name<br><input type='text' name='fname' value='$row[FirstName]'></td><td>Last Name<br><input type='text' name='lname' value='$row[LastName]'></td></tr>";
                echo "<tr><td>Contact No<br><input type='text' name='contact' value='$row[ContactNo]'></td><td></td></tr>";
                echo "<tr><td colspan=2>Address<br><textarea style='width:315px;height:70px;' name='address'>$row[Address]</textarea><td></td></tr>";
                echo "<tr><td>City<br><input type='text' name='city' value='$row[City]'></td><td>State<br><input type='text' name='state' value='$row[State]'></td></tr>";
                echo "<tr><td>Pincode<br><input type='text' name='pincode' value='$row[Pincode]'></td><td></td></tr>";
                echo "<tr><td><input id='Sbtn' type='submit' name='sc' value='Save Changes'></td><td><input id='Rbtn' type='submit' name='refresh' value='Reset'></td></tr>";
                echo "</table>";
            } else
            {
                if (isset($_COOKIE["Cuser"]))
                {
                    $credentials = explode(",", $_COOKIE["Cuser"]);
                    $email = $credentials[0];
                    $role = $credentials[1];
                    $utype = strtolower($role);
                    $query = "select * from tbluser where EmailID='$email' and UserType='$role'";
                    $result = mysqli_query($con, $query);
                    $row = mysqli_fetch_assoc($result);
                    echo "<table>";
                    echo "<form action='profile.php' method='post'>";
                    echo "<tr><td style='width:100px'><img height='80px' width='80px' src='images/user.png'></td><td style='width:280px;'><span style='font-size:20px;'>$row[FirstName] $row[LastName]</span><input style='margin-left:90px;' id='Dbtn' type='submit' name='deleteAc' value='Delete Account'>";
                    echo "<br><my style='font-size:15px;'>$row[EmailID]</my><br><my style='font-size:15px;color:grey'>$role</my><br></td></tr>";
                    echo "</table>";
                    echo '<div class="form">';
                    echo "<table>";
                    echo "<tr><td><my style='font-size:18px;color:grey'>Basic Details</my><td></td></tr>";
                    echo "<tr><td>First Name<br><input type='text' name='fname' value='$row[FirstName]'></td><td>Last Name<br><input type='text' name='lname' value='$row[LastName]'></td></tr>";
                    echo "<tr><td>Contact No<br><input type='text' name='contact' value='$row[ContactNo]'></td><td></td></tr>";
                    echo "<tr><td colspan=2>Address<br><textarea style='width:315px;height:70px;' name='address'>$row[Address]</textarea><td></td></tr>";
                    echo "<tr><td>City<br><input type='text' name='city' value='$row[City]'></td><td>State<br><input type='text' name='state' value='$row[State]'></td></tr>";
                    echo "<tr><td>Pincode<br><input type='text' name='pincode' value='$row[Pincode]'></td><td></td></tr>";
                    echo "<tr><td><input id='Sbtn' type='submit' name='sc' value='Save Changes'></td><td><input id='Rbtn' type='submit' name='refresh' value='Reset'></td></tr>";
                    echo "</table>";
                } else
                {
                    header("Location:/CyberShop/admin/login.php");
                }
            }

            if (isset($_REQUEST["deleteAc"]))
            {
                header("Location:delete.php");
            }
            if (isset($_REQUEST["refresh"]))
            {
                header("Location:profile.php");
            }
            if (isset($_REQUEST["sc"]))
            {
                if (isset($_SESSION["user"]) && isset($_SESSION["role"]))
                {
                    $email = $_SESSION["user"];
                    $role = $_SESSION["role"];
                }
                if (isset($_COOKIE["Cuser"]))
                {
                    $credentials = explode(",", $_COOKIE["Cuser"]);
                    $email = $credentials[0];
                    $role = $credentials[1];
                    $utype = strtolower($role);
                }
                $fname = $_REQUEST["fname"];
                $lname = $_REQUEST["lname"];
                $contact = $_REQUEST["contact"];
                $address = $_REQUEST["address"];
                $city = $_REQUEST["city"];
                $state = $_REQUEST["state"];
                $pincode = $_REQUEST["pincode"];
                if ($contact != "" && !preg_match('/^[0-9]{10}+$/', $contact))
                {
                    echo "<br><center><my class='Red'>Invalid Contact No!</my></center>";
                } else if ($pincode != "" && !preg_match('/^[0-9]{6}+$/', $pincode))
                {
                    echo "<br><center><my class='Red'>Invalid Pincode!</my></center>";
                } else if (!preg_match("/^[a-zA-z]*$/", $fname))
                {
                    echo "<br><center><my class='Red'>Invalid First Name!</my></center>";
                } else if (!preg_match("/^[a-zA-z]*$/", $lname))
                {
                    echo "<br><center><my class='Red'>Invalid Last Name!</my></center>";
                } else
                {
                    $query = "update tbluser set FirstName='$fname',LastName='$lname',ContactNo='$contact',Address='$address',City='$city',State='$state',Pincode='$pincode' where EmailID='$email' and UserType='$role'";
                    $result = mysqli_query($con, $query);
                    //echo "<br><center><my class='Green'>Profile updated!</my><br><br><a href='profile.php'>Refresh</a></center>";
                    echo "<script>alert('Profile updated successfully!');window.location.href='profile.php';</script>";
                }
            }
            ?>
        </div>
    </form>
</div>
<?php ?>
<?php
require_once './style/header.php';
require './style/footer.php';
?> 
</body>
</html>
<?php
ob_end_flush();
?>
