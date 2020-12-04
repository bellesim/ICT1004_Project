<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
    ?>
  <?php
session_start();
 
?>
<html lang="en">
	<head>
        <title>Clinic Finder</title>
        <?php include "head.inc.php"; ?>

	</head>
	<body>
  <?php include "timeout.inc.php"; ?>
     <div class="top-wrap uk-position-relative pb-20"> 
                <?php include "nav.inc.php";?>
            </div>
        
  <div class="uk-flex uk-flex-center uk-flex-middle uk-height-viewport uk-position-z-index uk-position-relative" data-uk-height-viewport="min-height: 400">
   <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m mr-6">
     <h2 class="text-2xl font-semibold">Your Account</h2>
    <p class="uk-heading-divider"><p>
           <form method="post" action="changePassword_process.php">
                            <div class="uk-grid-small" uk-grid>
                                <div class="uk-width-1-1">
                                    <p>Old Password</p>
                                    <input class="uk-input rounded h-12 bg-gray-100" type="password" name="oldPassword" >    
                                </div>
                                <div class="uk-width-1-1">
                                    <p>New Password</p>
                                    <input class="uk-input rounded h-12 bg-gray-100 " type="password" name="newPassword" >    
                                </div>
                            </div>
                            <div class="uk-width-1-1">
                                <p>Confirm New Password</p>
                                <input class="uk-input rounded h-12 bg-gray-100" type="password" name="confirmPassword" >    
                            </div><br>
                <div class="uk-margin-bottom">
                    <button type="submit" class="uk-button uk-button-primary uk-width-1-1 m-0 rounded h-12 bg-blue-800">Change Password</button>
                    </div>                         
                 </form>
                 
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


