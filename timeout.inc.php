<?php
if (isset($_SESSION["last_activity"]) && isset($_SESSION["inactive_timeout"])){
    // if session expired, prompt user to login again
    if($_SESSION["last_activity"] < time()-$_SESSION["inactive_timeout"]) {
        echo '<script>';
        echo 'alert("You are being timed out due to inactivity and will be logged off automatically. Please login again.")';
        echo '</script>';
    } else { // if haven't expire, update the time for last activity
        $_SESSION["last_activity"] = time();
    }
}
?>