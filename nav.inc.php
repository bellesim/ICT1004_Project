<?php
if (isset($_SESSION["NRIC"]) && isset($_SESSION["username"])) {
    ?>    
    <header>

        <div class="uk-position-top">
            <!--<nav class="uk-navbar-container uk-navbar-transparent shadow-sm" data-uk-navbar>!-->
            <nav class="uk-navbar-container shadow-sm" style="background-color: #333333;" data-uk-navbar>

                  <!-- <img src="images/clinic_logo.png" class="uk-navbar-item uk-logo w-1/12" alt="Logo" > -->
                <div class="uk-navbar-left text-white">
                    <ul class="uk-navbar-nav text-white uk-text-bold mr-8 mt-3 uk-visible@s" style="color:white;">
                        <li><a href="index.php" >Home</a></li>
                        <li><a href="clinic.php">Clinics</a></li>
                        <li><a href="aboutus.php">About Us</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="appt.php">Appointments</a></li>
                    </ul>
                    <a href="#" class="uk-navbar-toggle uk-hidden@s" uk-navbar-toggle-icon uk-toggle="target: #sidenav"></a>
                </div>

                <div class="uk-navbar-right">
                    <div class="uk-navbar-item uk-visible@s">
                        <div><p class="text-white font-bold">Welcome, <?php echo $_SESSION["username"]; ?></p></div>
                        <div><button class="uk-button uk-button-small uk-text-bold" type="button" uk-toggle="target: #modal-logout">Logout</button></div>
                    </div>
                </div>
                <!-- show popup model if user click logout button -->
                <div id="modal-logout" uk-modal>
                    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                        <br><br><h1 class="text-black text-center">Are you sure you want to logout?</h1><br><br><br>
                        <div style="margin:auto;">
                            <button class="button mr-6 text-white" type="button" style="float:left;"><a href="logout.php">Logout</a></button>
                            <button class="uk-modal-close button" type="button" style="float:right;">Cancel</button>
                        </div>
                    </div>
                </div>    
            </nav>
        </div>
    </header>
    <div id="sidenav" uk-offcanvas="flip: false" class="uk-offcanvas">
        <div class="uk-offcanvas-bar" style="background: #696969;">
            <ul class="uk-nav text-white ">
                <li><p class="text-black text-white font-bold mr-8 mt-3">Welcome, <?php echo $_SESSION["username"]; ?></p></li>
                <li><a href="index.php" >Home</a></li>
                <li><a href="clinic.php">Clinics</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="appt.php">Appointments </a></li>
                <li><a uk-toggle="target: #modal-logout">Logout</a>
            </ul>
        </div>
    </div>


    <?php
} else {
    ?>
    <header>
        <div class="uk-position-top ">
            <div class="w-full">
                <nav class="uk-navbar-container uk-navbar-transparent shadow-sm" style="background-color: #333333;" data-uk-navbar>

                     <!-- <img src="images/clinic_logo.png" class="uk-navbar-item uk-logo w-1/12" alt="Logo" > -->

                    <div class="uk-navbar-left ">

                        <ul class="uk-navbar-nav uk-text-bold uk-visible@s" style="color: white;">
                            <li><a href="index.php" >Home</a></li>
                            <li><a href="clinic.php">Clinics</a></li>
                            <li><a href="aboutus.php">About Us</a></li>
                        </ul>
                        <a href="#" class="uk-navbar-toggle uk-hidden@s" uk-navbar-toggle-icon uk-toggle="target: #sidenav"></a>
                    </div>
                    <div class="uk-navbar-right">
                        <div class="uk-navbar-item text-white uk-text-bold uk-visible@s">
                            <a href="login.php" class="uk-button  uk-button-medium uk-width-2-3 uk-width-auto@s rounded ml-24">Login</a>
                            <a href="register.php" class="uk-button uk-button-small uk-text-bold">Register</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <div id="sidenav" uk-offcanvas="flip: false" class="uk-offcanvas">
        <div class="uk-offcanvas-bar text-white" style="background: #696969;">
            <ul class="uk-nav">
                <li><a href="index.php" >Home</a></li>
                <li><a href="clinic.php">Clinics</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </div>
    </div>
    <?php
}
?>
