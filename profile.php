<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION["NRIC"])&&isset($_SESSION["username"])){
    ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<metagit  charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Home</title>
		<link rel="icon" href="img/favicon.ico">
		<!-- CSS FILES -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/index.css">

	</head>
	<body>
  <?php include "timeout.inc.php"; ?>
              <div class="uk-flex uk-flex-center uk-flex-middle uk-height-viewport uk-position-z-index uk-position-relative" data-uk-height-viewport="min-height: 400">
                                   <?php include "nav.inc.php"; ?>

                    <!-- <img src="images/login_asset.png" class="h-full w-6/12 " > -->
                <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m mr-6">
                <h2 class="text-2xl font-semibold">Your Account</h2>
                <p class="uk-heading-divider"><p>
                    <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">NRIC </h4>
                <label class="text-base font-normal"><?php echo $nric ?><label>
                </div>
                    <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">First Name</h4>
                <label class="text-base font-normal"><?php echo $fname ?><label>
                </div>
                    <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Last Name</h4>
                <label class="text-base font-normal"><?php echo $lname ?><label>
                </div>
                    <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Email </h4>
                <label class="text-base font-normal"><?php echo $email ?><label>
                </div>
                    <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Mobile </h4>
                <label class="text-base font-normal"><?php echo $mobile ?><label>
                </div>
                <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Height</h4>
                <label class="text-base font-normal"><?php echo $height ?><label>
                </div>
                <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Weight </h4>
                <label class="text-base font-normal"><?php echo $weight ?><label>
                </div>
                <div class="uk-width-1-1">
                <h4 class="text-base font-semibold mt-4">Allergies </p>
                <label class="text-base font-normal"><?php echo $allergies?><label>
                </div><br>
                    <div class="uk-margin-bottom">                    
                    <a href="profile_edit.php" class="uk-button uk-button-primary uk-width-1-3 m-0 rounded h-12 bg-blue-800">Edit Profile</a>
                    <a href="changePassword.php" class="uk-button uk-button-primary uk-width-1-3 m-0 rounded h-12 bg-blue-800">Edit Password</a></div>

                </div>
            
            </fieldset>
                </div>
             </div>
                
            <?php include "footer.inc.php";  ?>
	
	
		
		
		<!-- JS FILES -->
		<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
	</body>
</html>
    <?php
    
    }else{
        // show 404 error page
        include "404error.php";  
    }
?>


