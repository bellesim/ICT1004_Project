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
            <div class="detailsContainer m-0 h-full  ml-24 uk-width-1-2\@m" >
                <h2 id="myAccount" class="text-black text-4xl font-bold  mb-4">Your Account</h2>   

                <h3 class="uk-card-title font-bold">Edit Account Details</h3><br>
                <p class="italic text-red-700 mb-8">* mandatory fields</p>
                <form role="form" method="post" action="profileEdit_process.php">
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-1-1">
                            <p>First Name*</p>
                            <input class="uk-input" type="text" placeholder="Enter your first name" name="firstname">    
                        </div>
                        <div class="uk-width-1-1">
                            <p>Last Name*</p>
                            <input class="uk-input" type="text" placeholder="Enter your last name" name="lastname" required>
                        </div>
                        <div class="uk-width-1-1">
                            <p>Email*</p>
                            <input class="uk-input" type="email" placeholder="Enter your email" name="email" required>
                        </div>
                        <div class="uk-width-1-1">
                            <p>Mobile*</p>
                            <input class="uk-input" type="tel" name="mobile" pattern="[0-9]{8}"
                            placeholder="Enter your contact number without space (e.g. 98765432)" required>
                        </div>
                        <div class="uk-width-1-4\@s">
                            <p>Height*</p>
                            <input class="uk-input" type="text" name="height" maxlength="5" 
                            placeholder="Enter your height in cm (1 decimal point is allowed)" required>     
                        </div>
                        <div class="uk-width-1-4\@s">
                            <p>Weight*</p>
                            <input class="uk-input" type="text" name="weight" maxlength="5" 
                            placeholder="Enter your weight in cm (1 decimal point is allowed)" required> 
                        </div>
                        <div class="uk-width-1-4\@s">
                            <p>Allergies*</p>
                            <input class="uk-input" type="text" placeholder="Enter your allergies" name="allergies" required>
                        </div>
                    </div><br>
                    <button type="submit" class="uk-button">Update Details</button>
                </form>
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
