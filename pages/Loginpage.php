<?php 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <!-- links to stylesheets -->
    <link rel="stylesheet" href="..\fonts\arial-nova\stylesheet.css">
    <link rel="stylesheet" href="../styles/LogInStyles.css">
    


</head>
<body>
    

    <div id="logInDiv">
        <div id="logInHeader">
            <p><img src="../images/LOGOS/TRU-LG03.png" alt="TRU-logo"><strong>THOMPSON RIVERS UNIVERSITY</strong></p>
            <P class="subtitle">Science Strategic Plan</P>
        </div>
        <div id="loginForm">
            <form method='post' action='controller.php'>
                <input type='hidden' name='page' value='LogInPage'>
                <input type='hidden' name='command' value='LogIn'>
                <input type="text" placeholder="Please enter Username" class="wide" name = "truid" required></br>
                <select name="position" id="position">
                    <option value="??">??</option>
                    <option value="??">??</option>
                    <option value="??">??</option>
                    <option value="??">??</option>
                </select>
                <input type="password" placeholder="Please enter Password" class="wide" name = "password" required></br>
                <input type="checkbox" id="rememberUser" value="true"><label for="rememberUser">Remember Username</label></br>
                <input type="submit" value="Log In" class="wide" id="submitbutton">
            </form>
        </div>
        <div id="loginFside">
            <p><a href="" style="text-decoration: none; color:#288f94;">Forgotten your username or password?</a></p>
            <p>Cookies must be enabled in your browser</p>
        </div>
    </div>


</body>
</html>