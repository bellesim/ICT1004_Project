<?php 
session_start();
include 'dbFunctions.php';
if (!isset($_SESSION['NRIC'])) {
    header("Location: error.php");
}

$email = $fname = $lname = $email = $pwd_hashed = $mobile = $height = $weight = $allergies = $errorMsg="";
$success = true;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    showProfile();
}

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
?>

<html lang="en">
    <head>
        <title> My Profile</title>
    </head>
    <body>
        <main class="container">
                    <?php
                    showProfile();
                      if ($success) {
                      $_SESSION['NRIC'] = $nric;
                      } else {
                      echo "<h1>Error</h1>";
                      echo "Reason: " . $errorMsg;
                    
                      } 
                    ?>

                </div>

            </div>
        </main>

    </body>
</html>