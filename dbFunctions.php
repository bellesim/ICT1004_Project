<?php
function db() {
//     $config = parse_ini_file('../../private/db-config.ini');
//     $link = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
//     if($link->connect_error){
//         $errorMsg = "Connection failed:" .$link->connect_error;
//         $success = false;
//     }
//     // $link->close();
//     return $link;
// } 

$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = 'woshibeier';
$DB = "clinic";
static $link;
if ($link === NULL) {
    $link = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB);
    if (!$link) {
        die(mysqli_connect_error());
    }
}
return $link;
}

?>