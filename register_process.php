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
        $success = $db_success = true;
        //$validate_name = $validate_nric_fin = $validate_contact = $validate_email = $validate_pwd_identical = $validate_pwd = $validate_height = $validate_weight = $validate_allergies = 
        $registered_nric_fin = $registered_email = false;
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
            // create database connection   
            $config = parse_ini_file('../../private/db-config.ini');    
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);    

            // check connection    
            if ($conn->connect_error){        
                $errorMsg = "Connection failed: " . $conn->connect_error;        
                $success = false;    

            } else {        
                // check whether nric/fin is registered before     
                $stmt1 = $conn->prepare("SELECT * FROM Patient WHERE PatNRIC=?");        
                $stmt1->bind_param("s", $nric_fin);        
                $stmt1->execute();        
                $result1 = $stmt1->get_result();   
                // if there's a row return, means registered before
                if ($result1->num_rows > 0){            
                    $registered_nric_fin = true;
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
                    $registered_email = true;
                    $success = false;
                } 
                $stmt2->close();
            }    
            $conn->close();
        } 
        
        // to insert the patient's details into db
        function insertMemberToDB(){     
            global $nric_fin, $pwd_hashed, $fname, $lname, $email, $contact, $weight, $height, $allergies, $errorMsg, $db_success; 
            // create database connection.    
            $config = parse_ini_file('../../private/db-config.ini');    
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);    

            // check connection    
            if ($conn->connect_error){        
                $errorMsg = "Connection failed: " . $conn->connect_error;        
                $db_success = false;    

            } else {        
                // insert data into patient table 
                $stmt = $conn->prepare("INSERT INTO Patient (PatNRIC, PatPassword, PatFirstName, PatLastName, PatEmail, PatMobile, PatWeight, PatHeight, PatAllergies) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");            
                $stmt->bind_param("ssssssdds", $nric_fin, $pwd_hashed, $fname, $lname, $email, $contact, $weight, $height, $allergies);  
                if (!$stmt->execute()){            
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;            
                    $db_success = false;        
                }    
                $stmt->close();    
            }    
            $conn->close();
        } 

        // if required fields are not empty, validate each field with the functions in authentication.php
        if((!empty($_POST["lname"]))&&(!empty($_POST["nric_fin"]))&&(!empty($_POST["email"]))&&(!empty($_POST["contact"]))&&(!empty($_POST["pwd"]))&&(!empty($_POST["pwd_confirm"]))&&(!empty($_POST["height"]))&&(!empty($_POST["weight"]))&&(!empty($_POST["allergies"]))){

            // validate last name 
            $lname = sanitize_input($_POST["lname"]);
            $validate_name = check_fullname($lname);
            if (!$validate_name){
                $success = false;
            }
            
            // validate first name if exist
            if(!empty($_POST["fname"])){
                $fname = sanitize_input($_POST["fname"]);
                $validate_name = check_fullname($fname);
                if (!$validate_name){
                    $success = false;
                }
            }else{
                $fname = "NULL";
            }

            // validate NRIC/FIN
            $nric_fin = strtoupper(sanitize_input($_POST["nric_fin"]));
            $validate_nric_fin = check_NRIC($nric_fin);
            if (!$validate_nric_fin){
                $success = false;
            }
            
            // validate email 
            $email = sanitize_input($_POST["email"]);
            $validate_email = check_email($email);
            if (!$validate_email){
                $success = false;
            }

            // validate contact number
            $contact = sanitize_input($_POST["contact"]);
            $validate_contact = check_contact($contact);
            if (!$validate_contact){
                $success = false;
            }
            
            
            // validate password
            if($_POST["pwd"] == $_POST["pwd_confirm"]){
                $validate_pwd_identical = true;
                $validate_pwd = check_password($_POST["pwd"]);
                if (!$validate_pwd){
                    $success = false;
                }else{
                    $pwd_hashed = password_hash($_POST["pwd"],PASSWORD_DEFAULT);
                }
            }else{
                $validate_pwd_identical = $success = false;
            }
            
            
            // validate height
            $validate_height = check_double_format($_POST["height"]);
            if(!$validate_height){
                $success = false;
            }else{
                $height = (double)sanitize_input($_POST["height"]);
            }
            
            // validate weight
            $validate_weight = check_double_format($_POST["weight"]);
            if(!$validate_weight){
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
                    <h1 class="font-bold text-2xl text-purple-800">Failed to login!</h1>
                    <p class="font-bold">The following input errors were detected:</p>
                    <p>&#10008;  <?php echo $errormsg;?></p>
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
                if(!$validate_name){
                    echo "<p>&#10008;  Invalid name format (ONLY alphabets are allowed for name).</p>";
                }
                if(!$validate_nric_fin){
                    echo "<p>&#10008;  Invalid NRIC/FIN format.</p>";
                }
                if($registered_nric_fin){
                    echo "<p>&#10008;  NRIC/FIN is registered before, please login with the existing NRIC/FIN or register with a new NRIC/FIN.</p>";
                }
                if(!$validate_email){
                    echo "<p>&#10008;  Invalid email format.</p>";
                }
                if($registered_email){
                    echo "<p>&#10008;  Email is registered before, please register with a new email address.</p>";
                }
                if(!$validate_contact){
                    echo "<p>&#10008;  Invalid Singapore phone number.</p>";
                }
                if(!$validate_pwd_identical){
                    echo "<p>&#10008;  Password not identical.</p>";
                }
                if(!$validate_pwd){
                    echo "<p>&#10008;  Invalid password format.</p>";
                }
                if(!$validate_height){
                    echo "<p>&#10008;  Invalid height format.</p>";
                }
                if(!$validate_weight){
                    echo "<p>&#10008;  Invalid weight format.</p>";
                }
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