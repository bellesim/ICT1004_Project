<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/main.css">
        <title>Home</title>
        <?php include "nav.inc.php"; ?>
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    </head>
    
    <header>
        
    </header>
        
    <body>
        
    <?php
    
    function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $NRIC = "S1234567A";
    
    $ClinicID = 1;
    
    if(isset($_POST['submit'])) {
        global $PatID, $ApptSubmitTime, $ApptDate, $ApptStartTime, $ApptDuration, $errorMsg, $DocID, $ClinicID, $success, $NRIC;
        $success = true;
        if (empty($_POST["ApptDate"]))
            {
                $errorMsg .= "You must choose a date for your appointment.<br>";
                $success = false;
            }
            
        if (empty($_POST["ApptStartTime"]))
            {
                $errorMsg .= "You must choose a time for your appointment.<br>";
                $success = false;
            }
            
        else{
            $ApptStartTime = $_POST['ApptStartTime'];
            $ApptStartTime = sanitize_input($ApptStartTime);
            if (strlen($ApptStartTime == 4)){
                $errorMsg .= "Error with time chosen.<br>";
                $success = false;
            }
        }
            
        if (empty($_POST["ApptType"]))
            {
                $ApptType = "General"; //Default if the patient does not know what appointment they need
            }else{
                $ApptType = $_POST['ApptType'];
                $ApptType = sanitize_input($ApptType);
                $ApptType = '"'.$ApptType.'"';
                
            }
            
        if (empty($_POST["DocID"]))
            {
                $errorMsg .= "You must choose a doctor for your appointment.<br>";
                $success = false;
            }
        
        $currentdatetime = new DateTime();
        $currentdatetime = $currentdatetime->setTimezone(new DateTimeZone('Asia/Singapore'));
        $currentdatetime = $currentdatetime->format('yy-m-d h:m:s');
        
        
        // Create database connection.
        
        if ($success){
            $config = parse_ini_file('../../private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'],$config['password'], $config['dbname']);
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {
                $currentdatetime = $currentdatetime;
                $ApptDate = $_POST['ApptDate'];
                $DocID = $_POST['DocID'];
                $ClinicID = 1;
                $ApptStartTime = str_replace(':', '', $ApptStartTime);
                
                $stmt = $conn->prepare("
                    SELECT * FROM `clinic`.`Patient` WHERE `PatNRIC` = ?;");
                // Bind & execute the query statement:
                $stmt->bind_param("s", $NRIC);
                if (!$stmt->execute()){
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $success = false;
                };
                $result = $stmt->get_result();
                $row = $result->fetch_assoc(); 
                if ($result->num_rows > 0) {
                    $PatID = $row["PatID"];
                }
                else{
                    $errorMsg = "Your patient ID was not found, please contact your administrator";
                }
                $stmt->close();
                

                $stmt = $conn->prepare("
                    SELECT * FROM `clinic`.`Appointment` 
                    WHERE `ApptDate` = ? AND `ApptStartTime` = ? AND `PatID` = ? AND `DocID` = ? AND `ClinicID` = ? ;");
                // Bind & execute the query statement:
                $stmt->bind_param("ssiii", $ApptDate, $ApptStartTime, $PatID, $DocID, $ClinicID);
                if (!$stmt->execute()){
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $success = false;
                };
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $stmt->close();
                    $success = false;
                    echo "Sorry, there is already an appointment booked at this timeslot, please choose a different timeslot";
                    //Do not insert 2 appointments with the same details
                } else{ //If no other appointments with the same details are found, INSERT to the database
                $stmt->close();

                $stmt = $conn->prepare("
                    INSERT INTO `clinic`.`Appointment` (`ApptSubmitTime`, `ApptDate`, `ApptStartTime`, `ApptDuration`, `PatID`, `DocID`, `ClinicID`) 
                    VALUES (?, ?, ?, 60, ?, ?, ?);");

                $stmt->bind_param("sssiii", $currentdatetime, $ApptDate, $ApptStartTime, $PatID, $DocID, $ClinicID);
                if (!$stmt->execute()){
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    echo $errorMsg;
                    $success = false;
                };


                $stmt->close();

                }
            }

            $conn->close();
        }
        else{
            echo $errorMsg;
        }
    }
    

        ?>
        <div class="container">
            <p>Enter your contents here for BOOKING, display appointment details etc ! :) </p>
        </div>            
            
        
        
<?php include "footer.inc.php";  ?>

    </body>
</html>
