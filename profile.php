<?php
    $msg = "Pleas log in first";
    include "authentication.php";

    // if(!isset($_SESSION['PatNRIC'])){
    //     echo ("<script type='text/javascript'>
    //     alert('$msg')
    //     location.href='index.php';</script>");
    // } 

    // $_SESSION["PatNRIC"] = "S8512067J";
    // $_SESSION["PatPassword"] = "password";
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template i
n the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/main.css">

        <title>Profile</title>
    </head>
 <?php include "nav.inc.php"; ?>

    <body>
    <div class="profileHeader"></div>
    <div class="profilePicContainer">
        <div class="circle">
            <div class="profileImg"></div>
        </div>
        <h1>Hi <?php echo $FullName; ?>!</h1>
    </div>
    <div class="wrapper">
        <div class="info">
            <h2>Profile</h2>
            <div class="profileInfoContainer">
                <div class="infoDetails">
                    <h3>NRIC</h3>
                    <p><?php echo $NRIC; ?></p>
                </div>
                <div class="infoDetails">
                    <h3>First Name</h3>
                    <p><?php echo $FirstName; ?></p>
                </div>
                <div class="infoDetails">
                    <h3>Last Name</h3>
                    <p><?php echo $LastName; ?></p>
                </div>
            </div>
        </div>
        <div id="push"></div>
    </div>
    </body>
<?php include "footer.inc.php";  ?>
    
</html>
