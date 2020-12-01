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


        <!-- <script>
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
        </script> -->

    </head>

    <body>
        <!--<div class="uk-light wrap uk-background-norepeat uk-background-cover uk-background-center-center uk-cover-container uk-background-secondary">
            <img src="images/loginhd.jpg" alt="banner" data-uk-cover data-uk-img>
            <div class="uk-flex uk-flex-center uk-flex-middle uk-height-viewport uk-position-z-index uk-position-relative" data-uk-height-viewport="min-height: 400" style="background-color: rgba(105,105,105, 0.5);">
                <include "nav.inc.php"; ?>
                
            </div>
        </div>!-->
        <div class="flex">
            <img src="images/login_asset.png" class=" w-full" >
            <div id="login" class=" text-left">
                <div class="uk-card uk-card-default uk-card-body mt-20">
                    <div class="uk-width uk-padding-small mt-20">
                        <div class="mb-20  text-center">
                            <h2 class="text-4xl font-bold text-blue-800">Welcome Back</h2>
                            <div class="text-base">
                            <p class=" mt-6">We make your doctor appointments easier than ever.</p>
                        <p class="mt-2">New user? <a href="register.php" class=" font-medium text-blue-600">Create an account</a></p></div>

                        </div>
                        <!-- <div class="tabheader">
                            <a class="tablink" onclick="showtab(event, 'login')" id="defaultOpen">Login</a>
                            <a class="tablink" onclick="showtab(event, 'register')" >Register</a>

                        </div> -->
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
       
    <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
</body>
<script>
                                // Get the element with id="defaultOpen" and click on it
                                document.getElementById("defaultOpen").click();
</script>   
</html>
