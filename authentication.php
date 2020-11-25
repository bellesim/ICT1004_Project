 <?php
include 'dbFunctions.php';

// checks input for malicious or unwanted content
function sanitize_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// validate name 
// condition: do not contain space only (e.g. "     ")
//          : must be alphabet (no numbers/special characters are allowed)  
//          : min 1 - max 50
function check_fullname($input) {
    if ((strlen(str_replace(' ', '', $input)) == 0) || (!preg_match("/^[a-zA-Z ]{1,50}+$/", $input))) {
        return false;
    } else {
        return true;
    }
}

// validate password
// condition: MUST NOT contain space
//          : contain at least 8 characters, including 1 uppercase, 1 lowercase, 1 number and 1 special character
//          : max characters = 255        
function check_password($input) {
    if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,255}$/", $input)) {
        return true;
    } else {
        return false;
    }
}

// validate NRIC/FIN
// condition: is in correct format start with S/T/F/G, follow by 7 digits and end with an alphabet
function check_NRIC($input) {
    if (!preg_match("/^[STFG]\d{7}[A-Z]$/", $input)) {
        return false;
    } else {
        return true;
    }
}

// validate email with filter_var function (to double confirm)
function check_email($input) {
    if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}

// validate contact number
// condition: 8 digits only and the 1st digit must be 6/8/9
function check_contact($input) {
    if (!preg_match("/^(6|8|9)\d{7}$/",$input)) {
        return false;
    } else {
        return true;
    }
}

// validate weight or height
// condition: do not contain space only (e.g. "     ")
//          : must be integer or double (for double, only 1 decimal point is allowed)
function check_double_format($input) {
    if((strlen(str_replace(' ', '', $input)) == 0)||(!preg_match('/^[0-9]+(\.[0-9]{1})?$/', $input))){
        return false;
    }else{
        return true;
    }
}

// validate allergies
// condition: do not contain space only (e.g. "     ")
function check_allergies($input){
    if(strlen(str_replace(' ', '', $input)) == 0){
        return false;
    } else{
        return true;
    }
}

function authenticate($nric, $enteredpassword) {
   $link = db();
   if(empty($nric) || empty($enteredpassword)){
       die("Username or password is empty!");
   }
   $passwordquery = $link->prepare("SELECT PatPassword FROM Patient WHERE PatNRIC='$nric'");
   $passwordquery->execute();
   $password->bind_result($encryptedpassword);
   if($passwordquery->fetch());
   if(password_verify($enteredpassword, $encryptedpassword)){
       $passwordquery->close();
       $sql = $link->prepare("SELECT PatNRIC, PatFirstName, PatLastName, PatEmail FROM Patient WHERE PatNRIC='$nric'");
       $sql->execute();
       $sql->bind_result($nric,$fname,$lname,$email);
       if($sql->fetch()){
           $_SESSION['nric'] = $nric;
           $_SESSION['firstname'] = $fname;
           $_SESSION['lastname'] = $lname;
           $_SESSION['email'] = $email;
           echo "Login Successful";
       } else {
           echo 'Invalid user or wrong password';
       } 
    } else {
           echo 'Invalid user or wrong password';
       }

   }

   function changePassword($nric, $oldpassword, $newpassword) { 
    $link = db();
    if (empty($newpassword) || empty($oldpassword)) {
        die("passwords are empty!");
    }
    $passwordquery = $link->prepare("SELECT PatPassword from Patient WHERE PatNRIC=?");
    $passwordquery->bind_param("s", $_SESSION['NRIC']);  
    $passwordquery->execute();
    $passwordquery->bind_result($encryptedpassword);
    $passwordquery->fetch();
    $passwordquery->close();
    if (password_verify($oldpassword, $encryptedpassword)) {
        if (check_password($newpassword)) {
            $password = password_hash($newpassword, PASSWORD_BCRYPT);
            $sql = $link->prepare("UPDATE Patient set PatPassword=? WHERE PatNRIC=?");
            $sql->bind_param('ss', $password, $$_SESSION['NRIC']);
            if ($sql->execute()){
                $_SESSION['passwordchange'] = 'Password Successfully Changed';
                header('Location:profile.php'); //route to main page.
            } else {
                $_SESSION['passwordchange'] = 'Password Change Unsuccessful';
            }
        } else {
            echo "invalid new password";
        }
    } else {
        echo "Wrong Old password";
    }
}



// username and password grab from form by post operation
if (isset($_POST['NRIC'])) {
    if (check_NRIC($_POST['NRIC'])) {
        $NRIC = $_POST["NRIC"];
        if (isset($_POST[password])) {
            if (check_password($_POST['password'])) {
                $password = $_POST["password"];
                authenticate($NRIC, $password);
            }
        }
    }
}
?>
