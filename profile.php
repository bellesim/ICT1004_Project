<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
    ?>

<html lang="en">
	<head>
            <title>Profile</title>
            <?php include "head.inc.php"; ?>
	</head>
	<body>
            <?php 
            include "timeout.inc.php"; 
            include "dbFunctions.php";
            $email = $fname = $lname = $email = $pwd_hashed = $mobile = $height = $weight = $allergies = $DOB = $gender = $errorMsg="";
            $success = true;

            function showProfile() {
                global $nric, $fname, $lname, $email, $mobile, $height, $weight, $allergies, $DOB, $gender, $errorMsg, $success;
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
                        $DOB = $row["PatDoB"];    
                        $gender = $row["PatGender"];            
        
          
                    }      
                    $stmt->close();    
                }    
                $link->close();
            }

            showProfile();
            ?>
            <div class="top-wrap uk-position-relative pb-20"> 
                <?php include "nav.inc.php";?>
            </div>
              <div class="uk-flex uk-flex-center uk-flex-middle uk-height-viewport uk-position-z-index uk-position-relative">
                <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m mr-6">
                <h2 class="text-2xl font-semibold">Your Account</h2>
                <p class="uk-heading-divider"><p>
                    <div class="uk-grid-small mt-8" uk-grid>
                <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">NRIC </h4>
                <label class="text-base font-normal"><?php echo $nric ?></label>
                </div>
                    <div class="uk-width-1-2">
                <h4 class="text-base font-semibold mt-4">First Name</h4>
                <label class="text-base font-normal"><?php echo $fname ?></label>
                </div>
                    <div class="uk-width-1-2">
                <h4 class="text-base font-semibold mt-4">Last Name</h4>
                <label class="text-base font-normal"><?php echo $lname ?></label>
                </div>
                <div class="uk-width-1-2">
                <h4 class="text-base font-semibold mt-4">Date of Birth </h4>
                <label class="text-base font-normal"><?php echo $DOB?></label>
                </div>
                  <div class="uk-width-1-2">
                <h4 class="text-base font-semibold mt-4">Gender </h4>
                <label class="text-base font-normal"><?php echo $gender?></label>
                </div>
                    <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Email </h4>
                <label class="text-base font-normal"><?php echo $email ?></label>
                </div>
                    <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Mobile </h4>
                <label class="text-base font-normal"><?php echo $mobile ?></label>
                </div>
                <div class="uk-width-1-4@s">
                <h4 class="text-base font-semibold mt-4">Height</h4>
                <label class="text-base font-normal"><?php echo $height ?></label>
                </div>
                <div class="uk-width-1-4@s">
                <h4 class="text-base font-semibold mt-4">Weight </h4>
                <label class="text-base font-normal"><?php echo $weight ?></label>
                </div>
                <div class="uk-width-1-4@s">
                <h4 class="text-base font-semibold mt-4">Allergies </h4>
                <label class="text-base font-normal"><?php echo $allergies?></label>
                </div>
                </div><br>

                    <div class="mb-8 flex">                    
                    <a href="profile_edit.php" class="uk-button uk-button-primary uk-width-1-3 m-0 rounded h-12 bg-blue-800">Edit Profile</a>
                    <a href="changePassword.php" class="uk-button uk-button-primary uk-width-1-3 m-0 rounded h-12 bg-blue-800">Edit Password</a></div>

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


