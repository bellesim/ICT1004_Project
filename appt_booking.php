<!DOCTYPE html>
<?php
    session_start();
    
    if (isset($_SESSION["NRIC"]) && isset($_SESSION["username"])){
        if(!empty($_POST["ClinicID"])){
            include "dbFunctions.php";
            include "authentication.php";

            global $ClinicName, $patid, $errorMsg, $success ;
            $ClinicID = sanitize_input($_POST["ClinicID"]);

            // check whether the clinic ID is valid and get the clinic name
            $conn = db();
            $stmt = $conn->prepare("
                SELECT ClinicName FROM clinic.Clinic WHERE ClinicID = ?");
            $stmt->bind_param("i", $ClinicID);
            $stmt->execute();
            $result = $stmt->get_result();
            //display appt booking page
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); 
                $ClinicName = $row["ClinicName"]; //Clinic name is found here. Use it as needed
                $stmt->close();
                ?>

                <html>
                    <head>
                        <?php include "head.inc.php"; ?>
                    </head>
                    <body>
                        <?php 
                        include "nav.inc.php"; 
                        include "timeout.inc.php"; 


                        $currentdate = new DateTime();
                        $currentdate = $currentdate->setTimezone(new DateTimeZone('Asia/Singapore'));
                        $interval = new DateInterval('P1D');
                        $currentdate->add($interval);
                        $currentdate = $currentdate->format('yy-m-d');

                        ?>

                        <div class="container">
                            <form action="appt_booked.php" method="post" class="form-control">
                                <p class="italic text-red-700 mb-8">* mandatory fields</p>
                                <p>Clinic: <?php echo $ClinicName;?></p>
                                <div class="form-group">
                                    <label>Appointment Date*</label>
                                    <input type="date" name="ApptDate" class="form-control" min="<?php echo $currentdate;?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="ApptStartTime">Appointment Timeslot*:</label>
                                    <select id="ApptStartTime" name="ApptStartTime" required>
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
                                <div class="form-group">
                                    <label>Appointment Type</label>
                                    <input type="text" name="ApptType" class="form-control" placeholder="e.g. General"> 
                                </div>
                                <div class="form-group">
                                    <label>Doctor*</label>
                                    </br>

                                    <?php 
                                    $stmt = $conn->prepare("
                                        SELECT * FROM clinic.Doctor WHERE ClinicID = $ClinicID");
                                    // Bind & execute the query statement:
                                    if (!$stmt->execute()){
                                        $errorMsg = "Execute failed: " . $stmt->errno . " " . $stmt->error;
                                        $success = false;
                                    };
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        // output data of each rows
                                        //echo '<input type="radio" name="Doctor>"';
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<input type="radio" name="DocID" required ';

                                            if (isset($DocID) && $DocID === $row["DocID"]) {
                                                echo "checked";
                                            }
                                            echo 'value = ';
                                            echo $row["DocID"];
                                            echo "> \t Dr.";

                                            echo $row["DocName"];
                                            echo "\t";
                                        }
                                    } else {
                                        echo "No doctors are available for this clinic!"; 
                                    }

                                    $stmt->close();
                                    $conn->close();
                                    ?>

                                </div>
                                <input type="hidden" id="ClinicID" name="ClinicID" value=" <?php echo $ClinicID; ?> " readonly><br>
                                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                            </form>
                        </div> 
                        <?php include "footer.inc.php";  ?>
                    </body>
                </html>
            <?php
            // if clinic id does not exist in db, redirect to 404 error page
            }else{
                $conn->close();
                echo "no page found";
            }
        }else{
            // show 404 error page
            include "404error.php";  
        }
    }else{
        ?>
        <html>
            <head>
                <?php include "head.inc.php"; ?>
            </head>
            <body>
                <?php include "nav.inc.php"; ?>
                <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                    <h1 class="font-bold text-2xl text-purple-800">Unable to Book!</h1>
                    <p>Please login before you book an appointment.</p>
                    <button class="loginformbutton font-semibold"><a href="login.php">Login</a></button>
                </div>    
        </html>
    <?php                    
    }
?>