
           <?php
            if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
                ?>
              <div class="uk-position-top">
              			<div class="nav" data-uk-sticky="cls-active: uk-background-secondary uk-box-shadow-medium; top: 100vh; animation: uk-animation-slide-top">
          <div class="uk-container uk-container-large">
            <nav class="uk-navbar-container uk-navbar-transparent" data-uk-navbar>
              <!-- <div class="uk-navbar-left">
                <div class="uk-navbar-item">
              <img src="images/clinic_logo.png" height="30px" width="40px" height alt="Logo" >
                </div>
              </div> -->
              <div class="uk-navbar-left">
                <ul class="uk-navbar-nav">
                <li class="uk-visible@s"><a href="index.php">Home</a></li>
                  <li class="uk-visible@s"><a href="clinic.php">Clinics</a></li>
                  <li class="uk-visible@s"><a href="aboutus.php">About Us</a></li>
                  <li class="uk-visible@s"><a href="profile.php">Profile</a></li>
                 <li class="uk-visible@s"><a href="appt_booked.php">Appointment</a></li>
                 
                </ul>
              </div>
              <div class="uk-navbar-right">
                <div class="uk-navbar-item">
               <p>Welcome, <?php echo $_SESSION["username"]; ?></p></li>
                <button class="uk-button" uk-toggle="target:#modal-logout">Log Out</button>
              </div>

            </nav>
          </div>
          </div>
        </div>
         
            
            <!-- display username and logout button
            <div class="flex flex-row-reverse">
                <div><button class="button mt-2" type="button" uk-toggle="target: #modal-logout" >Logout</button></div>
                <div><p class="text-black font-bold mr-8 mt-3">Welcome, <?php echo $_SESSION["username"]; ?></p></div>
            </div> -->
            
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

            <?php
                }else{
            ?>
            <div class="uk-position-top">
          <div class="uk-container uk-container-small mr-24">
            <nav class="uk-navbar-container uk-navbar-transparent" data-uk-navbar>
              <div class="uk-navbar-left">
                <div class="uk-navbar-item">
              <!-- <img src="images/clinic_logo.png" alt="Logo" > -->
                </div>
              </div>
              <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                <li class="uk-visible@s"><a href="index.php">Home</a></li>
                  <li class="uk-visible@s"><a href="clinic.php">Clinics</a></li>
                  <li class="uk-visible@s"><a href="aboutus.php">About Us</a></li>
                </ul>
                <a href="login.php" class="uk-button uk-button-primary uk-button-medium uk-width-2-3 uk-width-auto@s rounded ml-24">Login</a>

              </div>
            </nav>
          </div>
        </div>
                <?php
                
                }
        ?>