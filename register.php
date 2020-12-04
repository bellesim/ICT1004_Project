<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
    <head>
        <title>Clinic Finder</title>
        <?php include "head.inc.php";?>
    </head>
    <body>
        <main>
        <div class="top-wrap uk-position-relative pb-20"> 
        <?php include "nav.inc.php";?>
        </div>
        <?php 
        $now = new DateTime();
        $date_created = $now->format('Y-m-d');
        ?>
        <div class="uk-card uk-card-default uk-card-body uk-align-center mt-32" style="width: 50%">
            <div class="text-left text-black">
                <div class="uk-card uk-card-default uk-card-body uk-width-1\@m">
                    <div class="uk-width uk-padding-small mt-6">
                        <div class="mb-12">
                            <h1 class="text-4xl font-bold text-blue-800">Create An Account</h1>
                            <p class="mt-2 text-base">Already have an account? <a href="login.php" class=" font-medium text-blue-600">Sign in</a></p>
                        </div>

                        <form action="register_process.php" method="post">
                            <p class="italic text-red-700 mb-8">* mandatory fields</p>
                            <div class="uk-grid-small " uk-grid>
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold" for="fname">First Name</label>
                                    <input class="uk-input rounded h-12 bg-gray-100 text-black" placeholder="Enter your first name" type="text" id="fname" name="fname" maxlength="50">      
                                </div>
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold" for="lname">Last Name*</label>
                                    <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your last name" type="text" id="lname" name="lname" required maxlength="50">      
                                </div>
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold" for="nric_fin">NRIC/FIN*</label>
                                    <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your NRIC/FIN" type="text" id="nric_fin" name="nric_fin" required maxlength="9">      
                                </div>
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold" for="email">Email*</label>
                                    <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your email" type="text" id="email" name="email" required>     
                                </div>
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold" for="contact">Mobile No*</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your mobile number without space (e.g. 98765432)" type="tel" id="contact" name="contact" required pattern="[0-9]{8}">     
                                    </div>
                                </div>
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold" for="pwd">Password*</label>
                                    <p class="pwdrequirement" style="margin:0;" uk-toggle="target: #modal-pwd-requirement">Click to view requirement</p>
                                    <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter password" type="password" id="pwd" name="pwd" required >     
                                </div>    
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold" for="pwd_confirm">Confirm Password*</label>
                                    <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter password again" type="password" id="pwd_confirm" name="pwd_confirm" required >     
                                </div>  
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold" for="dob">Date of Birth*</label>
                                    <input class="uk-input rounded h-12 bg-gray-100" type="date" id="dob" name="dob" max="<?PHP echo $date_created;?>" required>
                                </div>
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold mb-2">Gender*</label><br>
                                    <input class="uk-radio" type="radio" id="male" name="gender" value="male" checked required>
                                    <label for="male">Male</label>
                                    <input class="uk-radio" type="radio" id="female" name="gender" value="female" required>
                                    <label for="female">Female</label>
                                </div>

                                <div class="uk-grid-small mt-8 mb-16" uk-grid>
                                    <div class="uk-width-1-3\@s">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="height">Height*</label>
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your height in cm (1 decimal point is allowed)" type="text" id="height" name="height" required maxlength="5">     
                                    </div> 
                                    <div class="uk-width-1-3\@s">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="weight">Weight*</label>
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your weight in kg (1 decimal point is allowed)" type="text" id="weight" name="weight" required maxlength="5">     
                                    </div>  
                                    <div class="uk-width-1-3\@s">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="allergies">Allergies*</label>
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your allergies" type="text" id="allergies" name="allergies" required maxlength="200">     
                                    </div>  
                                </div>
                               
                                
                                <!-- pop up model for password requirement -->
                                <div id="modal-pwd-requirement" uk-modal>
                                    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                                        <button class="uk-modal-close-default" type="button" uk-close></button>
                                        <h1 class="text-center text-purple-800 font-semibold">Password Requirements</h1><br>
                                        <div class="text-center">
                                            <p>&#10004; Minimum 8 characters without space</p>
                                            <p>&#10004; At least one uppercase</p>
                                            <p>&#10004; At least one lowercase</p>
                                            <p>&#10004; At least one number</p>
                                            <p>&#10004; At least one symbol</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-margin-bottom uk-width-1-1">
                                    <button type="submit" class="uk-button uk-button-primary uk-width-1-1 rounded h-12 bg-blue-800 ">Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            </main>
        <?php include "footer.inc.php";?>

    </body>
</html>
