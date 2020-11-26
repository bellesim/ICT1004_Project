<?php
session_start();
include 'dbFunctions.php';

if (!isset($_SESSION['NRIC'])) {
    header("Location: error.php");
}

function updatePassword() {
    global $old_pw,$new_pw, $new_cpw, $errorMsg, $success, $nric, $password;
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
            $password = $row["PatPassword"];          
        }   
        $stmt->close();  
        
        if ($success) {
          //Prepared statement
          $updateProfile = $link->prepare("UPDATE Patient SET PatPassword=? WHERE PatNRIC=?");
          //bind & execute the query statement:
          $encryptedPassword=password_hash($new_pw,PASSWORD_BCRYPT);
          $updateProfile->bind_param("ss", $encryptedPassword,$nric);
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
    <title>Update Password</title>
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
    <?php
    

$pwdErr = $cfmPwdErr = "";
$pwd = $cfmPwd = "";
$oldpwd="";
$success = true;


?>
    </head>

    <body>
        <?php
        include "nav.inc.php";
        ?>
        <main class="container">
                    <?php
                    updatePassword();



if($_SERVER["REQUEST_METHOD"] == "POST") {
    //Old password 
    if(empty($_POST['oldPassword'])) {
        $errorMsg.= "Old password is required.<br>";
        $success = false;
    } else {
        //cannot take db pw parameter
        if(password_verify($_POST['oldPassword'], $password)){
            $old_pw = $_POST["oldPassword"];
            $success = true;
        }
    }

    //New password
    if(empty($_POST['newPassword'])) {
        $errorMsg.= "New password is required.<br>";
        $success = false;
    } else {
        if(strlen($_POST['newPassword'])<8) {
            $pwdErr= "\n* Please enter the password with at least 8 characters";
            $success = false;

        }

        else {
            $new_pw = $_POST['newPassword'];
        }
    }

     //New confirm password
     if(empty($_POST['confirmPassword'])) {
        $errorMsg.= "Confirm password is required.<br>";
        $success = false;
    } else {
        if (($_POST["newPassword"]) != ($_POST["confirmPassword"])) {
            $cfmPwdErr = "\n* Your passwords do not match";
            $success = false;


		} else {
			$cfmPwd = $_POST["confirmPassword"];
    }
}
}
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return($data);
    }
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
                      echo "<h1>Unable to Update Password</h1>";
                      echo "Reason: " . $errorMsg;
                      echo "<div class='error-actions'>
                      </div>";
                      } 
                    ?>
        </main>
    </body>
</html>