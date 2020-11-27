<!DOCTYPE html>
<html>
<head>
    <?php
        include "head.inc.php";
    ?>
</head>

<body>
    <?php
        include "nav.inc.php";
        include "authentication.php";
        include "dbFunctions.php";
        $success = $db_success = true;
        $errorMsg = "";
        $empty_field = false;
        
        function combineName($first,$last){
            if($first=="NULL"){
                $fullname = $last;
                
            }else{
                $fullname = $first . ' ' . $last;
            }
            return $fullname;
        }
        
        // nric/fin and email must be unique
        // this function is to check whether the nric/fin and email is registered before
        function checkRegistered(){     
            global $nric_fin, $email, $registered_nric_fin, $registered_email, $success, $errorMsg;
            
            $conn = db();
            
            // check connection    
            if ($conn->connect_error){        
                $errorMsg .= "Connection failed: " . $conn->connect_error;        
                $success = false;    

            } else {        
                // check whether nric/fin is registered before     
                $stmt1 = $conn->prepare("SELECT * FROM Patient WHERE PatNRIC=?");        
                $stmt1->bind_param("s", $nric_fin);        
                $stmt1->execute();        
                $result1 = $stmt1->get_result();   
                // if there's a row return, means registered before
                if ($result1->num_rows > 0){    
                    $errorMsg .= "&#10008;  Invalid NRIC/FIN format.<br>";
                    $success = false;
                } 
                $stmt1->close();
                
                // check whether email is registered before 
                $stmt2 = $conn->prepare("SELECT * FROM Patient WHERE PatEmail=?");             
                $stmt2->bind_param("s", $email);        
                $stmt2->execute();        
                $result2 = $stmt2->get_result(); 
                // if there's a row return, means registered before
                if ($result2->num_rows > 0){            
                    $errorMsg .= "&#10008;  NRIC/FIN is registered before, please login with the existing NRIC/FIN or register with a new NRIC/FIN.<br>";
                    $success = false;
                } 
                $stmt2->close();
            }    
            $conn->close();
        } 
        
        // to insert the patient's details into db
        function insertMemberToDB(){     
            global $nric_fin, $pwd_hashed, $fname, $lname, $email, $contact, $weight, $height, $allergies, $errorMsg, $db_success; 
            
            $conn = db();
            // check connection    
            if ($conn->connect_error){        
                $errorMsg .= "&#10008;  Connection failed: " . $conn->connect_error;        
                $db_success = false;    

            } else {        
                // insert data into patient table 
                $stmt = $conn->prepare("INSERT INTO Patient (PatNRIC, PatPassword, PatFirstName, PatLastName, PatEmail, PatMobile, PatWeight, PatHeight, PatAllergies) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");            
                $stmt->bind_param("ssssssdds", $nric_fin, $pwd_hashed, $fname, $lname, $email, $contact, $weight, $height, $allergies);  
                if (!$stmt->execute()){            
                    $errorMsg .= "&#10008;  Execute failed: (" . $stmt->errno . ") " . $stmt->error;            
                    $db_success = false;        
                }    
                $stmt->close();    
            }    
            $conn->close();
        } 

        // if required fields are not empty, validate each field with the functions in authentication.php
        if((!empty($_POST["lname"]))&&(!empty($_POST["nric_fin"]))&&(!empty($_POST["email"]))&&(!empty($_POST["contact"]))&&(!empty($_POST["pwd"]))&&(!empty($_POST["pwd_confirm"]))&&(!empty($_POST["height"]))&&(!empty($_POST["weight"]))&&(!empty($_POST["allergies"]))){

            // validate first name if exist
            if(!empty($_POST["fname"])){
                $fname = sanitize_input($_POST["fname"]);
                $validate_fname = check_fullname($fname);
                if (!$validate_fname){
                    $errorMsg .= "&#10008;  Invalid first name format (ONLY alphabets are allowed).<br>";
                    $success = false;
                }
            }else{
                $fname = "NULL";
            }

            // validate last name 
            $lname = sanitize_input($_POST["lname"]);
            $validate_lname = check_fullname($lname);
            if (!$validate_lname){
                $errorMsg .= "&#10008;  Invalid last name format (ONLY alphabets are allowed).<br>";
                $success = false;
            }
            
            // validate NRIC/FIN
            $nric_fin = strtoupper(sanitize_input($_POST["nric_fin"]));
            $validate_nric_fin = check_NRIC($nric_fin);
            if (!$validate_nric_fin){
                $errorMsg .= "&#10008;  Invalid NRIC/FIN format.<br>";
                $success = false;
            }
            
            // validate email 
            $email = sanitize_input($_POST["email"]);
            $validate_email = check_email($email);
            if (!$validate_email){
                $errorMsg .= "&#10008;  Invalid email format.<br>";
                $success = false;
            }

            // validate contact number
            $contact = sanitize_input($_POST["contact"]);
            $validate_contact = check_contact($contact);
            if (!$validate_contact){
                $errorMsg .= "&#10008;  Invalid Singapore phone number.<br>";
                $success = false;
            }
            
            
            // validate password
            if($_POST["pwd"] == $_POST["pwd_confirm"]){
                $validate_pwd_identical = true;
                $validate_pwd = check_password($_POST["pwd"]);
                if (!$validate_pwd){
                    $errorMsg .= "&#10008;  Invalid password format.<br>";
                    $success = false;
                }else{
                    $pwd_hashed = password_hash($_POST["pwd"],PASSWORD_DEFAULT);
                }
            }else{
                $errorMsg .= "&#10008;  Password not identical.<br>";
                $validate_pwd_identical = $success = false;
            }
            
            
            // validate height
            $validate_height = check_double_format($_POST["height"]);
            if(!$validate_height){
                $errorMsg .= "&#10008;  Invalid height format.<br>";
                $success = false;
            }else{
                $height = (double)sanitize_input($_POST["height"]);
            }
            
            // validate weight
            $validate_weight = check_double_format($_POST["weight"]);
            if(!$validate_weight){
                $errorMsg .= "&#10008;  Invalid weight format.<br>";
                $success = false;
            }else{
                $weight = (double)sanitize_input($_POST["weight"]);
            }
            
            // validate allergies
            $validate_allergies = check_allergies($_POST["allergies"]);
            if(!$validate_allergies){
                $allergies = "None";    // if user only key in spaces for this field, will just save the value is "None"
            }else{
                $allergies = sanitize_input($_POST["allergies"]);
            }

            // check whether the nric/fin or email is registered before
            checkRegistered();
            
        // if any required field is empty
        }else{  
            $empty_field = true;
            $success = false;
        }
        
        // display result
        echo "<main class=\"container\" style=\"margin-top:40px;\">";
        if($success){
            
            insertMemberToDB();
            if($db_success){
                // send notification email;
                $username = combineName($fname,$lname);
                /*
                $subject = "Clinic Finder: Account Registered Successfully";
                $txt = "Dear " .$username.",\n\nThank you for signing up to Clinic Finder! This is an email to inform you that your account is registered successfully.\n\nBest Regards,\n Clinic Finder Team";
                $msg = wordwrap($txt,70);
                $headers = "From: no-reply@ClinicFinder.com";

                mail($email,$subject,$txt,$headers);*/
                ?>
                <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                    <h1 class="font-bold text-2xl text-purple-800">Your account is registered successfully!</h1>
                    <p>Welcome to be part of our family, <?php echo $username;?></p>
                    <p>You will receive an email from us notify that the account is registered successfully. </p>
                    <p>You may proceed to login with your NRIC/FIN and password.</p>
                    <button class="loginformbutton font-semibold"><a href="login.php">Login</a></button>
                </div>    
                <?php

            }else{
                ?>
                <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                    <h1 class="font-bold text-2xl text-purple-800">Failed to register!</h1>
                    <p class="font-bold">Reason:</p>
                    <p><?php echo $errorMsg;?></p>
                    <p class="mt-16 mb-8">Please try again.</p>
                    <button class="loginformbutton font-semibold"><a href="login.php">Back to Register</a></button>
                </div>    
                <?php
            }
        }else{
            ?>
            <div class="space-y-6 text-black" style="margin: auto; width: 50%; padding-bottom: 100px;">
                <h1 class="font-bold text-2xl text-purple-800">Failed to register!</h1>
                <p class="font-bold">The following input errors were detected:</p>
                
            <?php
            if($empty_field){
                echo "<p>&#10008;  All fields are required to fill in (except for first name).</p>";
            }else{
                echo "<p>" .$errorMsg. "</p>";
            }
                ?>
                <p class="mt-16 mb-8">Please try again.</p>
                <button class="loginformbutton font-semibold"><a href="login.php">Back to Register</a></button>
            </div>    
    
        <?php
        }
        include "footer.inc.php";?>
</body>
</html>