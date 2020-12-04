<?php
    include "dbFunctions.php";
    global $errorMsg, $success, $patid, $apptid;
    $apptid = $_POST['delapptid'];
    // Create database connection.
    $conn = db();
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $stmt = $conn->prepare("DELETE FROM clinic.Appointment WHERE ApptID = ?");
        // Bind & execute the query statement:
        $stmt->bind_param("i", $apptid);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // output data of each row
//                    echo "Delete was Not successful";
        } else {
//                    echo "Delete was successful";
            header("Location:appt.php");
        }
        $stmt->close();
    }
    $conn->close();
?>