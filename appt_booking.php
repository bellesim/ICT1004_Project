
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/main.css">
        <title>Home</title>
        <?php include "nav.inc.php"; ?>
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
        <script src="js/components/autocomplete.js"></script>
    </head>
        <header>
        </header>

    <body>
    
    <div class="container">
        <?php
            $currentdate = new DateTime();
            $currentdate = $currentdate->setTimezone(new DateTimeZone('Asia/Singapore'));
            $interval = new DateInterval('P1D');
            $currentdate->add($interval);
            $currentdate = $currentdate->format('yy-m-d');
        ?>
        
        <form action="appt_booked.php" method="post" class="form-control">
                <div class="form-group">
                    <label>Appointment Date</label>
                    
                    
                    <input type="date" name="ApptDate" class="form-control" required min="<?php echo $currentdate;?>">
                </div>

                <div class="form-group">
                    <label for="ApptStartTime">Appointment Timeslot:</label>
                    <select id="ApptStartTime" name="ApptStartTime">
                        <option value="0800">0800-0900</option>
                        <option value="0900">0900-1000</option>
                        <option value="1000">1000-1100</option>
                        <option value="1100">1100-1200</option>
                        <option value="1200">1200-1300</option>
                        <option value="1300">1300-1400</option>
                        <option value="1400">1400-1500</option>
                        <option value="1500">1500-1600</option>
                        <option value="1600">1600-1700</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Appointment Type</label>
                    <input type="text" name="ApptType" class="form-control">
                </div>
                <div class="form-group">
                    <label>Doctor</label>
                    </br>

        <?php 
        $ClinicID = 1;
        global $patid, $errorMsg, $success ;
        // Create database connection.
        
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],$config['password'], $config['dbname']);
        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
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
                    echo '<input type="radio" name="DocID"';
                    
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
            }

        $conn->close();
        
                    ?>
                    <input type="text" name="DocName" class="form-control">
                </div>
 
            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
        </form>
    </div> 
    </body>
        

</html>