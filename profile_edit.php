<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/profile.css">

        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/js/uikit-icons.min.js"></script>
        <title>Home</title>
        <?php include "nav.inc.php"; ?>

    </head>
    
    <header>
        
    </header>
    
    <body>
    <div class="detailsContainer m-0 h-full  ml-24 uk-width-1-2@m" >
    <h2 id="myAccount" class="text-black text-4xl font-bold  mb-4">Your Account</h2>   

    <h3 class="uk-card-title font-bold">Edit Account Details</h3><br>
    <form role="form" method="post" action="profileEdit_process.php">
    <div class="uk-grid-small" uk-grid>
    <div class="uk-width-1-1">
    <p>What's your first name?</p>
    <input class="uk-input" type="text" placeholder="Enter First Name" name="firstname" required>    
    </div>
    <div class="uk-width-1-1">
    <p>What's your last name?</p>
    <input class="uk-input" type="text" placeholder="Enter Last Name" name="lastname" required>
    </div>
    <div class="uk-width-1-1">
    <p>Email</p>
    <input class="uk-input" type="text" placeholder="Enter Email" name="email" required>
    </div>
    <div class="uk-width-1-1">
    <p>Mobile</p>
    <input class="uk-input" type="text" placeholder="Enter Mobile" name="mobile" required>
    </div>
    <div class="uk-width-1-4@s">
    <p>Height</p>
    <input class="uk-input" type="text" placeholder="Enter Height" name="height" >     
    </div>
    <div class="uk-width-1-4@s">
    <p>Height</p>
    <input class="uk-input" type="text" placeholder="Enter Weight" name="weight" > 
    </div>
    <div class="uk-width-1-4@s">
    <p>Allergies</p>
    <input class="uk-input" type="text" placeholder="Enter Allergies" name="allergies" required>
    </div>
    </div><br>
    <button type="submit" class="uk-button">Edit Profile</button>
    </form>
</div>  

           
        
<!-- <?php include "footer.inc.php";  ?> -->

    </body>
</html>
