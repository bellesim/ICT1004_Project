<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
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
                <div class="uk-section uk-section-small uk-padding-remove-top">
                    <ul class="uk-subnav uk-subnav-pill uk-flex uk-flex-center" data-uk-switcher="connect: .uk-switcher; animation: uk-animation-fade">
                        <li><a class="rounded" >Schedule Appointments</a></li>
                        <li><a class="rounded">Personalised Treatments</a></li>
                    </ul>
                </div>

                <ul class="uk-switcher uk-margin">
                    <li>
                        <div class="uk-grid uk-child-width-1-2@l uk-flex-middle" data-uk-grid data-uk-scrollspy="target: > div; cls: uk-animation-slide-left-medium">
                            <div>
                                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/schedule_planning.png" alt="" data-uk-img>
                            </div>
                            <div data-uk-scrollspy-class="uk-animation-slide-right-medium">
                                <h2 class="font-semibold text-2xl">Schedule Appointments</h6>
                                    <h2 class="text-xl mt-4">Take decisions with real time data based on users interaction.</h2>
                                    <p class="text-base mt-4">
                                       This document website information that enables users of the Appointment scheduling system to create, 
                                       edit, or cancel Appointments from the patient login's tool.
                                    </p>

                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="uk-grid uk-child-width-1-2@l uk-flex-middle" data-uk-grid data-uk-scrollspy="target: > div; cls: uk-animation-slide-left-medium">
                            <div>
                                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="img/marketing-1.svg" alt="" data-uk-img>
                            </div>
                            <div data-uk-scrollspy-class="uk-animation-slide-right-medium">
                                <h2 class="font-semibold text-2xl">Personalised Treatments</h6>
                                    <h2 class="text-xl mt-4">Take decisions with real time data based on users interaction.</h2>
                                    <p class="text-base mt-4">
                                        Personalized medicine is the tailoring of medical treatment to the individual characteristics of each
                                        patient. The approach relies on scientific breakthroughs in our understanding of how a person's unique
                                        molecular and genetic profile makes them susceptible to certain diseases.
                                    </p>
                            </div>
                        </div>
                    </li>
                </ul>	
            </div>
        </section>
        <!-- BOTTOM -->
        <section class="uk-section">
            <div class="uk-container uk-text-center uk-section  ">
                <h2 class="text-4xl font-bold">Partnering Clinics</h2>
            </div>
            <div class="uk-child-width-1-4@m px-24" uk-grid >
                <div>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top">
                            <img src="images/trinity.jpeg" alt="Clinic One">
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Trinity Medical Clinic</h3>
                            <p>providing medical services to the community and our corporate clients. </p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default ">
                        <div class="uk-card-media-top">
                        <img src="images/faith.png" alt="faith"/>
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Faith Medical Clinic</h3>
                            <p>Our range of services have expanded from acute and chronic ailments treatments.</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top">
                        <img src="images/lifelineclinic.png" alt="lifeline"/>
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Lifeline Bishan Medical Clinic</h3>
                            <p>Lifeline Bishan Medical Clinic is a General Health Clinic in Bishan, Singapore. </p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top">
                            <img src="images/viva.png" alt="viva"/>
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Viva Medical Clinic</h3>
                            <p>Provides services like health check up, normal flu treatment and vaccinations.</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-margin-bottom">
                        <!--<a href="clinic.php"class="uk-button uk-button-default uk-button-large uk-width-2-3 uk-width-auto@s" title="Book Appointments">Book Apppointments</a>!-->
                        <button onclick="window.location.href = 'clinic.php'" class="uk-button uk-button-primary uk-width-1-1 rounded h-12 bg-blue-800" href="#modal-overflow">Book appointment</button>


                    </div>

                </div>
        </section>
        <?php include "footer.inc.php"; ?>





        <!-- JS FILES -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
    </body>
</html>