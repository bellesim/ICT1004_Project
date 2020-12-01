<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <?php
        include "head.inc.php";
        ?>
        <?php include "nav.inc.php" ?>
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
            <img src="images/login_asset.png" class="h-full w-7/12 " >
            <div id="login" class="tabcontent text-left">
                <div class="uk-card uk-card-default uk-card-body mt-20 uk-position-center">
                    <div class="uk-width uk-padding-small mt-20">
                        <div class="mb-20   text-center">
                            <h2 class="text-4xl font-bold text-blue-800">Welcome Back</h2>
                            <p class="mt-6">We make your doctor appointments easier than ever.</p>
                        </div>
                        <div class="tabheader">
                            <a class="tablink" onclick="showtab(event, 'login')" id="defaultOpen">Login</a>
                            <a class="tablink" onclick="showtab(event, 'register')" >Register</a>

                        </div>
                        <form class="toggle-class" action="login_process.php" method="post">
                            <fieldset class="uk-fieldset">
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: user"></span>
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="NRIC/FIN" type="text" id="nric_fin" name="nric_fin" required maxlength="9">
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: lock"></span>
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="Password" type="password" id="pwd" name="pwd" required>
                                    </div>
                                </div>
                                <!-- <div class="uk-margin-small">
                                    <label><input class="uk-checkbox" type="checkbox"> Keep me logged in</label>
                                </div> -->
                                <div class="uk-margin-bottom">
                                    <button type="submit" class="uk-button uk-button-primary uk-width-1-1 rounded h-12 bg-blue-800" href="#modal-overflow">LOG IN</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div id="register" class="tabcontent text-left active" style="border-bottom: none;">
                <div class="uk-card uk-card-default uk-card-body mt-20 uk-position-center" style="margin-top: 20%;">
                    <div class="uk-width uk-padding-small mt-20">
                        <div class="mb-20   text-center">
                            <h2 class="text-4xl font-bold text-blue-800">New here? Let's register!</h2>
                            <p class="mt-6">We make your doctor appointments easier than ever.</p>
                        </div>
                        <div class="tabheader">
                            <a class="tablink" onclick="showtab(event, 'register')" id="defaultOpen">Register</a>
                            <a class="tablink" onclick="showtab(event, 'login')">Login</a>
                        </div>
                        <p class="text-center italic text-red-700 mb-8">* mandatory fields</p>
                        <form action="register_process.php" method="post">
                            <div class="uk-margin">
                                <label class="uk-form-label text-purple-800 font-semibold" for="fname">First Name</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input uk-form-width-large placeholder-gray-700" type="text" id="fname"
                                           maxlength="50" name="fname" placeholder="Enter your first name">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label text-purple-800 font-semibold" for="lname">Last Name*</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input uk-form-width-large placeholder-gray-700" type="text" id="lname"
                                           required maxlength="50" name="lname" placeholder="Enter your last name">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label text-purple-800 font-semibold" for="nric_fin">NRIC/FIN*</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input uk-form-width-large placeholder-gray-700" type="text" id="nric_fin"
                                           required maxlength="9" name="nric_fin" placeholder="Enter your NRIC/FIN">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label text-purple-800 font-semibold" for="email">Email Address*</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input uk-form-width-large placeholder-gray-700" type="email" id="email"
                                           required name="email" placeholder="Enter your email">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label text-purple-800 font-semibold" for="contact">Contact Number*</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input uk-form-width-large placeholder-gray-700" type="tel" id="contact"
                                           required name="contact" pattern="[0-9]{8}"
                                           placeholder="Enter your contact number without space (e.g. 98765432)">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label text-purple-800 font-semibold" for="pwd">Password*</label>
                                <button class="pwdrequirement" type="button" uk-toggle="target: #modal-pwd-requirement">Click to view requirement</button>
                                <div class="uk-form-controls">
                                    <input class="uk-input uk-form-width-large placeholder-gray-700" type="password" id="pwd"
                                           required name="pwd" placeholder="Enter password">
                                </div>
                            </div>                  
                            <div class="uk-margin">
                                <label class="uk-form-label text-purple-800 font-semibold" for="pwd_confirm">Reconfirm Password*</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input uk-form-width-large placeholder-gray-700" type="password" id="pwd_confirm"
                                           required name="pwd_confirm" placeholder="Confirm password">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label text-purple-800 font-semibold" for="height">Height*</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input uk-form-width-large placeholder-gray-700" type="text" id="height"
                                           required maxlength="5" name="height" placeholder="Enter your height in cm (1 decimal point is allowed)">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label text-purple-800 font-semibold" for="weight">Weight*</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input uk-form-width-large placeholder-gray-700" type="text" id="weight"
                                           required maxlength="5" name="weight" placeholder="Enter your weight in kg (1 decimal point is allowed)">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label text-purple-800 font-semibold" for="allergies">Allergies*</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input uk-form-width-large placeholder-gray-700" type="text" id="allergies"
                                           required maxlength="200" name="allergies" placeholder="Enter your allergies">
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
                                <button class="loginformbutton font-semibold" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
</body>
<script>
                                // Get the element with id="defaultOpen" and click on it
                                document.getElementById("defaultOpen").click();
</script>   
</html>
