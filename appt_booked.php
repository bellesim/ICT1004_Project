<!DOCTYPE html>
<?php 
session_start();
?>
<html lang="en">
    <head>
        <title>Clinic Finder</title>
        <?php include "head.inc.php"; ?>
    </head>
    <body>
        <div class="top-wrap uk-position-relative pb-20"> 
            <?php include "nav.inc.php";?>
        </div>	
        <main>
<?php
    if (isset($_SESSION["NRIC"]) && isset($_SESSION["username"]) && (!empty($_POST["ClinicID"]))){
        include "dbFunctions.php";
        include "authentication.php";

        $ClinicID = sanitize_input($_POST["ClinicID"]);

        // check whether the clinic ID is valid and get the clinic name
        $conn = db();
        $stmt = $conn->prepare("
            SELECT ClinicName FROM clinic.Clinic WHERE ClinicID = ?");
        $stmt->bind_param("i", $ClinicID);
        $stmt->execute();
        $result = $stmt->get_result();
        // if clinic id is valid, process booking and display result
        if ($result->num_rows > 0) {
            $stmt->close();
            ?>

                    <?php 
                    include "timeout.inc.php";

                    $success = $dbsuccess = true;
                    $NRIC = $_SESSION["NRIC"];
                    $currentdatetime = new DateTime();
                    $currentdatetime = $currentdatetime->setTimezone(new DateTimeZone('Asia/Singapore'));
                    $currentdatetime = $currentdatetime->format('yy-m-d h:m:s');

                    function insertApptToDB() {
                        global $PatID, $NRIC, $ApptSubmitTime, $currentdatetime, $ApptDate, $ApptStartTime, $ApptDuration, $errorMsg, $DocID, $ClinicID, $dbsuccess;

                        $conn = db();
                        // Check connection
                        if ($conn->connect_error) {
                            $errorMsg .= "&#10008;  Connection failed: " . $conn->connect_error;
                            $dbsuccess = false;
                        } else {
                            $stmt = $conn->prepare("
                                SELECT * FROM `clinic`.`Patient` WHERE `PatNRIC` = ?;");
                            // Bind & execute the query statement:
                            $stmt->bind_param("s", $NRIC);
                            if (!$stmt->execute()){
                                $errorMsg .= "&#10008;  Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                                $dbsuccess = false;
                            }
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc(); 
                            if ($result->num_rows > 0) {
                                $PatID = $row["PatID"];
                            }
                            else{
                                $errorMsg .= "&#10008;  Your patient ID was not found, please contact your administrator.";
                                $dbsuccess = false;
                            }
                            $stmt->close();


                            $stmt = $conn->prepare("
                                SELECT * FROM `clinic`.`Appointment` 
                                WHERE `ApptDate` = ? AND `ApptStartTime` = ? AND `PatID` = ? AND `DocID` = ? AND `ClinicID` = ? ;");
                            // Bind & execute the query statement:
                            $stmt->bind_param("ssiii", $ApptDate, $ApptStartTime, $PatID, $DocID, $ClinicID);
                            if (!$stmt->execute()){
                                $errorMsg .= "&#10008;  Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                                $dbsuccess = false;
                            }
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $stmt->close();
                                $errorMsg .= "&#10008;  Sorry, there is already an appointment booked at this timeslot, please choose a different timeslot";
                                $dbsuccess = false;
                                //Do not insert 2 appointments with the same details
                            } else{ //If no other appointments with the same details are found, INSERT to the database
                                $stmt->close();

                                $stmt = $conn->prepare("
                                    INSERT INTO `clinic`.`Appointment` (`ApptSubmitTime`, `ApptDate`, `ApptStartTime`, `ApptDuration`, `PatID`, `DocID`, `ClinicID`) 
                                    VALUES (?, ?, ?, 60, ?, ?, ?);");

                                $stmt->bind_param("sssiii", $currentdatetime, $ApptDate, $ApptStartTime, $PatID, $DocID, $ClinicID);
                                if (!$stmt->execute()){
                                    $errorMsg .= "&#10008;  Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                                    $dbsuccess = false;
                                }
                                $stmt->close();
                            }
                        }
                        $conn->close();
                    }

                    if(isset($_POST['submit'])) {

                        if (empty($_POST["ApptDate"])){
                            $errorMsg .= "&#10008;  You must choose a date for your appointment.<br>";
                            $success = false;
                        }else{
                            if(!check_appt_date($_POST["ApptDate"])){
                                $errorMsg .= "&#10008;  Invalid appointment date.<br>";
                                $success = false;
                            }else{
                                $ApptDate = sanitize_input($_POST["ApptDate"]);
                            }
                        }

                        if (empty($_POST["ApptStartTime"])){
                            $errorMsg .= "&#10008;  You must choose a time for your appointment.<br>";
                            $success = false;
                        }else{
                            if(!check_appt_time($_POST["ApptStartTime"])){
                                $errorMsg .= "&#10008;  Invalid appointment time.<br>";
                                $success = false;
                            }else{
                                $ApptStartTime = sanitize_input($_POST["ApptStartTime"]);
                            }
                        }

                        if (empty($_POST["ApptType"]) && (!check_allergies($_POST["ApptType"]))){
                            $ApptType = "General"; //Default if the patient does not know what appointment they need
                        }else{
                            $ApptType = sanitize_input($_POST["ApptType"]);
                        }
                        if (empty($_POST["DocID"])){
                            $errorMsg .= "&#10008;  You must choose a doctor for your appointment.<br>";
                            $success = false;
                        }else{
                            $DocID = sanitize_input($_POST["DocID"]);
                        }

                    }else{
                        $success = false;
                    }


                    if ($success){
                        insertApptToDB();
                        if($dbsuccess){
                            ?>
                            <div class="h-screen">
                            <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                                <div class="space-y-6 text-center text-black">
                                    <h1 class="uk-card-title font-bold" style="color:#1e40af;">Appointment Booked!</h1>
                                    <p>Your appointment is booked successfully.</p>
                                    <p>You may go to My Appointment page to view the appointment details.</p>
                                    <p class="uk-button uk-width-1-3 uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="appt.php">Go to Appointments</a></p>
                                </div>
                            </div> 
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="h-screen">
                            <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                                <div class="space-y-6 text-black">
                                    <h1 class="uk-card-title font-bold" style="color:#B22222;">Failed to Book Appointment!</h1>
                                    <p class="font-bold">Reason(s):</p>
                                    <p><?php echo $errorMsg;?></p>
                                    <p class="mt-16 mb-8">Please try again.</p>
                                    <p class="uk-button uk-width-1-3 uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="clinic.php">Back to Clinic</a></p>
                                </div>
                            </div>  
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                    <div class="h-screen">
                        <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                            <div class="space-y-6 text-black">
                                <h1 class="uk-card-title font-bold" style="color:#B22222;">Failed to Book Appointment!</h1>
                                <p class="font-bold">Reason(s):</p>
                                <p><?php echo $errorMsg;?></p>
                                <p class="mt-16 mb-8">Please try again.</p>
                                <p class="uk-button uk-width-1-3 uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="clinic.php">Back to Clinic</a></p>
                            </div>
                        </div>  
                    </div>
                        <?php
                    }
                ?>    

            <?php
        }else{
            // show 404 error page
            include "404error.php";  
        }
    }else{
        // show 404 error page
        include "404error.php";  
    }
?>
        </main>
<?php include "footer.inc.php";  ?>
    </body>
</html>