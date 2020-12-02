<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
    ?>

<!DOCTYPE html>
<html lang="en">
	<head>
            <?php include "head.inc.php"; ?>
	</head>
	<body>
            <?php 
            include "timeout.inc.php"; 
            include "dbFunctions.php";
            $email = $fname = $lname = $email = $pwd_hashed = $mobile = $height = $weight = $allergies = $errorMsg="";
            $success = true;

            function showProfile() {
                global $nric, $fname, $lname, $email, $mobile, $height, $weight, $allergies, $errorMsg, $success;
                $link = db();
                // check connection    
                if ($link->connect_error){        
                    $errorMsg = "Connection failed: " . $conn->connect_error;        
                    $db_success = false;    

                } else {        
                    // Prepare the statement:       
                    $stmt = $link->prepare("SELECT * FROM Patient WHERE PatNRIC=?");      
                    $stmt->bind_param("s", $_SESSION['NRIC']);  
                    $stmt->execute();        
                    $result = $stmt->get_result();       
                    if ($result->num_rows > 0){            
                        $row = $result->fetch_assoc();        
                        $nric = $row["PatNRIC"];            
                        $fname = $row["PatFirstName"];            
                        $lname = $row["PatLastName"];   
                        $email = $row["PatEmail"];            
                        $mobile = $row["PatMobile"];            
                        $height = $row["PatHeight"];   
                        $weight = $row["PatWeight"];  
                        $allergies = $row["PatAllergies"];            
                    }      
                    $stmt->close();    
                }    
                $link->close();
            }

            showProfile();
            ?>
              <div class="uk-flex uk-flex-center uk-flex-middle uk-height-viewport uk-position-z-index uk-position-relative" data-uk-height-viewport="min-height: 400">
                                   <?php include "nav.inc.php"; ?>

                    <!-- <img src="images/login_asset.png" class="h-full w-6/12 " > -->
                <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m mr-6">
                <h2 class="text-2xl font-semibold">Your Account</h2>
                <p class="uk-heading-divider"><p>
                    <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">NRIC </h4>
                <label class="text-base font-normal"><?php echo $nric ?><label>
                </div>
                    <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">First Name</h4>
                <label class="text-base font-normal"><?php echo $fname ?><label>
                </div>
                    <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Last Name</h4>
                <label class="text-base font-normal"><?php echo $lname ?><label>
                </div>
                    <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Email </h4>
                <label class="text-base font-normal"><?php echo $email ?><label>
                </div>
                    <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Mobile </h4>
                <label class="text-base font-normal"><?php echo $mobile ?><label>
                </div>
                <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Height</h4>
                <label class="text-base font-normal"><?php echo $height ?><label>
                </div>
                <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Weight </h4>
                <label class="text-base font-normal"><?php echo $weight ?><label>
                </div>
                <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Allergies </p>
                <label class="text-base font-normal"><?php echo $allergies?><label>
                </div><br>
                    <div class="uk-margin-bottom">                    
                    <a href="profile_edit.php" class="uk-button uk-button-primary uk-width-1-3 m-0 rounded h-12 bg-blue-800">Edit Profile</a>
                    <a href="changePassword.php" class="uk-button uk-button-primary uk-width-1-3 m-0 rounded h-12 bg-blue-800">Edit Password</a></div>

                </div>
            
            </fieldset>
                </div>
             </div>
                
            <?php include "footer.inc.php";  ?>
	
	
		
		
		<!-- JS FILES -->
		<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
	</body>
</html>
    <?php
    
    }else{
        // show 404 error page
        include "404error.php";  
    }
?>


