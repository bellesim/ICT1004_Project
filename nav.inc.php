<!-- 
     <style>
     .uk-navbar-nav>li>a {
    text-transform: none;
}
     </style> -->
           <?php
            if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
                ?>
              <div class="uk-position-top">
            <nav class="uk-navbar-container uk-navbar-transparent shadow-sm" data-uk-navbar>
              <!-- <img src="images/clinic_logo.png" class="uk-navbar-item uk-logo w-1/12" alt="Logo" > -->
              <div class="uk-navbar-left ">
                <ul class="uk-navbar-nav ">
                <li class="uk-visible@s"><a href="index.php" >Home</a></li>
                  <li class="uk-visible@s"><a href="clinic.php">Clinics</a></li>
                  <li class="uk-visible@s"><a href="aboutus.php">About Us</a></li>
                  <li class="uk-visible@s"><a href="profile.php">Profile</a></li>
                  <li class="uk-visible@s"><a href="appt.php">Appointments </a></li>
                </ul>
              </div>

                <div class="uk-navbar-right">
                <div class="uk-navbar-item">
                  <div><p class="text-black font-bold mr-8 mt-3">Welcome, <?php echo $_SESSION["username"]; ?></p></div>
                  <div><button class="class="uk-button  uk-button-medium uk-width-2-3 uk-width-auto@s rounded ml-24" type="button" uk-toggle="target: #modal-logout">Logout</button></div>
                </div>
              </div>
               <!-- show popup model if user click logout button -->
            <div id="modal-logout" uk-modal>
                <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                    <button class="uk-modal-close-default" type="button" uk-close></button>
                    <br><br><h1 class="text-black text-center">Are you sure you want to logout?</h1><br><br><br>
                    <div style="margin:auto;">
                        <button class="button mr-6" type="button" style="float:left;"><a href="logout.php">Logout</a></button>
                        <button class="uk-modal-close button" type="button" style="float:right;">Cancel</button>
                    </div>
                </div>
            </div>    
            </nav>
        </div>
           

            <?php
                }else{
            ?>
            <div class="uk-position-top ">
          <div class="w-full">
            <nav class="uk-navbar-container uk-navbar-transparent shadow-sm" data-uk-navbar>
         
              <!-- <img src="images/clinic_logo.png" class="uk-navbar-item uk-logo w-1/12" alt="Logo" > -->

              <div class="uk-navbar-left ">

                <ul class="uk-navbar-nav ">
                <li class="uk-visible@s"><a href="index.php" >Home</a></li>
                  <li class="uk-visible@s"><a href="clinic.php">Clinics</a></li>
                  <li class="uk-visible@s"><a href="aboutus.php">About Us</a></li>
                </ul>
              </div>
                <div class="uk-navbar-right">
                <div class="uk-navbar-item">
                  <a href="login.php" class="uk-button  uk-button-medium uk-width-2-3 uk-width-auto@s rounded ml-24">Login</a>
                  <a href="register.php" class="uk-button uk-button-primary uk-button-medium uk-width-2-3 uk-width-auto@s rounded ml-24">Register</a>
                </div>
              </div>
            </nav>
          </div>
        </div>
                <?php
                }
        ?>