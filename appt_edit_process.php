<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
    ?>
    <html>
        <head>
            <?php include "head.inc.php"; ?>
        </head>
        <body>
            <div class="top-wrap uk-position-relative pb-20"> 
                <?php include "nav.inc.php";?>
            </div>	
            <?php 
            include "timeout.inc.php";
            include "authentication.php";
            include "dbFunctions.php";
            $success = $dbsuccess = true;

            $apptid = $_POST["apptid"];
            $clinicid = $_POST["clinicid"];

            if (empty($_POST["new_appt_time"])) {
                $errorMsg .= "&#10008;  Please select an appointment time. <br>";
                $success = false;
            } else {
                if(!check_appt_time($_POST["new_appt_time"])){
                    $errorMsg .= "&#10008;  Invalid appointment time. <br>";
                    $success = false;
                }else{
                    $new_appt_time = sanitize_input($_POST["new_appt_time"]);
                }
                
            }
            if (empty($_POST["new_appt_date"])) {
                $errorMsg .= "&#10008;  Please select an appointment date.<br>";
                $success = false;
            } else {
                if(!check_appt_date($_POST["new_appt_date"])){
                    $errorMsg .= "&#10008;  Invalid appointment date. <br>";
                    $success = false;
                }else{
                    $new_appt_date = sanitize_input($_POST["new_appt_date"]);
                }
            }

            function retrieveDateChecker() {
                global $errorMsg, $dbsuccess, $apptid, $new_appt_date, $new_appt_time, $clinicid;

                $conn = db();
                
                // Check connection
                if ($conn->connect_error) {
                    $errorMsg .= "&#10008;  Connection failed: " . $conn->connect_error;
                    $dbsuccess = false;
                } else {
                    $stmt = $conn->prepare("SELECT * FROM clinic.Appointment WHERE ApptDate = ? and ApptStartTime = ? and ClinicID = ?");

                    // Bind & execute the query statement:
                    $stmt->bind_param("sss", $new_appt_date, $new_appt_time, $clinicid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    // if timeslot NOT available
                    if ($result->num_rows > 0) {
                        $errorMsg .= "&#10008;  Sorry the timeslot is unavailable. Please choose another date and time.";
                        $dbsuccess = false;
                        
                    // if timeslot available
                    } else {
                        // Prepare the statement:
                        $datestmt = $conn->prepare("UPDATE clinic.Appointment SET ApptDate = ?,ApptStartTime = ? WHERE ApptID = ?");
                        // Bind & execute the query statement:
                        $datestmt->bind_param("sss", $new_appt_date, $new_appt_time, $apptid);
                        $datestmt->execute();
                        if (!$datestmt->execute()) {
                            $errorMsg .= "&#10008;  Execute failed: (" . $datestmt->errno . ") " . $datestmt->error."<br>";
                            $dbsuccess = false;
                        }
                        
                        $datestmt->close();
                    }


                    $stmt->close();
                }

                $conn->close();
            }
            ?>


                    <?php
                    if ($success) {
                        retrieveDateChecker();
                        if($dbsuccess){
                            ?> 
                            <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                                <div class="space-y-6 text-center">
                                    <h3 class="uk-card-title font-bold" style="color:#1e40af;">Appointment Updated!</h3>
                                    <p>Your appointment is updated successfully.</p>
                                    <button class="uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="appt.php">Back to Appointments</a></button>
                                </div>
                            </div> 
                            <?php
                        }else{
                            ?>
                            <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                                <div class="space-y-6">
                                    <h3 class="uk-card-title font-bold" style="color:#B22222;">Failed to Update Appointment!</h3>
                                    <p class="font-bold">Reason(s):</p>
                                    <p><?php echo $errorMsg;?></p>
                                    <p class="mt-16 mb-8">Please try again.</p>
                                    <button class="uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="appt.php">Back to Appointments</a></button>
                                </div>
                            </div> 
                            <?php
                        }
                    }else{
                    ?>
                        <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
                            <div class="space-y-6">
                                <h3 class="uk-card-title font-bold" style="color:#B22222;">Failed to Update Appointment!</h3>
                                <p class="font-bold">Reason(s):</p>
                                <p><?php echo $errorMsg;?></p>
                                <p class="mt-16 mb-8">Please try again.</p>
                                <button class="uk-button uk-button-primary uk-align-center rounded h-12 bg-blue-800 "><a href="appt.php">Back to Appointments</a></button>
                            </div>
                        </div> 
                    <?php

                    }
                    ?>

            <?php include "footer.inc.php";  ?>
        </body>
    </html>
    <?php
    
    }else{
        // show 404 error page
        include "404error.php";  
    }
?>