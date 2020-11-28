<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
    ?>
    <html>
        <head>
            <?php include "head.inc.php"; ?>
        </head>
        <body>
            <?php include "nav.inc.php"; ?>
            <?php include "timeout.inc.php"; ?>
            <div class="container">
                <p>Enter your contents here for Profile edit! :)</p>
            </div>            
            <?php include "footer.inc.php";  ?>
        </body>
    </html>
    <?php
    
    }else{
        // show 404 error page
        include "404error.php";  
    }
?>
