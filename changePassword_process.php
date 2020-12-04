<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
    ?>
    <html lang="en">
        <head>
             <title>Change Password</title>
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
            $oldpwd = $newpwd_hashed = $errorMsg = "";
            $success = $dbsuccess = true;
                       
            
            function updatePassword() {
                global $old_pwd,$newpwd_hashed, $errorMsg, $dbsuccess, $nric, $password;
                $link = db();
                // check connection    
                if ($link->connect_error){        
                    $errorMsg = "Connection failed: " . $conn->connect_error;        
                    $dbsuccess = false;    

                } else {
                    $tempnric=$_SESSION['NRIC'];    
                    $stmt = $link->prepare("SELECT * FROM Patient WHERE PatNRIC=?");  
                    $stmt->bind_param("s",$tempnric);  
                    $stmt->execute();  

                    // get the old password hash from db
                    $result = $stmt->get_result();       
                    if ($result->num_rows > 0){            
                        $row = $result->fetch_assoc();        
                        $nric = $row["PatNRIC"];  
                        $password = $row["PatPassword"];          
                    }   
                    $stmt->close();  

                    //check whether old password match with old password hash in db
                    if(!password_verify($old_pwd, $password)){
                        $errorMsg.= "Old password is incorrect.<br>";
                        $dbsuccess = false;
                    // if match, update new password
                    }else{
                        //Prepared statement
                        $updateProfile = $link->prepare("UPDATE Patient SET PatPassword=? WHERE PatNRIC=?");
                        //bind & execute the query statement:
                        $updateProfile->bind_param("ss", $newpwd_hashed, $nric);
                        $updateProfile->execute();
                        
                        if (!$updateProfile->execute()){
                            $errorMsg = "Execute failed: (" . $updateProfile->errno . ") " . $updateProfile->error . "<br>";
                            $dbsuccess = false;
                        }
                        $updateProfile->close();
                    }
                }
                $link->close();
            }

            if($_SERVER["REQUEST_METHOD"] == "POST") {
                // check whether old password is empty
                if(empty($_POST['oldPassword'])) {
                    $errorMsg.= "Old password is required.<br>";
                    $success = false;
                } else {
                    $old_pwd = $_POST["oldPassword"];
                }

                // check whether new password and new confirm password is empty
                if(empty($_POST['newPassword'])) {
                    $errorMsg.= "New password is required.<br>";
                    $success = false;
                }
                
                if(empty($_POST['confirmPassword'])) {
                    $errorMsg.= "Confirm password is required.<br>";
                    $success = false;  
                // if not empty fields
                } else {
                    // check whether they are identical
                    if (($_POST["newPassword"]) != ($_POST["confirmPassword"])) {
                        $errorMsg.= "Your new passwords do not match. <br>";
                        $success = false;
                    } else {
                        // check whether the new password meet the password requirement
                        if(!check_password($_POST['newPassword'])) {
                            $errorMsg.= "Invalid new password format.<br>";
                            $success = false;
                        } else {
                            $newpwd_hashed = password_hash($_POST['newPassword'],PASSWORD_DEFAULT);
                        }
                    }
                }
            }    

            if ($success) {
                updatePassword();
                if($dbsuccess){
                    ?>
                    <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                        <div class="space-y-6 text-center">
                            <h3 class="uk-card-title font-bold" style="color:#1e40af;">Password Updated!</h3>
                            <p>Your password has been successfully updated!</p>
                            <p class="uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="profile.php">Back to Profile</a></p>
                        </div>
                    </div> 
                    <?php
                } else {
                   ?>
                    <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                        <div class="space-y-6">
                            <h3 class="uk-card-title font-bold" style="color:#B22222;">Unable to Update Password!</h3>
                            <p class="font-bold">Reason(s):</p>
                            <p><?php echo $errorMsg;?></p>
                            <p class="mt-16 mb-8">Please try again.</p>
                            <p class="uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="profile.php">Back to Profile</a></p>
                        </div>
                    </div> 
                    <?php
                }
                
            } else {
                ?>
                <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                    <div class="space-y-6">
                        <h3 class="uk-card-title font-bold" style="color:#B22222;">Unable to Update Password!</h3>
                        <p class="font-bold">Reason(s):</p>
                        <p><?php echo $errorMsg;?></p>
                        <p class="mt-16 mb-8">Please try again.</p>
                        <p class="uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="profile.php">Back to Profile</a></p>
                    </div>
                </div> 
                <?php
            } 
            
            
            include "footer.inc.php";  ?>
        </body>
    </html>
    <?php
    
    }else{
        // show 404 error page
        include "404error.php";  
    }
?>
