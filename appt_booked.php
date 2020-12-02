

                
          
        <!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Marketing - UIkit 3 KickOff</title>
		<link rel="icon" href="img/favicon.ico">
		<!-- CSS FILES -->
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

	</head>
	<body>
		<!-- TOP -->
		<!--<div class="top-wrap uk-position-relative uk-light uk-background-secondary"> !-->
        <div class="top-wrap uk-position-relative" uk-background-primary style="background-color: #515151;"> 
        <div class="uk-flex uk-flex-center uk-flex-middle h-20">
            <?php include "nav.inc.php";?>
            </div>
        </div>
	<!-- /TOP -->
		<section id="content" class="uk-section uk-section-default">
			<div class="uk-container">
				<div class="uk-section uk-section-small uk-padding-remove-top">
					<ul class="uk-subnav uk-subnav-pill uk-flex uk-flex-center" data-uk-switcher="connect: .uk-switcher; animation: uk-animation-fade">
						<li><a class="rounded" href="#">Appointment</a></li>
					</ul>
				</div>

				<ul class="uk-switcher uk-margin">
					<li>
						<div class="uk-grid uk-child-width-1-2@l uk-flex-middle" data-uk-grid data-uk-scrollspy="target: > div; cls: uk-animation-slide-left-medium">
							<div>
                                <img src="images/indeximage.png" alt="aboutus"data-uk-img>
                            </div>
							<div data-uk-scrollspy-class="uk-animation-slide-right-medium">
								<h2 class="font-semibold text-4xl">Appointments made</h6>
								<p class="subtitle-text">
									<!DOCTYPE html>
<?php
    session_start();
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
            <html>
              
                <body>
                    <?php 
                
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
                            <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                                <h1 class="font-bold text-2xl text-purple-800">Appointment Booked!</h1>
                                <p>Your appointment is booked successfully.</p>
                                <p>You may go to My Appointment page to view the appointment details.</p>
                                <button class="loginformbutton font-semibold"><a href="appt.php">Go to My Appointment</a></button>
                            </div>    
                            <?php
                        }else{
                            ?>
                            <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                                <h2 class="font-bold text-2xl text-purple-800">Failed to Book Appointment!</h2>
                                <p class="font-bold">Reason(s):</p>
                                <?php echo "<p>".$errorMsg."</p>";?>
                                <p class="mt-8">Please try again.</p>
                                <button class="loginformbutton font-semibold"><a href="clinic.php">Back to Clinic</a></button>
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                        <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                            <h2 class="font-bold text-2xl text-purple-800">Failed to Book Appointment!</h2>
                            <p class="font-bold">Reason(s):</p>
                            <?php echo "<p>".$errorMsg."</p>";?>
                            <p class="mt-8">Please try again.</p>
                            <button onclick="window.location.href = 'clinic.php.php'" class="uk-button uk-button-primary uk-width-1-1 rounded h-12 bg-blue-800" href="#modal-overflow">Back to Clinic</button>
                        </div>
                        <?php
                    }
                ?>    
                </body>
            </html>
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
								</p>
								
							</div>
						</div>
					</li>
				
				</ul>
				
				
			</div>
		</section>

		
		 <?php include "footer.inc.php"; ?>

        <!-- JS FILES -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
    </body>
</html>
