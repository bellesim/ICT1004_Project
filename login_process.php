<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
?>

<head>
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
        $lname = $fname = $email = $pwd_hashed = $errorMsg = "";
        $success = $validate_nric_fin = $db_success = true;
        $empty_field = false;
        
        function combineName($first,$last){
            if($first=="NULL"){
                $fullname = $last;
                
            }else{
                $fullname = $first . ' ' . $last;
            }
            return $fullname;
        }
        
        // to authenticate the login
        function authenticateUser(){     
            global $fname, $lname, $nric_fin, $pwd_hashed, $errorMsg, $db_success;    
            
            $conn = db();
            // check connection    
            if ($conn->connect_error){        
                $errorMsg = "Connection failed: " . $conn->connect_error;        
                $db_success = false;    
                
            } else {        
                // Prepare the statement:        
                $stmt = $conn->prepare("SELECT * FROM Patient WHERE PatNRIC=?");            
                $stmt->bind_param("s", $nric_fin);        
                $stmt->execute();        
                $result = $stmt->get_result();        
                if ($result->num_rows > 0){            
                    // Note that email field is unique, so should only have            
                    // one row in the result set.            
                    $row = $result->fetch_assoc();            
                    $fname = $row["PatFirstName"];            
                    $lname = $row["PatLastName"];            
                    $pwd_hashed = $row["PatPassword"];            
                    
                    
                    // Check if the password matches:            
                    if (!password_verify($_POST["pwd"], $pwd_hashed)){                           
                        $errorMsg = "NRIC/FIN not found or password doesn't match.";                
                        $db_success = false;            
                    }       
                    
                } else {            
                    $errorMsg = "NRIC/FIN not found or password doesn't match.";            
                    $db_success = false;         
                }        
                $stmt->close();    
            }    
            $conn->close();
        }

        // if required fields are not empty
        if(((!empty($_POST["nric_fin"]))&&(!empty($_POST["pwd"])))){
            $nric_fin = strtoupper(sanitize_input($_POST["nric_fin"]));
            $validate_nric_fin = check_NRIC($nric_fin);
            if (!$validate_nric_fin){
                $success = false;
            }

        // if any required field is empty
        }else{  
            $empty_field = true;
            $success = false;
        }

        
        if($success){
            authenticateUser();
            if($db_success){
                $username = combineName($fname,$lname);
                $_SESSION["last_activity"] = time();
                $_SESSION['inactive_timeout'] = 1*60*60;  // will logout if user inactive for 1 hour
                $_SESSION["NRIC"] = $nric_fin;
                $_SESSION["username"] = $username;
                header("Location:index.php");
            } else {

                ?>
                <div class="h-screen">
                <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                    <div class="space-y-6 text-black">
                        <h1 class="uk-card-title font-bold" style="color:#B22222;">Failed to login!</h1>
                        <p class="font-bold">Reason(s):</p>
                        <?php echo "<p>&#10008;  ".$errorMsg."</p>";?>
                        <p class="mt-16 mb-8">Please try again.</p>
                        <button class="uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="login.php">Back to Login</a></button>
                    </div>
                </div> 
                </div>
                <?php
                }
        } else {
            if(!$validate_nric_fin){
                ?>
                <div class="h-screen">
                <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                    <div class="space-y-6 text-black">
                        <h1 class="uk-card-title font-bold" style="color:#B22222;">Failed to login!</h1>
                        <p class="font-bold">Reason(s):</p>
                        <p>&#10008;  Invalid NRIC/FIN format.</p>
                        <p class="mt-16 mb-8">Please try again.</p>
                        <button class="uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="login.php">Back to Login</a></button>
                    </div>
                </div>    
                </div>
                <?php
            }
        }?>
        </main>
        
        <?php    
        include "footer.inc.php";
        
    ?>
    
</body>
</html>


