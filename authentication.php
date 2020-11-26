 <?php
include 'dbFunctions.php';

$link = db();

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
