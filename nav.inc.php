<div class="container">
        <a href="index.php"><img id="logo" src="images/logo.png" alt="Logo"/></a>

    
<div class="topnav" id="myTopnav">
  <a href="index.php" class="active">Home</a>
  <a href="clinic.php">Clinic</a>
  <a href="aboutus.php">About us</a>


      <?php
            if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
                ?>
            
            <a href="profile.php">My Profile</a>
            <a href="appt.php">My Appointment</a>
            
            <!-- display username and logout button -->
            <div class="flex flex-row-reverse">
                <div><button class="button mt-2" type="button" uk-toggle="target: #modal-logout" >Logout</button></div>
                <div><p class="text-black font-bold mr-8 mt-3">Welcome, <?php echo $_SESSION["username"]; ?></p></div>
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

            <?php
                }else{
            ?>
            <div class="button"><a href="login.php">Login</a></div>
                <?php
                
                }
        ?>
  

  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>


<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
</div>

