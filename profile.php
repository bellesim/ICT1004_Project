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
            $email = $fname = $lname = $email = $pwd_hashed = $mobile = $height = $weight = $allergies = $errorMsg="";
            $success = true;

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

            showProfile();
            ?>
            <div class="profileContainer mt-16  ml-24 ">
                <h2 id="myAccount" class="text-black text-4xl font-bold  mb-4">Your Account</h2>   
                <h1 class="uk-heading-divider"></h1>
                <div class="detailsContainer m-0 h-full">
                    <div class="uk-width-1-2\@m">
                        <h3 class="uk-card-title font-bold">Account Details</h3><br>
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-1-1">
                                <p>What's your first name?</p>
                                <input class="uk-input" type="text" value="<?php echo $fname ?>" readonly>    
                            </div>
                            <div class="uk-width-1-1">
                                <p>What's your last name?</p>
                                <input class="uk-input" type="text" value="<?php echo $lname ?>" readonly>
                            </div>
                            <div class="uk-width-1-1">
                                <p>Email</p>
                                <input class="uk-input" type="text" value="<?php echo $email ?>"readonly>
                            </div>
                            <div class="uk-width-1-1">
                                <p>Mobile</p>
                                <input class="uk-input" type="text" value="<?php echo $mobile ?>"readonly>
                            </div>
                            <div class="uk-width-1-4\@s">
                                <p>Height</p>
                                <input class="uk-input" type="text" value="<?php echo $height ?>"readonly>       
                            </div>
                            <div class="uk-width-1-4\@s">
                                <p>Weight</p>
                                <input class="uk-input" type="text" value="<?php echo $weight ?>"readonly>    
                            </div>
                            <div class="uk-width-1-4\@s">
                                <p>Allergies</p>
                                <input class="uk-input" type="text" value="<?php echo $allergies ?>" readonly>  
                            </div>
                        </div><br>
                        <form action="profile_edit.php">
                            <button class="uk-button" type="submit">Edit Profile</button>
                        </form>
                        <form action="changePassword.php">
                            <button class="uk-button" type="submit">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php include "footer.inc.php";  ?>
            
        </body>
    </html>
    <?php
    
    }else{
        // show 404 error page
        include "404error.php";  
    }
?>
