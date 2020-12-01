<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <?php
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link rel="icon" href="img/favicon.ico">
        <!-- CSS FILES -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/main.css">


        <script>
            function showtab(evt, tabName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(tabName).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>

    </head>

    <body>
        <!--<div class="uk-light wrap uk-background-norepeat uk-background-cover uk-background-center-center uk-cover-container uk-background-secondary">
            <img src="images/loginhd.jpg" alt="banner" data-uk-cover data-uk-img>
            <div class="uk-flex uk-flex-center uk-flex-middle uk-height-viewport uk-position-z-index uk-position-relative" data-uk-height-viewport="min-height: 400" style="background-color: rgba(105,105,105, 0.5);">
                <include "nav.inc.php"; ?>
                
            </div>
        </div>!-->
        <div class="flex">
            <img src="images/login_asset.png" class="h-full w-7/12" >
            <div id="login" class=" text-left">
                <div class="uk-card uk-card-default uk-card-body mt-20 uk-position-right">
                    <div class="uk-width uk-padding-small mt-6">
                        <div class="mb-16">
                            <h2 class="text-4xl font-bold text-blue-800">Create an account</h2>
                        <p class="mt-2 text-base">Already have an account? <a href="register.php" class=" font-medium text-blue-600">Sign in</a></p></div>
                            <div id="register">
                
                        <p class="text-center italic text-red-700 mb-8">* Required</p>
                        <form action="register_process.php" method="post">
                            <div class="uk-margin ">
                              <div class="uk-inline uk-width-1-1">
                                         <label class="uk-form-label text-base text-blue-800 font-semibold" for="fname">First Name</label>
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your first name" type="text" id="fname" name="fname" requiredmaxlength="50" name="fname" >
                                    </div>
                            </div>
                            </div>
                            <div class="uk-margin ">
                              <div class="uk-inline uk-width-1-1">
                                         <label class="uk-form-label text-base text-blue-800 font-semibold" for="lname">Last Name</label>
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your last name" type="text" id="fname" name="fname" requiredmaxlength="50" name="fname" >
                                    </div>
                            </div>
                            </div>
                               <div class="uk-margin ">
                              <div class="uk-inline uk-width-1-1">
                                         <label class="uk-form-label text-base text-blue-800 font-semibold" for="fname">NRIC/FIN*</label>
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your NRIC " type="text" id="fname" name="fname" requiredmaxlength="50" name="fname" >
                                    </div>
                            </div>
                            </div>
                            


                            <!-- pop up model for password requirement -->
                            <div id="modal-pwd-requirement" uk-modal>
                                <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                                    <button class="uk-modal-close-default" type="button" uk-close></button>
                                    <h1 class="text-purple-800 font-semibold">Password Requirements</h1><br>
                                    <div class="text-center">
                                        <p>&#10004; Minimum 8 characters without space</p>
                                        <p>&#10004; At least one uppercase</p>
                                        <p>&#10004; At least one lowercase</p>
                                        <p>&#10004; At least one number</p>
                                        <p>&#10004; At least one symbol</p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="uk-button uk-button-primary uk-width-1-1 rounded h-12 bg-blue-800" href="#modal-overflow">Register</button>
                            </div>
                        </form>
                
            </div>
       
    <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
</body>
<script>
                                // Get the element with id="defaultOpen" and click on it
                                document.getElementById("defaultOpen").click();
</script>   
</html>
