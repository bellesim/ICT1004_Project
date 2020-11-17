<!-- <?php 
$msg = "Please log in first.";
include 'authentication.php';

if (!isset($_SESSION['UserID'])) {

    echo ("<script type='text/javascript'>
        alert('$msg')
        location.href='index.php';</script>");
} 

$UserID = $_SESSION['UserID'];
$UserName = $_SESSION['UserName']; 
$FullName = $_SESSION['FullName']; 
$Email = $_SESSION['Email'];
?> -->
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/main.css">
        <title>Home</title>
        <?php include "nav.inc.php"; ?>

    </head>
    
    <header>
        
    </header>
    
    <body>

        <div class="container">
        <h2>Profile</h2>
            <div class="profileInfoContainer">
                <div class="infoDetails">
                    <h3>Full Name</h3>
                    <p><?php echo $FullName; ?></p>
                </div>
                <div class="infoDetails">
                    <h3>Username</h3>
                    <p><?php echo $UserName; ?></p>
                </div>
                <div class="infoDetails">
                    <h3>Email</h3>
                    <p><?php echo $Email; ?></p>
                </div>
            </div>
        </div>        </div>            
            
        
        
<?php include "footer.inc.php";  ?>

    </body>
</html>
