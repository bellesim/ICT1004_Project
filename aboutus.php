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
        <?php include "timeout.inc.php"; ?>
        <div class="top-wrap uk-position-relative pb-40"> 

            <?php include "nav.inc.php"; ?>
            <div class="uk-grid-medium " uk-grid>
                <div class="mt-24 ml-40 mt-32 ">
                    <h1 class="k-heading-primary font-bold text-4xl ">Services we provide </h1>
                    <p class="text-base mt-4 w-3/4 text-justify">Take decisions with real time data based on users interaction.
                        Clinic Finder is a platform application where selected partnered clinics are gathered for Clinic Finder's members easier reference be able to select their preferred clinics and make an appointment straight from this website. Saves users time and ensures users satisfactory.
                    </p>
                    <img src="images/about_us.jpg" class="h-auto w-3/4 mt-12 "></div>
            </div>

            <div class="mt-24 ml-40 flex">
                <img src="images/about_us2.jpg" class="h-auto w-1/4 uk-visible@m">
                <div class="row">
                    <h1 class="k-heading-primary font-bold text-4xl ml-12">Who are we?</h1>
                    <p class="text-base ml-12 mt-4 w-3/4 text-justify">Clinic Finder offers a comprehensive range of primary healthcare services through our clinics located island-wide. Our experienced medical team consisting of doctors, specialists, nurses and phlebotomists seek to provide quality care in an enriching, welcoming and tech-enabled environment.
                
                    <p class="text-base ml-12 mt-4 w-3/4 text-justify"><h1 class="k-heading-primary font-bold text-4xl ml-12">Our concept</h1>
                    <p class="text-base ml-12 mt-4 w-3/4 text-justify">Clinic Finder offers a comprehensive range of primary healthcare services through our clinics located island-wide. Our experienced medical team consisting of doctors, specialists, nurses and phlebotomists seek to provide quality care in an enriching, welcoming and tech-enabled environment.
                
                
                </div>

            </div>
        </div>       


   

    <?php include "footer.inc.php"; ?>
    <!-- JS FILES -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
</body>
</html>