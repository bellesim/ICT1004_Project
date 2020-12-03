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
            include "dbFunctions.php";
            $success = true;

            function retrieveApptFromDB() {
                global $errorMsg, $success, $apptid;
                $apptid = $_POST['apptid'];
                $patNRIC = $_SESSION["NRIC"];
                
                $conn = db();
                // Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
                   $stmt = $conn->prepare("
                        SELECT ApptDate, ApptStartTime, ApptType, DocName, ClinicName, ClinicAddress, Appointment.ClinicID
                        FROM clinic.Appointment, clinic.Doctor, clinic.Clinic
                        WHERE Appointment.DocID = Doctor.DocID AND Appointment.ClinicID = Clinic.ClinicID AND ApptID = ?");

                    // Bind & execute the query statement:
                    $stmt->bind_param("i", $apptid);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {

                            $now = new DateTime();
                            $date_created = $now->format('Y-m-d');
                            $date1 = date_create($date_created);
                            $date2 = date_create($row["ApptDate"]);
                            $diff = date_diff($date1, $date2);
                            $dateThree=date_create();
                            date_modify($dateThree,"+3 days");

                            if (($diff->format("%R%a")) > 3) {
                                ?>
                                <div class="uk-flex uk-flex-center uk-flex-middle uk-height-viewport uk-position-z-index uk-position-relative">
                                <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m mr-6">
                                <h2 class="text-2xl font-semibold">Edit Appointment</h2>
                                <p class="uk-heading-divider"></p>
                                <form action="appt_edit_process.php" method="POST">

                                        <div class="uk-width-1-1 mt-8 mb-8">
                                            <label class="uk-form-label text-blue-800 font-semibold" for="appt_type">Appointment Type: <?php echo $row["ApptType"]; ?></label>
                                        </div>

                                        <div class="uk-width-1-1 mb-8">
                                            <label class="uk-form-label text-blue-800 font-semibold" for="doc_name">Doctor Name: <?php echo $row["DocName"]; ?> </label>
                                        </div>

                                        <div class="uk-width-1-1 mb-8">
                                            <label class="uk-form-label text-blue-800 font-semibold" for="clinic_name">Clinic Name: <?php echo $row["ClinicName"]; ?> </label>     
                                        </div>

                                        <div class="uk-width-1-1 mb-8">
                                            <label class="uk-form-label text-blue-800 font-semibold" for="old_appt_date">Old Appointment Date: <?php echo $row["ApptDate"]; ?> </label>     
                                        </div>

                                        <div class="uk-width-1-1 mb-8">
                                            <label class="uk-form-label text-blue-800 font-semibold" for="old_appt_time">Old Appointment Time: <?php echo $row["ApptStartTime"]; ?> </label>     
                                        </div>

                                        <div class="uk-width-1-1 mb-8">
                                            <label class="uk-form-label text-blue-800 font-semibold" for="new_appt_date">Choose a new Date: </label>
                                            <input class="uk-input rounded w-64 bg-gray-100" type="date" id="new_appt_date"
                                                   name="new_appt_date" min="<?PHP echo date_format($dateThree,"Y-m-d");?>" pattern="\d{1,2}/\d{1,2}/\d{4}" required>
                                        </div> 


                                        <div class="uk-width-1-1 mb-8">
                                            <label class="uk-form-label text-blue-800 font-semibold" for="new_appt_time">Choose a new Time: </label>
                                            <select id="new_appt_time" name="new_appt_time" class="uk-select rounded w-64 bg-gray-100" required>
                                                <option value="0800">0800-0900</option>
                                                <option value="0900">0900-1000</option>
                                                <option value="1000">1000-1100</option>
                                                <option value="1100">1100-1200</option>
                                                <option value="1200">1200-1300</option>
                                                <option value="1300">1300-1400</option>
                                                <option value="1400">1400-1500</option>
                                                <option value="1500">1500-1600</option>
                                                <option value="1600">1600-1700</option>
                                                <option value="1700">1700-1800</option>
                                            </select>
                                        </div>
                                        <input type="hidden" id="apptid" name="apptid" value=" <?php echo $apptid; ?> " readonly><br>
                                        <input type="hidden" id="clinicid" name="clinicid" value=" <?php echo $row["ClinicID"]; ?> " readonly><br>
                                        <div class="mb-8 flex">
                                            <button class="uk-button uk-button-primary uk-width-1-3 m-0 rounded h-12 bg-blue-800" type="submit">Update</button>
                                            <a href="appt.php" class="uk-button uk-button-primary uk-width-1-3 m-0 rounded h-12 bg-blue-800">Back</a></div>
                                        </div>


                                </form>

                                    </div>

                                </div>
                                <?php
                            } else {
                                ?>   
                            <div class="uk-flex uk-flex-center uk-flex-middle uk-height-viewport uk-position-z-index uk-position-relative">
                                <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m mr-6">
                                <h2 class="text-2xl font-semibold">View Appointment</h2>
                                <p class="uk-heading-divider"></p>
                            <form action="appt.php" method="POST">

                                    <div class="uk-width-1-1 mt-8 mb-8">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="apptid">Appointment ID: <?php echo $apptid; ?> </label>
                                    </div>

                                    <div class="uk-width-1-1 mb-8">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="appt_type">Appointment Type: <?php echo $row["ApptType"]; ?></label>
                                    </div>
                                    <div class="uk-width-1-1 mb-8">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="doc_name">Doctor Name: <?php echo $row["DocName"]; ?> </label>
                                    </div>
                                    <div class="uk-width-1-1 mb-8">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="clinic_name">Clinic Name: <?php echo $row["ClinicName"]; ?> </label>     
                                    </div>

                                    <div class="uk-width-1-1 mb-8">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="old_appt_date">Old Appointment Date: <?php echo $row["ApptDate"]; ?> </label>     
                                    </div>

                                    <div class="uk-width-1-1 mb-8">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="old_appt_time">Old Appointment Time: <?php echo $row["ApptStartTime"]; ?> </label>     
                                    </div>

                                    <div class="uk-card uk-card-default uk-card-body">
                                        <button class="uk-button uk-button-primary uk-width-1-1 m-0 rounded h-12 bg-blue-800" type="submit">Back</button>
                                    </div>

                                
                            </form>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                    }
                }

                $stmt->close();
            }

            $conn->close();
        }
        ?>



        


        <?php
        retrieveApptFromDB();
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
