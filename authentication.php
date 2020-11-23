 <?php
session_start();
// session_regenerate_id();
include 'dbFunctions.php';

function check_fullname($input) {  //using regular expression to check string, only can use characters and space with min 1 - max 50
    if (!preg_match("/^[a-zA-Z ]{1,50}+$/", $input)) {
        return false;
    } else {
        return true;
    }
}

function check_password($input) {
    if (preg_match("/^[a-zA-Z0-9@*#_ ]{8,255}+$/", $input)) {
        return true;
    } else {
        return false;
    }
}

function check_NRIC($input) {
    if (!preg_match("/^[STFG]\d{7}[A-Z]$/", $input)) {
        return false;
    } else {
        return true;
    }
}

function check_email($input) {
    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $input)) {
        return false;
    } else {
        return true;
    }
}
// function authenticate($nric, $enteredpassword) {
//    $link = db();
//    if(empty($nric) || empty($enteredpassword)){
//        die("Username or password is empty!");
//    }
//    $passwordquery = $link->prepare("SELECT PatPassword FROM Patient WHERE PatNRIC='$nric'");
//    $passwordquery->execute();
//    $passwordquery->bind_result($encryptedpassword);
//    if($passwordquery->fetch());
//    if(password_verify($enteredpassword, $encryptedpassword)){
//        $passwordquery->close();
//        $sql = $link->prepare("SELECT PatNRIC, PatFirstName, PatLastName, PatEmail FROM Patient WHERE PatNRIC='$nric'");
//        $sql->execute();
//        $sql->bind_result($nric,$fname,$lname,$email);
//        if($sql->fetch()){
//            $_SESSION['nric'] = $nric;
//            $_SESSION['firstname'] = $fname;
//            $_SESSION['lastname'] = $lname;
//            $_SESSION['email'] = $email;
//            echo "Login Successful";
//        } else {
//            echo 'Invalid user or wrong password';
//        } 
//     } else {
//            echo 'Invalid user or wrong password';
//        }

//    }



// // username and password grab from form by post operation
// if (isset($_POST['NRIC'])) {
//     if (check_NRIC($_POST['NRIC'])) {
//         $NRIC = $_POST["NRIC"];
//         if (isset($_POST[password])) {
//             if (check_password($_POST['password'])) {
//                 $password = $_POST["password"];
//                 authenticate($NRIC, $password);
//             }
//         }
//     }
// }
?> 