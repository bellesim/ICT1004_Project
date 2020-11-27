<?php

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
function check_double_format($input){
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
    }else{
        return true;
    }
}

function check_appt_time($input){
    if (!preg_match("/^\d{4}$/",$input)) {
        return false;
    } else {
        return true;
    }
}

function check_appt_date($input){
    if (!preg_match("/^([0-9]{4}|[0-9]{2})-([0]?[1-9]|[1][0-2])-([0]?[1-9]|[1|2][0-9]|[3][0|1])$/",$input)) {
        return false;
    } else {
        return true;
    }
}


?>
