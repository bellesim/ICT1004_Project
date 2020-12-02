<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Clinics</title>
        <link rel="icon" href="img/favicon.ico">
        <!-- CSS FILES -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/index.css">


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
        <?php include "timeout.inc.php"; ?>
        <div class="top-wrap uk-position-relative pb-40"> 
            <?php include "nav.inc.php";?>
       		
		<div class="uk-grid-medium " uk-grid>
	        <!-- BOTTOM -->
        <section class="uk-section">
               <div class="uk-container uk-text-center uk-section  ">
                <h2 class="text-4xl font-bold"> Clinics</h2>
            </div>
            <div class="uk-child-width-1-3@m px-24" uk-grid >
                <?php
                $conn = new mysqli("localhost", "sqldev", "P@ssw0rd", "clinic");

                if ($conn->connect_errno) {
                    echo "Failed to connect to MYSQL: " . $conn->connect_error();
                }
                $result = $conn->query("SELECT * FROM clinic.Clinic");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { {
                            ?>	<div>
									<div class="uk-card uk-card-default uk-card-small" style="box-shadow: none;">
											<div class="uk-card-media-top">
												<a href="#"><img data-src="https://unsplash.it/620/350/?random=4" width="620" height="350" data-uk-img="target: !.uk-slideshow-items" alt=""></a>

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
                                              <a class="uk-button uk-button-text uk-text-bold uk-margin-small" href="appt_booking.php">Book Appointment</a>
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

	
		<section class="uk-section uk-section-default">
			<div class="uk-grid-divider uk-child-width-expand@s p-24" uk-grid>
			<h1 class="k-heading-primary font-bold text-4xl ml-12">Why People Choose Us </h1>

		<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
		<div>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
</div>
		</section>
        
        <?php include "footer.inc.php"; ?>
        <!-- JS FILES -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
    </body>
</html>