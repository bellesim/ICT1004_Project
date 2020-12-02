<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
    ?>
  <?php
session_start();
 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <?php include "head.inc.php"; ?>

	</head>
	<body>
  <?php include "timeout.inc.php"; ?>
        
              <div class="uk-flex uk-flex-center uk-flex-middle uk-height-viewport uk-position-z-index uk-position-relative" data-uk-height-viewport="min-height: 400">
                    <!-- <img src="images/profile.png" class="h-full w-6/12 " > -->
             <?php include "nav.inc.php"; ?>
                <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m mr-6">
                <h2 class="text-2xl font-semibold">Your Account</h2>
                <p class="uk-heading-divider"><p>
                 <form role="form" method="post" action="profileEdit_process.php">
    <div class="uk-grid-small mt-8" uk-grid>
    <div class="uk-width-1-1">
    <p class="mb-2">What's your first name?</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="text" placeholder="Enter First Name" name="firstname" required>    
    </div>
    <div class="uk-width-1-1">
    <p class="mb-2">What's your last name?</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="text" placeholder="Enter Last Name" name="lastname" required>
    </div>
    <div class="uk-width-1-1">
    <p class="mb-2">Email</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="email" placeholder="Enter Email" name="email" required>
    </div>
    <div class="uk-width-1-1">
    <p class="mb-2"> Mobile</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="text" placeholder="Enter Mobile" name="mobile" required>
    </div>
    <div class="uk-width-1-4@s">
    <p class="mb-2">Height</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="text" placeholder="Enter Height" name="height" >     
    </div>
    <div class="uk-width-1-4@s">
    <p class="mb-2">Weight</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="text" placeholder="Enter Weight" name="weight" > 
    </div>
    <div class="uk-width-1-4@s">
    <p class="mb-2">Allergies</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="text" placeholder="Enter Allergies" name="allergies" required>
    </div>
    </div><br>
    <div class="uk-margin-bottom">
    <button type="submit" class="uk-button uk-button-primary uk-width-1-1 m-0 rounded h-12 bg-blue-800" href="profile_edit.php">Update Profile</button>
      </div>    
   </div>
    </form><br>
                 
                </div>
            
            </fieldset>
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


