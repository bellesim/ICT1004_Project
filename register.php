<<<<<<< HEAD
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <p>Enter your contents here! :) </p>
        </div>   
        <?php
        // put your code here
        ?>
    </body>
</html>
=======
<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <?php include "head.inc.php";?>
    </head>
    <body>
        <div class="flex">
            <img src="images/login_asset.png" alt="login asset image" class="h-full w-7/12" >
            <div class="text-left">
                <div class="uk-card uk-card-default uk-card-body uk-width-1\@m  mt-20">
                    <div class="uk-width uk-padding-small mt-6">
                        <div class="mb-12">
                            <h2 class="text-4xl font-bold text-blue-800">Create An Account</h2>
                            <p class="mt-2 text-base">Already have an account? <a href="login.php" class=" font-medium text-blue-600">Sign in</a></p>
                        </div>

                        <form action="register_process.php" method="post">
                            <p class="italic text-red-700 mb-8">* mandatory fields</p>
                            <div class="uk-grid-small " uk-grid>
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold" for="fname">First Name</label>
                                    <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your first name" type="text" id="fname" name="fname" maxlength="50">      
                                </div>
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold" for="lname">Last Name*</label>
                                    <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your last name" type="text" id="fname" name="lname" required maxlength="50">      
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
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your mobile number" type="tel" id="contact" name="contact" required pattern="[0-9]{8}">     
                                    </div>
                                </div>
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold" for="pwd">Password*</label>
                                    <button class="pwdrequirement" type="button" uk-toggle="target: #modal-pwd-requirement">Click to view requirement</button>
                                    <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter password" type="password" id="pwd" name="pwd" required >     
                                </div>    
                                <div class="uk-width-1-1">
                                    <label class="uk-form-label text-blue-800 font-semibold" for="pwd_confirm">Confirm Password*</label>
                                    <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter password again" type="password" id="pwd_confirm" name="pwd_confirm" required >     
                                </div>  
                                <div class="uk-grid-small mt-8" uk-grid>
                                    <div class="uk-width-1-3\@s">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="height">Height*</label>
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your height" type="text" id="height" name="height" required maxlength="5">     
                                    </div> 
                                    <div class="uk-width-1-3\@s">
                                        <label class="uk-form-label text-blue-800 font-semibold" for="weight">Weight*</label>
                                        <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your weight" type="text" id="weight" name="weight" required maxlength="5">     
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
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
    </body>
</html>
>>>>>>> aa1178317c1e3643b563feb57b942887233efeda
