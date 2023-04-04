<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change</title>

    <!-- links to stylesheets -->
    <link rel="stylesheet" href="..\fonts\arial-nova\stylesheet.css">
    <link rel="stylesheet" href="../styles/LogInStyles.css">



</head>

<body>


    <div id="logInDiv">
        <div id="logInHeader">
            <p><img src="../images/LOGOS/TRU-LG03.png" alt="TRU-logo"><strong>THOMPSON RIVERS UNIVERSITY</strong></p>
            <P class="subtitle">Look's like you are using the defalult password, </P>
            <p>please change it using the following fields</p>
        </div>
        <div id="change-passForm">
            <form method='post' action='Controller.php'>
                <input type='hidden' name='command' value='ChangeP'>
                <input type='hidden' name='page' value='ChangeP'>
                <input type='hidden' name='command' value='LogIn'>
                <input type="password" placeholder="Please enter Password" class="wide" name="newPassword" required></br>
                <input type="password" placeholder="Please confirm Password" class="wide" name="newPassword-C" required></br>
                <input type="submit" value="Change Password" class="wide" id="submitbutton">
            </form>
        </div>
    </div>


</body>

</html>