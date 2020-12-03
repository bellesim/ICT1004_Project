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
     <div class="top-wrap uk-position-relative pb-20"> 
                <?php include "nav.inc.php";?>
            </div>

            
        
  <div class="uk-flex uk-flex-center uk-flex-middle uk-height-viewport uk-position-z-index uk-position-relative" data-uk-height-viewport="min-height: 400">
   <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m mr-6 mt-8 ">
     <h2 class="text-2xl font-semibold">Your Account</h2>
    <p class="uk-heading-divider"><p>
     <form role="form" method="post" action="profileEdit_process.php">
    <div class="uk-grid-small mt-8" uk-grid>
    <div class="uk-width-1-1">
    <p class="mb-2">First Name</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="text" placeholder="Enter your first name" name="firstname" aria-label="first name">    
    </div>
    <div class="uk-width-1-1">
    <p class="mb-2">Last Name*</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="text" placeholder="Enter your last name" name="lastname" aria-label="last name" required>
    </div>
    <div class="uk-width-1-1">
    <p class="mb-2">Email*</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="text" placeholder="Enter your email" name="email" aria-label="email" required>
    </div>
    <div class="uk-width-1-1">
    <p class="mb-2">Mobile*</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="tel" pattern="[0-9]{8}"placeholder="Enter your contact" name="mobile" aria-label="mobile" required>
    </div>
    <div class="uk-width-1-4@s">
    <p class="mb-2">Height</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="text" maxlength="5" placeholder="Enter height" name="height" aria-label="height" required>     
    </div>
    <div class="uk-width-1-4@s">
    <p class="mb-2">Weight</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="text" maxlength="5"  placeholder="Enter weight" name="weight" aria-label="weight"> 
    </div>
    <div class="uk-width-1-4@s">
    <p class="mb-2">Allergies</p>
    <input class="uk-input rounded h-12 bg-gray-100" type="text" placeholder="Enter Allergies" name="allergies" aria-label="allergies" required>
    </div>
    </div>
       <div class="uk-margin-bottom mt-4">
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


