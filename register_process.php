<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clinic Finder</title>
    <?php
        include "head.inc.php";
    ?>
</head>

<body>
    <div class="top-wrap uk-position-relative pb-20"> 
        <?php include "nav.inc.php";?>
    </div>	
    <main>
    <?php
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
                    $errorMsg .= "&#10008;  Email is registered before, please login with the existing NRIC/FIN or register with a new NRIC/FIN.<br>";
                    $success = false;
                } 
                $stmt2->close();
            }    
            $conn->close();
        } 
        
        
        // to insert the patient's details into db
        function insertMemberToDB(){     
            global $nric_fin, $pwd_hashed, $fname, $lname, $email, $contact, $dob, $gender, $weight, $height, $allergies, $errorMsg, $db_success; 
            
            $conn = db();
            // check connection    
            if ($conn->connect_error){        
                $errorMsg .= "&#10008;  Connection failed: " . $conn->connect_error;        
                $db_success = false;    

            } else {        
                // insert data into patient table 
                $stmt = $conn->prepare("INSERT INTO Patient (PatNRIC, PatPassword, PatFirstName, PatLastName, PatEmail, PatMobile, PatWeight, PatHeight, PatAllergies, PatDoB, PatGender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");            
                $stmt->bind_param("ssssssddsss", $nric_fin, $pwd_hashed, $fname, $lname, $email, $contact, $weight, $height, $allergies, $dob, $gender);  
                if (!$stmt->execute()){            
                    $errorMsg .= "&#10008;  Execute failed: (" . $stmt->errno . ") " . $stmt->error;            
                    $db_success = false;        
                }    
                $stmt->close();    
            }    
            $conn->close();
        } 

        // if required fields are not empty, validate each field with the functions in authentication.php
        if((!empty($_POST["lname"]))&&(!empty($_POST["nric_fin"]))&&(!empty($_POST["email"]))&&(!empty($_POST["contact"]))&&(!empty($_POST["pwd"]))&&(!empty($_POST["pwd_confirm"]))&&(!empty($_POST["height"]))&&(!empty($_POST["weight"]))&&(!empty($_POST["allergies"]))&&(!empty($_POST["dob"]))&&(!empty($_POST["gender"]))){

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
            
            // validate dob
            if(!check_appt_date($_POST["dob"])){
                $errorMsg .= "&#10008;  Invalid date of birth. <br>";
                $success = false;
            }else{
                $dob = sanitize_input($_POST["dob"]);
            }
            
            // sanitise gender
            if (($_POST["gender"]=="male")||($_POST["gender"]=="female")){
                $gender = sanitize_input($_POST["gender"]);
            } else {
                $errorMsg .= "&#10008;  Invalid gender. <br>";
                $success = false;
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
        if($success){
            
            insertMemberToDB();
            if($db_success){
                $username = combineName($fname,$lname);
                ?>
                <div class="h-screen">
                <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                    <div class="space-y-6 text-center text-black">
                        <h3 class="uk-card-title font-bold" style="color:#1e40af;">Your account is registered successfully!</h3>
                        <p>Welcome to be part of our family, <?php echo $username;?></p>
                        <p>You may proceed to login with your NRIC/FIN and password.</p>
                        <p class="uk-width-1-3 uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="login.php">Login</a></p>
                    </div>
                </div> 
                </div>
                <?php

            }else{
                ?>
                <div class="h-screen">
                <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                    <div class="space-y-6 text-black">
                        <h1 class="uk-card-title font-bold" style="color:#B22222;">Failed to register!</h1>
                        <p class="font-bold">Reason(s):</p>
                        <p><?php echo $errorMsg;?></p>
                        <p class="mt-16 mb-8">Please try again.</p>
                        <p class="uk-width-1-3 uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="register.php">Back to Register</a></p>
                    </div>
                </div>  
                </div>
                <?php
            }
        }else{
            ?>
            <div class="h-screen">
            <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                <div class="space-y-6 text-black">
                    <h1 class="uk-card-title font-bold" style="color:#B22222;">Failed to register!</h1>
                    <p class="font-bold">Reason(s):</p>
                
                    <?php
                    if($empty_field){
                        echo "<p>&#10008;  All fields are required to fill in (except for first name).</p>";
                    }else{
                        echo "<p>" .$errorMsg. "</p>";
                    }
                        ?>
                    <p class="mt-16 mb-8">Please try again.</p>
                    <p class="uk-width-1-3 uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="register.php">Back to Register</a></p>
                </div>   
            </div>
            </div>
        
        <?php
        }
        ?>
        </main><?php
        include "footer.inc.php";?>
</body>
</html>