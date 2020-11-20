<html>
    <head>
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity= "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"crossorigin="anonymous">
        <script defer src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
                integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
        crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/9a46cd43f5.js"></script>
        <link rel="stylesheet" href="css/main.css">
        <script defer src="js/main.js"></script>
        <title>World of Pets</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
       <div id="loginBox">
            <form role="form" method="post" action="index.php">
                <div class="loginHeader">
                    <h1>Login</h1>
                </div>
                <div class="modalContainer">
                    <input type="text" placeholder="Enter NRIC" name="NRIC" required >

                    <input type="password" placeholder="Enter Password" name="password" required>
                    

                    <button type="submit" class="btn btn-lg">Login</button>
                    <a href="forgetPassword.php">Forgot Password?</a>
                </div>
            </form>
        </div>
        <?php
        if (isset($_SESSION['loginfail'])) {
            $bMsg = $_SESSION['loginfail'];
            echo ("<script type='text/javascript'>
                alert('$bMsg');</script>");
            unset($_SESSION['loginfail']);
        }
        ?>
        <?php
        include "footer.inc.php"
        ?>
    </body>
