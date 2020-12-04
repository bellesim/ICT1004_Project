<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
    <head>
        <title>Clinic Finder</title>
        <?php include "head.inc.php"; ?>
    </head>

    <body>
        <div class="top-wrap uk-position-relative pb-20"> 
        <?php include "nav.inc.php";?>
        </div>
        <main>
        <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
            <div class=" text-left">
                <div class="uk-card uk-card-default uk-card-body">
                    <div class="uk-width uk-padding-small">
                        <div class="mb-16">
                            <h1 class="text-4xl font-bold text-blue-800">Welcome Back</h1>
                            <div class="text-base">
                            <p class=" mt-6">We make your doctor appointments easier than ever.</p>
                        <p class="mt-2">New user? <a href="register.php" class=" font-medium text-blue-600">Create an account</a></p></div>

                        </div>
                        <form class="toggle-class" action="login_process.php" method="post">
                            <fieldset class="uk-fieldset">
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="nric_fin">NRIC/FIN</label><br>
                                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: user"></span>
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="NRIC/FIN" type="text" id="nric_fin" name="nric_fin" required maxlength="9">
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="pwd">Password</label><br>
                                        <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: lock"></span>
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="Password" type="password" id="pwd" name="pwd" required>
                                    </div>
                                </div>
                            
                                <div class="uk-margin-bottom  mt-20">
                                    <button type="submit" class="uk-button uk-button-primary uk-width-1-1 rounded h-12 bg-blue-800 ">LOG IN</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </main>
    <?php include "footer.inc.php";?>
</body>
</html>
