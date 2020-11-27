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
            <?php 
            include "nav.inc.php"; 
            include "timeout.inc.php";
            ?>
            <div class="profileContainer mt-16  ml-24">
                <h2 id="myAccount" class="text-black text-4xl font-bold  mb-4">Your Account</h2>   
                <h1 class="uk-heading-divider"></h1>

                <div class="detailsContainer m-0 h-full">
                    <div class="uk-width-1-2\@m">
                        <h3 class="uk-card-title font-bold">Account Details</h3><br>
                        <button class="pwdrequirement" type="button" uk-toggle="target: #modal-pwd-requirement">Click to view requirement</button>
                        <form role="form" method="post" action="changePassword_process.php">
                            <div class="uk-grid-small" uk-grid>
                                <div class="uk-width-1-1">
                                    <p>Old Password</p>
                                    <input class="uk-input" type="password" name="oldPassword" >    
                                </div>
                                <div class="uk-width-1-1">
                                    <p>New Password</p>
                                    <input class="uk-input" type="password" name="newPassword" >    
                                </div>
                            </div>
                            <div class="uk-width-1-1">
                                <p>Confirm New Password</p>
                                <input class="uk-input" type="password" name="confirmPassword" >    
                            </div><br>
                            <!-- pop up model for password requirement -->
                            <div id="modal-pwd-requirement" uk-modal>
                                <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                                    <button class="uk-modal-close-default" type="button" uk-close></button>
                                    <div class="text-center">
                                    <h1 class="text-purple-800 font-semibold">Password Requirements</h1><br>
                                    <p>&#10004; Minimum 8 characters without space</p>
                                    <p>&#10004; At least one uppercase</p>
                                    <p>&#10004; At least one lowercase</p>
                                    <p>&#10004; At least one number</p>
                                    <p>&#10004; At least one symbol</p>
                                    </div>
                                </div>
                            </div>
                            <button class="uk-button" type="submit">Change Password</button>
                        </form>
                    </div>
                </div>
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
