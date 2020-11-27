<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <?php
        include "head.inc.php";
        ?>
        
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

    <body class="text-center">
         <?php include "nav.inc.php"; ?>
        <?php include "timeout.inc.php"; ?>
        <div class="space-y-6" style="margin: auto; width: 50%; ">
            <h1 class="font-bold text-2xl text-black">Welcome, Create your Account</h1>
            <p class="text-black">Be part of our family</p>
            <div class="tabheader">
                <a class="tablink" onclick="showtab(event,'register')" id="defaultOpen">Register</a>
                <a class="tablink" onclick="showtab(event,'login')">Login</a>
            </div>

            <div id="register" class="tabcontent text-left active">
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

            <div id="login" class="tabcontent text-left">
                <form action="login_process.php" method="post">
                    <div class="uk-margin">
                        <label class="uk-form-label text-purple-800 font-semibold" for="nric_fin">NRIC/FIN</label>
                        <div class="uk-form-controls">
                        <input class="uk-input uk-form-width-large" type="text" id="nric_fin"
                            required maxlength="9" name="nric_fin" placeholder="Enter your NRIC/FIN">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label text-purple-800 font-semibold" for="pwd">Password</label>
                        <div class="uk-form-controls">
                        <input class="uk-input uk-form-width-large" type="password" id="pwd"
                            required name="pwd" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="loginformbutton font-semibold" href="#modal-overflow" type="submit">Login</button>
                    </div>
                </form>
            </div>
                
            <?php include "footer.inc.php";  ?>
        </div>
        
    </body>
    <script>
        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>   
</html>
