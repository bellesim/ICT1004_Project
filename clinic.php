<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "head.inc.php";?>
        <style>
            .lead {
                font-size: 1.175em;
                font-weight: 300;
            }
            .uk-logo img {
                height: 28px;
            }
        </style>
    </head>
    <body>
        <?php 
        include "timeout.inc.php"; 
        include "dbFunctions.php";?>
        <div class="top-wrap uk-position-relative pb-20"> 
            <?php include "nav.inc.php";?>
       	</div>	
		<div class="uk-grid-medium " uk-grid>
	        <!-- BOTTOM -->
        <section class="uk-section">
               <div class="uk-container uk-text-center uk-section  ">
                <h2 class="text-4xl font-bold"> Clinics</h2>
            </div>
            <div class="uk-child-width-1-3@m px-24" uk-grid >
                <?php
                $conn = db();

                if ($conn->connect_errno) {
                    echo "Connection failed: " . $conn->connect_error;
                }
                $result = $conn->query("SELECT * FROM clinic.Clinic");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { {
                            ?>	<div>
                            <div class="uk-card uk-card-default uk-card-small" style="box-shadow: none;">
                                            <div class="uk-card-media-top">
                                                <?php echo "<img src='images/".$row['Image']."'>"?>
                                            </div>
                                            <div class="uk-card-header">
                                                    <div class="uk-grid-small uk-flex-middle" data-uk-grid>
                                                            <div class="uk-width-auto">
                                                            </div>
                                                            <div class="uk-width-default">
                                                                    <h6 class="uk-margin-remove-bottom uk-text-bold mt-4"><?php echo $row['ClinicName'] ?></h6>
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="uk-card-body">
                                            <div class="flex pr-4">
                                            <p class="text-base font-semibold mr-4">Address</p>
                                            <span class="text-base"><?php echo $row['ClinicAddress'] ?></span>
                                            </div>
                                            <div class="flex">
                                            <p class="text-base font-semibold mr-4 ">Opening Hours</p>
                                            <span class="text-base"><?php echo $row['ClinicOpeningHours'] ?></span>
                                            </div>
                                                <form action="appt_booking.php" method="POST">
                                                 <input type="hidden" id="ClinicID" name="ClinicID" value=" <?php echo $row["ClinicID"]; ?> ">
                                                <button class="uk-button uk-button-text uk-text-bold uk-margin-small" type="submit">Book Appointment</button>
                                                </form>
											</div>
										</div>
									</div>
                                

                                              
                             
                                
                            <?php
                        }
                    }
                } else {

                    echo "0 results";
                }
                $conn->close();
                ?>  
        </section>
        </div>

        
        <?php include "footer.inc.php"; ?>
    </body>
</html>
