<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
    ?>
    <html>
        <head>
            <?php include "head.inc.php"; ?>
        </head>
        <body>
            <?php 
            include "nav.inc.php"; 
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
                    <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                        <h1 class="font-bold text-2xl text-purple-800">Password Updated!</h1>
                        <p>Your password has been successfully updated!</p>
                        <button class="loginformbutton font-semibold"><a href="profile.php">Back to Profile</a></button>
                    </div>    
                    <?php
                } else {
                   ?>
                    <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                        <h2 class="font-bold text-2xl text-purple-800">Unable to Update Password!</h2>
                        <p class="font-bold">Reason(s):</p>
                        <?php echo "<p>".$errorMsg."</p>";?>
                        <p class="mt-8">Please try again.</p>
                        <button class="loginformbutton font-semibold"><a href="profile.php">Back to Profile</a></button>
                    </div>
                    <?php
                }
                
            } else {
                ?>
                <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                    <h2 class="font-bold text-2xl text-purple-800">Unable to Update Password!</h2>
                    <p class="font-bold">Reason(s):</p>
                    <?php echo "<p>".$errorMsg."</p>";?>
                    <p class="mt-8">Please try again.</p>
                    <button class="loginformbutton font-semibold"><a href="profile.php">Back to Profile</a></button>
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
