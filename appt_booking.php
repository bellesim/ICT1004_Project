<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <title>Clinic</title>
        <link rel="icon" href="img/favicon.ico">
        <!-- CSS FILES -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <?php include "head.inc.php"; ?>
    </head>
    <body class='clinic'>
         <!-- TOP -->
        <div class="top-wrap uk-position-relative" uk-background-primary style="background-color: #515151;"> 
        <div class="uk-flex uk-flex-center uk-flex-middle h-20">
            <?php include "nav.inc.php";?>
            </div>
        </div>
        <?php include "timeout.inc.php"; ?>
        <section class="uk-section">
            
             <div class="uk-flex uk-flex-center uk-flex-middle uk-height-viewport uk-position-z-index uk-position-relative" data-uk-height-viewport="min-height: 200">
                 <img src="images/indeximage.png">
                <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m mr-6">
                    
                <h2 class="text-2xl font-semibold">Make an appointment</h2>
                <p class="uk-heading-divider"><p>
                           
                    
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

            
                        <?php 
                        $currentdate = new DateTime();
                        $currentdate = $currentdate->setTimezone(new DateTimeZone('Asia/Singapore'));
                        $interval = new DateInterval('P1D');
                        $currentdate->add($interval);
                        $currentdate = $currentdate->format('yy-m-d');
                        ?>

                        <div class="container">
                            <form action="appt_booked.php" method="POST" class="form-control">
                                <p class="italic text-red-700 mb-8">* mandatory fields</p>
                                
                                
                                <div class="uk-width-1-1">
                                    <h4 class="text-base font-semibold mt-4">Clinic: <?php echo $ClinicName;?> </h4>
                                </div>
                                <div class="uk-width-1-1">
                                    <h4 class="text-base font-semibold mt-4"><label>Appointment Date* <input type="date" name="ApptDate" class="form-control" min="<?php echo $currentdate;?>" required></label> </h4>                                                                     
                                </div>
                               <div class="uk-width-1-1">
                                   <div class="form-group">
                                    <h4 class="text-base font-semibold mt-4"><label for="ApptStartTime">Appointment Timeslot*:</label>
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
                                    </select></h4>
                                   </div>
                                </div>
                                
                                <div class="uk-width-1-1">
                                    <div class="form-group">
                                    <h4 class="text-base font-semibold mt-4"><label>Appointment Type</label>
                                    <input type="text" name="ApptType" class="form-control" placeholder="e.g. General"> </h4>
                                    </div>
                                </div>
                                
                                <div class="uk-width-1-1">
                                    <div class="form-group">
                                    <h4 class="text-base font-semibold mt-4"><label>Doctor*</label>
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
                                <button onclick="window.location.href = 'appt_booking.php'" class="uk-button uk-button-primary uk-width-1-1 rounded h-12 bg-blue-800" href="#modal-overflow">Make appointment</button>

                            </form></h4>
                                    </div>
                              
                        </div> 
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
          
            <body>
                <div class="space-y-6 text-black" style="margin: auto; width: 50%; ">
                    <h1 class="font-bold text-2xl text-purple-800">Unable to Book!</h1>
                    <p>Please login before you book an appointment.</p>
                <a href="login.php" class="uk-button uk-button-primary uk-button-medium uk-width-2-3 uk-width-auto@s rounded ml-24">Login</a>
                </div>    
        </html>
    <?php                    
    }
?>
         <?php include "footer.inc.php"; ?>

        <!-- JS FILES -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>           
    </body>
</html>








