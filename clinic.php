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
        <!--<h2 class="font-bold text-4xl">List of Clinics available</h2><p>&nbsp;</p><p>&nbsp;</p>!-->
        <section class="uk-section">
            <div class="uk-container uk-text-center uk-section  ">
                <h2 class="text-4xl font-bold">Partnering Clinics</h2>
            </div>
            <div class="uk-child-width-1-4@m px-24" uk-grid >

                <?php
                $conn = new mysqli("localhost", "sqldev", "P@ssw0rd", "clinic");

                if ($conn->connect_errno) {
                    echo "Failed to connect to MYSQL: " . $conn->connect_error();
                }
                $result = $conn->query("SELECT * FROM clinic.Clinic");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { {
                            ?>

                            <div>
                                <div class="uk-card uk-card-default">
                                    <div class="uk-card-media-top">
                                        <?php echo "<img src='images/".$row['Image']."'>"?>
                                    </div>
                                    <div class="uk-card-body">
                                        <h3><b><?php echo $row['ClinicName'] ?></b></h3>
                                        <!--<p><?php echo $row['Descriptions'] ?></p>!-->
                                        <p><?php echo $row['ClinicAddress'] ?></p>
                                        <p><?php echo $row['ClinicPostalCode'] ?></p>
                                        <p><?php echo $row['ClinicContactNo'] ?></p>

                                        <form action="appt_booking.php" method="POST">
                                            <input type="hidden" id="ClinicID" name="ClinicID" value=" <?php echo $row["ClinicID"]; ?> ">
                                            
                                    <button onclick="window.location.href = 'appt_booking.php'" class="uk-button uk-button-primary uk-width-1-1 rounded h-12 bg-blue-800" href="#modal-overflow">Make appointment</button>
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
                ?>     </section>
         
         <section class="uk-section uk-section-secondary uk-section-large">
			<div class="uk-container">
				<div class="uk-grid uk-child-width-1-2@l uk-flex-middle">
					<div>
						<h6>Book an appointment in just a few clicks</h6>
						<h2 class="uk-margin-small-top uk-h1">Manage all your bookings from different clinics in one place only.</h2>
						<p class="subtitle-text">
							The partnering clinics that we have joined together to provide our users the easier and simplest way possible for appointment booking.
						</p>
					</div>
					<div data-uk-scrollspy="cls: uk-animation-fade">
						<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="img/marketing-2.svg" data-uk-img alt="Image">
					</div>
				</div>
			</div>
		</section>
          <section class="uk-section uk-section-secondary uk-section-large">
			<div class="uk-container">
				<!-- blank!-->
			</div>
		</section>
           <!-- <?php include "footer.inc.php"; ?>!-->
    </body>
</html>
