<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
    ?>
    <html lang="en">
        <head>
              <title>Edit Profile</title>
            <?php include "head.inc.php"; ?>
        </head>
        <body>
            <div class="top-wrap uk-position-relative pb-20"> 
                <?php include "nav.inc.php";?>
            </div>
            <?php 
            include "timeout.inc.php";
            include "dbFunctions.php";
            include "authentication.php";
            $email = $fname = $lname = $email = $pwd_hashed = $mobile = $height = $weight = $allergies = $DOB = $gender = $errorMsg="";
            $success = true;

            function updateUserInfo() {
                global $nric,$fname, $lname, $email, $mobile, $height, $weight, $allergies,$DOB, $gender, $errorMsg, $success;
                $link = db();
                // check connection    
                if ($link->connect_error){        
                    $errorMsg .= "&#10008;  Connection failed: " . $conn->connect_error;        
                    $db_success = false;    

                } else {
                    //Mock NRIC 
                    $tempnric=$_SESSION['NRIC'];    
                    $stmt = $link->prepare("SELECT * FROM Patient WHERE PatNRIC=?");  
                    $stmt->bind_param("s",$tempnric);  
                    $stmt->execute();
                    $result = $stmt->get_result();       
                    if ($result->num_rows > 0){            
                        $row = $result->fetch_assoc();        
                        $nric = $row["PatNRIC"];            
                        $email = $row["PatEmail"];             
                    }   
                    $stmt->close();  

                    if ($success) {
                        //Prepared statement
                        $updateProfile = $link->prepare("UPDATE Patient SET PatFirstName=?, PatLastName=?, PatEmail=?, PatMobile=?, PatHeight=?, PatWeight=?, PatAllergies=?, PetDoB=?, PetGender=? WHERE PatNRIC=?");
                        //bind & execute the query statement:
                        $updateProfile->bind_param("ssssddssss", $fname, $lname, $email,$mobile, $height, $weight, $allergies, $DOB, $gender,$nric);
                        $updateProfile->execute();
                        if (!$updateProfile->execute()) {
                            $errorMsg .= "&#10008;  Execute failed: (" . $updateProfile->errno . ") " . $updateProfile->error . "<br>";
                            $success = false;
                        }
                        $updateProfile->close();

                    }
                }
                $link->close();
            }
            
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                //First Name
                if(!empty($_POST['firstname'])){
                    $fname = sanitize_input($_POST['firstname']);
                    $validate_fname = check_fullname($fname);
                    if (!$validate_fname){
                        $errorMsg .= "&#10008;  Invalid first name format (ONLY alphabets are allowed).<br>";
                        $success = false;
                    }
                }else{
                    $fname = "NULL";
                }

                //Last Name
                if(empty($_POST['lastname'])) {
                    $errorMsg.= "&#10008;  Last name is required.<br>";
                    $success = false;
                } else {
                    $lname = sanitize_input($_POST['lastname']);
                    $validate_lname = check_fullname($lname);
                    if(!$validate_lname){
                        $errorMsg.= "&#10008;  Invalid last name format (ONLY alphabets are allowed).<br>";
                        $success = false;
                    }
                }

                 //DOB
                if(!empty($_POST['dob'])){
                    $errorMsg.= "&#10008;  DOB is required.<br>";
                    $success = false;                   
                }else{
                    $DOB = "NULL";
                }

                //Gender
                if(!empty($_POST['gender'])){
                    $errorMsg.= "&#10008;  Gender is required.<br>";
                    $success = false;                   
                }else{
                    $gender = "NULL";
                }

                //Last Name
                if(empty($_POST['lastname'])) {
                    $errorMsg.= "&#10008;  Last name is required.<br>";
                    $success = false;
                } else {
                    $lname = sanitize_input($_POST['lastname']);
                    $validate_lname = check_fullname($lname);
                    if(!$validate_lname){
                        $errorMsg.= "&#10008;  Invalid last name format (ONLY alphabets are allowed).<br>";
                        $success = false;
                    }
                }


                //Email
                if(empty($_POST['email'])) {
                    $errorMsg.= "&#10008;  Email is required.<br>";
                    $success = false;
                } else {
                    $email = sanitize_input($_POST['email']);
                    $validate_email = check_email($email);
                    if(!$validate_email){
                        $errorMsg.= "&#10008;  Invalid email format.<br>";
                        $success = false;
                    }
                }

                //Mobile
                if(empty($_POST['mobile'])) {
                    $errorMsg.= "&#10008;  Mobile is required.<br>";
                    $success = false;
                } else {
                    $mobile = sanitize_input($_POST['mobile']);
                    $validate_mobile = check_contact($mobile);
                    if(!$validate_mobile){
                        $errorMsg.= "&#10008;  Invalid Singapore phone number.<br>";
                        $success = false;
                    }
                }

                //Height
                if(empty($_POST['height'])) {
                    $errorMsg.= "&#10008;  Height is required.<br>";
                    $success = false;
                } else {
                    $validate_height = check_double_format($_POST["height"]);
                    if(!$validate_height){
                        $errorMsg .= "&#10008;  Invalid height format.<br>.";
                        $success = false;
                    }else{
                        $height = (double)sanitize_input($_POST["height"]);
                    }
                }

                //Weight
                if(empty($_POST['weight'])) {
                    $errorMsg.= "&#10008;  Weight is required.<br>";
                    $success = false;
                } else {
                    $validate_weight = check_double_format($_POST['weight']);
                    if(!$validate_weight){
                        $errorMsg .= "&#10008;  Invalid weight format.<br>.";
                        $success = false;
                    }else{
                        $weight = (double)sanitize_input($_POST['weight']);
                    }
                }
                
                //Allergies
                if(empty($_POST['allergies'])) {
                    $errorMsg.= "&#10008;  Allergies is required.<br>";
                    $success = false;
                } else {
                    $allergies = sanitize_input($_POST['allergies']);
                    $validate_allergies = check_allergies($allergies);
                    if(!$validate_allergies){
                        $allergies = "None";
                    }
                }
                
            }

            ?>

            
                    <?php
                        updateUserInfo();
                        if ($success) {
                            ?>
                            <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                                <div class="space-y-6 text-center">
                                    <h3 class="uk-card-title font-bold" style="color:#1e40af;">Profile Updated!</h3>
                                    <p>Your profile has been successfully updated!</p>
                                    <p class="uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="profile.php">Back to Profile</a></p>

                                </div>
                            </div> 


                        <?php
                        } else {
                        ?>
                        <div class="h-screen">
                         <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                            <div class="space-y-6 text-black">
                                <h3 class="uk-card-title font-bold" style="color:#B22222;">Unable to Update Profile!</h3>
                                <p class="font-bold">Reason(s):</p>
                                <p><?php echo errorMsg;?></p>
                                <p class="mt-16 mb-8">Please try again.</p>
                                <p class="uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="profile.php">Back to Profile</a></p>
                            </div>
                        </div> 
                        </div>
                          <?php
                        } 
                    ?>




            <?php include "footer.inc.php";  ?>
        </body>
    </html>
    <?php
    
    }else{
        // show 404 error page
        include "404error.php";  
    }
?>
