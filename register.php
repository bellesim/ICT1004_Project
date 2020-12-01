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
        <div class="flex">
            <img src="images/login_asset.png" class="h-full w-7/12" >
                <div class="uk-card uk-card-default uk-card-body uk-width-1@m ">
                    <div class="uk-width uk-padding-small mt-6">
                        <div class="mb-12">
                            <h2 class="text-4xl font-bold text-blue-800">Create an account</h2>
                        <p class="mt-2 text-base">Already have an account? <a href="login.php" class=" font-medium text-blue-600">Sign in</a></p></div>
                            <div id="register">
                      <form action="register_process.php" method="post">
                        <div class="uk-grid-small " uk-grid>
                            <div class="uk-width-1-1">
                                <label class="uk-form-label text-blue-800 font-semibold" for="fname">First Name</label>
                                <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your first name" type="text" id="fname" name="fname" required maxlength="50">      
                            </div>
                        <div class="uk-width-1-1">
                                <label class="uk-form-label text-blue-800 font-semibold" for="lname">Last Name</label>
                                <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your last name" type="text" id="fname" name="lname" required maxlength="50">      
                            </div>
                        <div class="uk-width-1-1">
                                <label class="uk-form-label text-blue-800 font-semibold" for="nric_fin">NRIC/FIN</label>
                                <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your NRIC/FIN" type="text" id="nric_fin" name="nric_fin" required maxlength="9">      
                            </div>
                            <div class="uk-width-1-1">
                                <label class="uk-form-label text-blue-800 font-semibold" for="email">Email</label>
                                <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your email" type="text" id="email" name="email" required>     
                            </div>
                             <div class="uk-width-1-1">
                                <label class="uk-form-label text-blue-800 font-semibold" for="contact">Mobile No</label>
                                <div class="uk-form-controls">
                                <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter your mobile number" type="tel" id="contact" name="contact" required pattern="[0-9]{8}">     
                            </div>
                            <div class="uk-width-1-1">
                                <label class="uk-form-label text-blue-800 font-semibold" for="pwd">Password</label>
                                <button class="pwdrequirement" type="button" uk-toggle="target: #modal-pwd-requirement">Click to view requirement</button>
                                <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter password" type="password" id="pwd" name="pwd" required >     
                            </div>    
                                <div class="uk-width-1-1">
                                <label class="uk-form-label text-blue-800 font-semibold" for="pwd_confirm">Confirm Password</label>
                                <button class="pwdrequirement" type="button" uk-toggle="target: #modal-pwd-requirement">Click to view requirement</button>
                                <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter password again" type="password" id="pwd_confirm" name="pwd_confirm" required >     
                            </div>  
                                <div class="uk-grid-small mt-8" uk-grid>
              
                            <div class="uk-width-1-3@s">
                                <label class="uk-form-label text-blue-800 font-semibold" for="height">Height</label>
                                <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter height" type="text" id="height" name="height" required maxlength="5">     
                            </div> 
                            <div class="uk-width-1-3@s">
                                <label class="uk-form-label text-blue-800 font-semibold" for="weight">Weight</label>
                                <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter weight" type="text" id="weight" name="weight" required maxlength="5">     
                            </div>  
                            <div class="uk-width-1-3@s">
                                <label class="uk-form-label text-blue-800 font-semibold" for="allergies">Allergies</label>
                                <input class="uk-input rounded h-12 bg-gray-100" placeholder="Enter allergies" type="text" id="allergies" name="allergies" required maxlength="200">     
                            </div>  
                            </div>
                            </div>
                            <!-- pop up model for password requirement
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
                            </div> -->
                               <div class="uk-margin-bottom">
                                    <button type="submit" class="uk-button uk-button-primary uk-width-1-1 rounded h-12 bg-blue-800 " href="#modal-overflow">Sign Up</button>
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
