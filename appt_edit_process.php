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
            <?php 
            include "nav.inc.php";
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
                    $errorMsg .= "&#10008;  The appointment time is not valid. <br>";
                    $success = false;
                }else{
                    $new_appt_time = $_POST["new_appt_time"];
                }
                
            }
            if (empty($_POST["new_appt_date"])) {
                $errorMsg .= "&#10008;  Please select an appointment date.<br>";
                $success = false;
            } else {
                if(!check_appt_date($_POST["new_appt_date"])){
                    $errorMsg .= "&#10008;  The appointment date is not valid. <br>";
                    $success = false;
                }else{
                    $new_appt_date = $_POST["new_appt_date"];
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
            <main class="container">
                <hr>
                    <?php
                    if ($success) {
                        retrieveDateChecker();
                        if($dbsuccess){
                            ?>
                            <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                                <h1 class="font-bold text-2xl text-purple-800">Appointment Updated!</h1>
                                <p>Your appointment is updated successfully.</p>
                                <button class="loginformbutton font-semibold"><a href="appt.php">Back to My Appointment</a></button>
                            </div>    
                            <?php
                        }else{
                            ?>
                            <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                                <h2 class="font-bold text-2xl text-purple-800">Failed to Update Appointment!</h2>
                                <p class="font-bold">Reason(s):</p>
                                <?php echo "<p>".$errorMsg."</p>";?>
                                <p class="mt-8">Please try again.</p>
                                <button class="loginformbutton font-semibold"><a href="appt.php">Back to My Appointment</a></button>
                            </div>
                            <?php
                        }
                    }else{
                    ?>
                    <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                        <h2 class="font-bold text-2xl text-purple-800">Failed to Update Appointment!</h2>
                        <p class="font-bold">Reason(s):</p>
                        <?php echo "<p>".$errorMsg."</p>";?>
                        <p class="mt-8">Please try again.</p>
                        <button class="loginformbutton font-semibold"><a href="appt.php">Back to My Appointment</a></button>
                    </div>
                    <?php

                    }
                    ?>


            </main>

            <?php include "footer.inc.php";  ?>
        </body>
    </html>
    <?php
    
    }else{
        // show 404 error page
        include "404error.php";  
    }
?>