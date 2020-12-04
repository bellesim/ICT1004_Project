
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "head.inc.php"; ?>
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
        <?php include "timeout.inc.php"; 
        include "dbFunctions.php";?>
        <div class="uk-light wrap uk-background-norepeat uk-background-cover uk-background-center-center uk-cover-container uk-background-secondary">
            <img src="images/banner.jpg" alt="banner" data-uk-cover data-uk-img>
            <div class="uk-flex uk-flex-center uk-flex-middle uk-height-viewport uk-position-z-index uk-position-relative" data-uk-height-viewport="min-height: 400" style="background-color: rgba(105,105,105, 0.5);">
                <?php include "nav.inc.php"; ?>
                <!-- TEXT -->
                <div class="uk-container uk-container-small uk-flex-auto uk-text-center" data-uk-scrollspy="target: > .animate; cls: uk-animation-slide-bottom-small uk-invisible; delay: 300">
                    <h1 class="k-heading-primary animate uk-invisible font-bold text-4xl ">Reliable and Trusted Clinics </h1>
                    <div class="uk-width-4-5@m uk-margin-auto animate uk-invisible mt-6">
                        <p class="lead">Find your nearest and most preferred clinics and make an appointment with just some few simple steps.</p>
                    </div>
                    <div class="uk-margin-medium-top animate uk-invisible" data-uk-margin data-uk-scrollspy-class="uk-animation-fade uk-invisible">
                        <a href="clinic.php"class="uk-button uk-button-default uk-button-large uk-width-2-3 uk-width-auto@s" title="Book Appointments">Book Apppointments</a>
                    </div>
                </div>
                <!-- /TEXT -->
            </div>
        </div>
        <!-- /TOP -->
        <section id="content" class="uk-section uk-section-default ">
            <div class="uk-container ">
                <ul class="uk-margin">
                    <li>
                        <div class="uk-grid uk-child-width-1-2@l uk-flex-middle" data-uk-grid data-uk-scrollspy="target: > div; cls: uk-animation-slide-left-medium">
                            <div>
                                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/schedule_planning.png" alt="schedule planning image" data-uk-img>
                            </div>
                            <div data-uk-scrollspy-class="uk-animation-slide-right-medium">
                                <h2 class="font-semibold text-2xl">Schedule Appointments</h2>
                                    <h2 class="text-xl mt-4">Take decisions with real time data based on users interaction.</h2>
                                    <p class="text-base mt-4">
                                       This document website information that enables users of the Appointment scheduling system to create, 
                                       edit, or cancel Appointments from the patient login's tool.
                                    </p>

                            </div>
                        </div>
                    </li>
                </ul>	
            </div>
        </section>
        <!-- BOTTOM -->
        <section class="uk-section">
            <div class="uk-container uk-text-center ">
            <div class="h-10">
                <h2 class="text-4xl font-bold ">Our Partnering Clinics</h2>
                <button onclick="window.location.href = 'clinic.php'" class="text-xl font-semibold float-right text-right text-blue-500 mb-4 -mx-12" href="#modal-overflow">See more</button>
                </div>
            </div>
            <div class="uk-child-width-1-4@m px-24" uk-grid >
                <?php
                $conn = db();

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
                                        <?php echo "<img src='images/".$row['Image']."' alt=\"\">"?>
                                    </div>
                                    <div class="uk-card-body">
                                        <h3><b><?php echo $row['ClinicName'] ?></b></h3>
                                       
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
            </div>
                    
        </section>
        <?php include "footer.inc.php"; ?>
    </body>
</html>
