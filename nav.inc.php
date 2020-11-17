<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
</style>
</head>
<body>
    <div class="container">
        <a href="index.php"><img id="logo" src="images/logo.png" alt="Logo"/></a>

    
<div class="topnav" id="myTopnav">
  <a href="index.php" class="active">Home</a>
  <a href="clinic.php">Clinic</a>
  <a href="aboutus.php">About us</a>
  <!-- Needs to be editted to hide if user is not logged in --> 
  <a href="profile.php">My Profile</a>
  <a href="appt_booked.php">My Appointment</a>

  <button class="button button">Login</button>
  <!--<div class="button" href="login.php">Login</div> -->

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
</body>
</html>
