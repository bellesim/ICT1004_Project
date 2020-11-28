<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <?php include "head.inc.php"; ?>
    </head>
    <body class='clinic'>
        <?php 
        include "nav.inc.php";
        include "timeout.inc.php"; 
        include "dbFunctions.php";
        ?>
        <div class="container">
            <h2 class="font-bold text-4xl">List of Clinics available</h2><p>&nbsp;</p><p>&nbsp;</p>

            <div class="row">
                <?php
                $conn = db();

                if ($conn->connect_errno) {
                    echo "Connection failed: " . $conn->connect_error;
                }
                $result = $conn->query("SELECT * FROM clinic.Clinic");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        {
                            ?> <body class='clinic'>
                                <div class="column">
                                    <div class="card">
                                        <img src="images/vivaClinic.jpg" alt="viva" style="width:100%">
                                        <h3><b><?php echo $row['ClinicName']?></b></h3>
                                        <p><?php echo $row['ClinicAddress']?></p>
                                        <p><?php echo $row['ClinicPostalCode']?></p>
                                        <p><?php echo $row['ClinicContactNo']?></p>
                                                                                
                                        <form action="appt_booking.php" method="POST">
                                            <input type="hidden" id="ClinicID" name="ClinicID" value=" <?php echo $row["ClinicID"]; ?> " readonly>
                                            <button type="submit" class="apptButton">Make appointment</button>
                                        </form>
                                    </div>
                                </div><?php
                            }
                        }
                    } else {

                        echo "0 results";
                    }
                    $conn->close();
                    ?>
            </div>
        </div>    
        <?php include "footer.inc.php";  ?>
    </body>
</html>