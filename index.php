<?php
$msg ="Incorrect ID/Password";
include 'authentication.php';
ob_start();

if(!isset($_SESSION['NRIC'])){
    if ((isset($_POST['NRIC'])) && (isset($_POST['password']))) {
        $entered_UserName = $_POST['NRIC'];
        $entered_Password = $_POST['password'];
    } else {
        $_SESSION['loginfail'] = "Please log in first.";
        header('Location:login.php');
    }
    //problem
    $link = db();
    $passwordquery=$link->prepare("SELECT PatPassword FROM Patient WHERE PatNRIC=?");
    $passwordquery->bind_param('s',$entered_UserName);
    $passwordquery->execute();
    $passwordquery->bind_result($encryptedpassword);
    $passwordquery->fetch();
    if(password_verify($entered_Password,$encryptedpassword)){
        $passwordquery->close();
        $query = "SELECT*FROM Patient WHERE PatNRIC='$entered_UserName'";
        //get query from db
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        // if record found,store details into session
        if(mysqli_num_rows($result)==1){
            $row = mysqli_fetch_array($result);
            $_SESSION['PatNRIC'] = $row["PatNRIC"];
            $_SESSION['PatFirstName'] = $row["PatFirstName"];
            $_SESSION['PatLastName'] = $row["PatLastName"];
            $_SESSION['PatEmail'] = $row["PatEmail"];
        } else {
            $_SESSION['loginfail'] = "Incorrect username or password";
            header('Location:login.php');
        }
    } else {
        echo ("<script type='text/javascript'>
			alert('$msg')
			location.href='login.php';</script>");
    }
    }
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/main.css">
        <title>Home</title>
        <?php include "nav.inc.php"; ?>

    </head>
    <body>
        <div class="container">
            <img src="images/indeximage.png" alt="DocAppointment" class="indeximage"/>
        </div>            
<?php include "footer.inc.php";  ?>

    </body>
</html>
