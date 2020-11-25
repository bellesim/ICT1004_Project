<?php 
$msg = "Please log in first.";
include 'profile_process.php';

$_SESSION['NRIC'] = "S8512067J";
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/profile.css">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/js/uikit-icons.min.js"></script>

    <title>Profile</title>

</head>
<body>
<?php include "nav.inc.php";?> 
<div class="profileContainer mt-16  ml-24 ">
<h2 id="myAccount" class="text-black text-4xl font-bold  mb-4">Your Account</h2>   
<h1 class="uk-heading-divider"></h1>

<div class="detailsContainer m-0 h-full  ">
    <div class="uk-width-1-2@m ">
    <h3 class="uk-card-title font-bold">Account Details</h3><br>
    <div class="uk-grid-small" uk-grid>
    <div class="uk-width-1-1">
    <p>What's your first name?</p>
    <label><?php echo $fname ?><label>
    <input class="uk-input" type="text" value="<?php echo $fname ?>" readonly>    
    </div>
    <div class="uk-width-1-1">
    <p>What's your last name?</p>
    <input class="uk-input" type="text" value="<?php echo $lname ?>" readonly>
    </div>
    <div class="uk-width-1-1">
    <p>Email</p>
    <input class="uk-input" type="text" value="<?php echo $email ?>"readonly>
    </div>
    <div class="uk-width-1-1">
    <p>Mobile</p>
    <input class="uk-input" type="text" value="<?php echo $mobile ?>"readonly>
    </div>
    <div class="uk-width-1-4@s">
    <p>Height</p>
    <input class="uk-input" type="text" value="<?php echo $height ?>"readonly>       
    </div>
    <div class="uk-width-1-4@s">
    <p>Weight</p>
    <input class="uk-input" type="text" value="<?php echo $weight ?>"readonly>    
    </div>
    <div class="uk-width-1-4@s">
    <p>Allergies</p>
    <input class="uk-input" type="text" value="<?php echo $allergies ?>" readonly>  
    </div>
    </div><br>
    <form action="profile_edit.php">
    <button class="uk-button" type="submit">Edit Profile</button></form>
    <form action="changePassword.php">
    <button class="uk-button" type="submit">Change Password</button>
</form>

    </div>
</div>
</div>
    <?php include "footer.inc.php"; ?>

</body>
</html>
