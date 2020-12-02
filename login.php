<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <?php include "head.inc.php"; ?>
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
                <div class="uk-card uk-card-default uk-card-body mt-20">
                    <div class="uk-width uk-padding-small mt-20">
                        <div class="mb-16">
                            <h2 class="text-4xl font-bold text-blue-800">Welcome Back</h2>
                            <div class="text-base">
                            <p class=" mt-6">We make your doctor appointments easier than ever.</p>
                        <p class="mt-2">New user? <a href="register.php" class=" font-medium text-blue-600">Create an account</a></p></div>

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
                            
                                <div class="uk-margin-bottom">
                                    <button type="submit" class="uk-button uk-button-primary uk-width-1-1 rounded h-12 bg-blue-800 ">LOG IN</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
</body>
</html>
