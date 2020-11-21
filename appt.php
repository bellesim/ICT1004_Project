<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/main.css">
        <title>Home</title>
        <?php include "nav.inc.php"; ?>

    </head>
        <header>
        </header>

        <body>
        
        <div class="container">
            <p>Enter your contents here for BOOKING of appointment! :) </p>
        </div> 
        </body>
    <?php
    $success = true;
    $patid = 1;
    
    function showappt() {
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
                SELECT ApptSubmitTime, ApptDate, ApptStartTime, ApptDuration, ApptType, DocName, DocSpecialisation, ClinicName, ClinicAddress, ClinicPostalCode
                FROM clinic.Appointment, clinic.Doctor, clinic.Clinic
                WHERE Appointment.DocID = Doctor.DocID AND Appointment.ClinicID = Clinic.ClinicID AND PatID = $patid");
            // Bind & execute the query statement:
            $stmt->bind_param("i", $patid);
            if (!$stmt->execute()){
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $success = false;
            };
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // output data of each row
                echo "<table><tr><th>Appointment booked at:</th><th>Date:</th><th>Time</th><th>Duration</th><th>Appointment type</th><th>Doctor Name</th><th>Clinic name</th><th>Clinic address</th><th>Edit</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["ApptSubmitTime"] . "</td>";
                    echo "<td>" . $row["ApptDate"] . "</td>";
                    echo "<td>" . $row["ApptStartTime"] . "</td>";
                    echo "<td>" . $row["ApptDuration"] . " mins" . "</td>";
                    echo "<td>" . $row["ApptType"] . "</td>";
                    echo "<td>" . $row["DocName"] . "</td>";
                    echo "<td>" . $row["ClinicName"] . "</td>";
                    echo "<td>" . $row["ClinicAddress"] .  ", Singapore " . $row["ClinicPostalCode"].  "</td>";
                    echo "<td> add link here </td></tr>";
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
        

        <hr>
        <?php
            if ($success) { 
                showappt() 
        ?>
        <br> 
        <?php
            } else {
            echo "<h1>Oops!</h1>";
            echo "<h2>the following errors were detected:</h2>";
            echo "<p>" . $errorMsg . "</p>"; ?> 
        <a href="login.php" class="btn btn-danger" role="button">Return to Login</a> 
        <br> 
        <?php } 
        ?>

        <?php include "footer.inc.php"; ?>

    </body>
</html>
