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
            include "dbFunctions.php";
            $success = true;

            function retrieveApptFromDB() {
                global $errorMsg, $success, $patid, $apptid, $date;

                $conn = db();
                
                // Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
                    $stmt = $conn->prepare("
                    SELECT ApptID, ApptSubmitTime, ApptDate, ApptStartTime, ApptDuration, ApptType, DocName, DocSpecialisation, ClinicName, ClinicAddress, ClinicPostalCode
                    FROM clinic.Appointment, clinic.Doctor, clinic.Clinic, clinic.Patient
                    WHERE Appointment.DocID = Doctor.DocID AND Appointment.ClinicID = Clinic.ClinicID AND Appointment.PatID = Patient.PatID AND PatNRIC = ?");
                    
                    // Bind & execute the query statement:
                    $stmt->bind_param("s", $_SESSION["NRIC"]);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // output data of each row
                        ?>
                        <p style="margin-top: 100px;"></p>
                        <table class='uk-table uk-table-striped uk-table-hover uk-table-small uk-table-responsive'>
                            <thead>
                                <tr class="uk-table-middle font-bold">
                                    <th>Appointment booked at:</th><th>Date:</th>
                                    <th>Time</th>
                                    <th>Duration</th>
                                    <th>Appointment type</th> 
                                    <th>Doctor Name</th>
                                    <th>Clinic name</th>
                                    <th>Clinic address</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>                   
                            </thead>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr> <td> <?php echo $row["ApptSubmitTime"]; ?> </td>
                                    <td> <?php echo $row["ApptDate"]; ?> </td>
                                    <td> <?php echo $row["ApptStartTime"]; ?> </td>
                                    <td> <?php echo $row["ApptDuration"]; ?> mins </td>
                                    <td> <?php echo $row["ApptType"]; ?> </td>
                                    <td> <?php echo $row["DocName"]; ?> </td>
                                    <td> <?php echo $row["ClinicName"]; ?> </td>
                                    <td> <?php echo $row["ClinicAddress"]; ?>, Singapore <?php echo $row["ClinicPostalCode"]; ?> </td>
                                    <td>
                                        <form action="appt_edit.php" method="POST">
                                            <input type="hidden" id="apptid" name="apptid" value=" <?php echo $row["ApptID"]; ?> " readonly>
                                            <button class="uk-button uk-button-primary uk-button-medium uk-width-2-3 uk-width-auto@s rounded ml-24" type="submit">Edit</button>

                                        </form>
                                    </td>   
                                    <td>

                                        <!-- display username and logout button -->
                                        <div class="flex flex-row-reverse">
                                            <div><button class="uk-button uk-button-medium uk-width-2-3 uk-width-auto@s rounded ml-24 text-red-100 transition-colors duration-150 bg-red-700" type="submit" uk-toggle="target: #modal-deleteappt" >Delete</button></div>

                                        </div>

                                        <!-- show popup model if user click logout button -->
                                        <div id="modal-deleteappt" uk-modal>
                                            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                                                <button class="uk-modal-close-default" type="button" uk-close></button>
                                                <br><br><h1 class="text-black text-center">Are you sure you want to Delete?</h1><br><br><br>
                                                <div style="margin:auto;">
                                                    <form action="delete_appt_process.php" method="POST">
                                                        <input type="hidden" id="apptid" name="apptid" value=" <?php echo $row["ApptID"]; ?> " readonly>
                                                        <button class="button mr-6" type="submit" style="float:left;">Yes</button>
                                                    </form>
                                                    <button class="uk-modal-close button" type="button" style="float:right;">Cancel</button>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "You do not have any appointments yet!";
                        }
                        echo "</table>";

                        $stmt->close();
                    }

                    $conn->close();
                }
                ?>

                <main class="container">
                    <hr>

                    <?php
                    
                    if ($success) {
                        retrieveApptFromDB();
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
