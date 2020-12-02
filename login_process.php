<!DOCTYPE html>
<html>
<?php
    session_start();
?>

<head>
    <?php
        include "head.inc.php";
    ?>
</head>

<body>
    <?php
        include "nav.inc.php";
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

        echo "<main class=\"container\" style=\"margin-top:40px;\">";
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
                <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                    <h2 class="font-bold text-2xl text-purple-800">Failed to login!</h2>
                    <p class="font-bold">The following input errors were detected:</p>
                    <?php echo "<p>&#10008;  ".$errorMsg."</p>";?>
                    <p class="mt-8">Please try again.</p>
                    <button class="loginformbutton font-semibold"><a href="login.php">Back to Login</a></button>
                </div>

                <?php
                }
        } else {
            if(!$validate_nric_fin){
                ?>
                <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                    <h1 class="font-bold text-2xl text-purple-800">Failed to login!</h1>
                    <p class="font-bold">The following input errors were detected:</p>
                    <p>&#10008;  Invalid NRIC/FIN format.</p>
                    <p class="mt-16 mb-8">Please try again.</p>
                    <button class="loginformbutton font-semibold"><a href="login.php">Back to Login</a></button>
                </div>    
                <?php
            }
        }
        
            
        include "footer.inc.php";
    ?>
</body>
</html>