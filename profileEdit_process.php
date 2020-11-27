<?php
session_start();
include 'dbFunctions.php';
include 'authentication.php';
if (!isset($_SESSION['NRIC'])) {
    header("Location: error.php");
}

$email = $fname = $lname = $email = $pwd_hashed = $mobile = $height = $weight = $allergies = $errorMsg="";
$success = true;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //First Name
    if(empty($_POST['firstname'])) {
        $errorMsg.= "First name is required.<br>";
        $sucess = false;
    } else {
        $fname = sanitize_input($_POST['firstname']);
        $validate_fname = check_fullname($fname);
        if(!$validate_fname){
            $success = false;
            $errorMsg.= "First name is required.<br>";

        }
    }

    //Last Name
     if(empty($_POST['lastname'])) {
        $errorMsg.= "Last name is required.<br>";
        $sucess = false;
    } else {
        $lname = sanitize_input($_POST['lastname']);
        $validate_lname = check_fullname($lname);
        if(!$validate_lname){
            $success = false;
            $errorMsg.= "Last name is required.<br>";

        }
    }

    //Email
    if(empty($_POST['email'])) {
        $errorMsg.= "Email is required.<br>";
        $success = false;
    } else {
        $email = sanitize_input($_POST['email']);
        $validate_email = check_email($email);
        if(!$validate_email){
            $success = false;
            $errorMsg.= "Email is required.<br>";

        }
    }

    //Mobile
    if(empty($_POST['mobile'])) {
        $errorMsg.= "Mobile is required.<br>";
        $success = false;
    } else {
        $mobile = sanitize_input($_POST['mobile']);
        $validate_mobile = check_contact($mobile);
        if(!$validate_mobile){
            $success = false;
            $errorMsg.= "Mobile is required.<br>";

        }
    }

    //Height
    if(empty($_POST['height'])) {
        $errorMsg.= "Height is required.<br>";
        $success = false;
    } else {
        $height = sanitize_input($_POST['height']);
        $validate_height = check_double_format($height);
        if(!$validate_height){
            $success = false;
            $errorMsg.= "Height is required.<br>";

        }
    }

     //Weight
     if(empty($_POST['weight'])) {
        $errorMsg.= "Weight is required.<br>";
        $success = false;
    } else {
        $weight = sanitize_input($_POST['weight']);
        $validate_weight = check_double_format($weight);
        if(!$validate_weight){
            $success = false;
            $errorMsg.= "Weight is required.<br>";

        }
    }

     //Weight
     if(empty($_POST['allergies'])) {
        $errorMsg.= "Allergies is required.<br>";
        $success = false;
    } else {
        $allergies = sanitize_input($_POST['allergies']);
        if(!$validate_allergies){
            $success = false;
            $errorMsg.= "Allergies is required.<br>";

        }
    }
}


function updateUserInfo() {
    global $nric,$fname, $lname, $email, $mobile, $height, $weight, $allergies, $errorMsg, $success;
    $link = db();
    // check connection    
    if ($link->connect_error){        
        $errorMsg = "Connection failed: " . $conn->connect_error;        
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
            $updateProfile = $link->prepare("UPDATE Patient SET PatFirstName=?, PatLastName=?, PatEmail=?, PatMobile=?, PatHeight=?, PatWeight=?, PatAllergies=? WHERE PatNRIC=?");
            //bind & execute the query statement:
            $updateProfile->bind_param("ssssddss", $fname, $lname, $email,$mobile, $height, $weight, $allergies,$nric);
            $updateProfile->execute();
            if (!$updateProfile->execute()) {
                $errorMsg = "Execute failed: (" . $updateProfile->errno . ") " . $updateProfile->error . "<br>";
                $success = false;
            }
            $updateProfile->close();
            
        }
    }
    $link->close();
}

?>
<html>
    <head>
        <title>Update Profile</title>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/js/uikit-icons.min.js"></script>
    </head>

    <body>
        <?php
        include "nav.inc.php";
        ?>

        <main class="container">
                    <?php
                    updateUserInfo();
                      if ($success) {
                      $_SESSION['NRIC'] = $nric;
                      echo "<h1>Profile Updated</h1>";
                      echo "<p>Your profile has been successfully updated!</p>";
                      echo "User account with username " . $_SESSION['NRIC'] . " successfully updated!";
                      echo "<div class='error-actions'>
                      <a href='index.php'>Return to Home </a>
                      </div>";
                    echo "
                    <div id='modal-example' uk-modal>
                    <div class='uk-modal-dialog uk-modal-body'>
                    <h2 class='uk-modal-title'>Headline</h2>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p>
                    <button class='uk-button uk-button-default uk-modal-close' type='button'>Cancel</button>
                    <button class='uk-button uk-button-primary' type='button'>Save</button></p></div></div>";
                      } else {
                      echo "<h1>Unable to Update Profile</h1>";
                      echo "Reason: " . $errorMsg;
                      echo "<div class='error-actions'>
                      <a href='profile_edit.php'>Return to Profile </a>
                      </div>";
                      } 
                    ?>



        </main>

    </body>
</html>