<?php
session_start();
include 'dbFunctions.php';
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
    }

    //Last Name
     $lname = sanitize_input($_POST['lastname']);
    

    //Email
    if(empty($_POST['email'])) {
        $errorMsg.= "Email is required.<br>";
        $sucess = false;
    } else {
        $email = sanitize_input($_POST['email']);
    }

     //Password
     if(empty($_POST['password'])) {
        $errorMsg.= "Password is required.<br>";
        $sucess = false;
    } else {
        $pwd_hashed = sanitize_input($_POST['password']);
    }

    //Mobile
    if(empty($_POST['mobile'])) {
        $errorMsg.= "Mobile is required.<br>";
        $sucess = false;
    } else {
        $mobile = sanitize_input($_POST['mobile']);
    }

    //Height
    $height = sanitize_input($_POST['height']);

    
    //Height
    $weight = sanitize_input($_POST['weight']);
      
    //Height
    $allergies = sanitize_input($_POST['allergies']);

}
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return($data);
}


function updateUserInfo() {
    global $nric,$fname, $lname, $email, $mobile, $height, $weight, $allergies, $errorMsg, $success;
    $link = db();
    // check connection    
    if ($link->connect_error){        
        $errorMsg = "Connection failed: " . $conn->connect_error;        
        $db_success = false;    
        
    } else {
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
                    //   echo "<h1>Profile Updated</h1>";
                    //   echo "<p>Your profile has been successfully updated!</p>";
                    //   echo "User account with username " . $_SESSION['NRIC'] . " successfully updated!";
                    //   echo "<div class='error-actions'>
                    //   <a href='index.php' class='btn btn-primary btn-lg'><span class='glyphicon glyphicon-home'></span>
                    //   Return to Home </a>
                    //   </div>";
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
                      <a href='userprofile.php' class='btn btn-primary btn-lg'><span class='glyphicon glyphicon-home'></span>
                      Return to User Profile </a>
                      </div>";
                      } 
                    ?>



        </main>

    </body>
</html>