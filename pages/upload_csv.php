<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload User-list</title>


    <!-- links to stylesheets -->
    <link rel="stylesheet" href="/fonts/arial-nova/stylesheet.css">
    <link rel="stylesheet" href="/styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/uploaduserstyles.css">



</head>

<body>

    <!-------------------------- Navigation section------------------------- -->
    <?php
    require('Navigation.php');
    ?>
    <!----------------------------- Main section -------------------------------->

    <!-----------------main container-------------------->
    <div class="container">

        <!-------------left side container---------->
        <div class="leftside">
            <div class="header">
                <h2>Survey Users</h2>
            </div>
            <div class="usertable">
                <?php
                require('../utilities/ShowUserTable.php');
                ?>
            </div>
        </div>

        <!------------right side container----------->
        <div class="rightside">
            <div class="header">
                <h2>Add Users</h2>
            </div>

            <!---------file row------------>
            <div class="row row1">
                <form action="../utilities/uploadFunction.php" method="post" enctype="multipart/form-data">
                    <label for="csvfile">Upload CSV file containing user information:</label>
                    <input type="file" name="csvfile" id="csvfile" accept=".csv">
                    <br>
                    <input type="submit" value="Upload" name="submit" id="submitr1">
                </form>
            </div>

            <!---------manually row------------>
            <div class="row row2">
                <p>Add user manually</p>
                <form action="../utilities/addUser.php" method="post">
                    <input type="text" name="fName" placeholder="User First Name">
                    <input type="text" name="lName" placeholder="User Last Name">
                    <input type="text" name="email" placeholder="User email">
                    <input type="text" name="emailC" placeholder="Confirm email">
                    <input type="text" name="department" placeholder="User Department">
                    <select name="userType" id="userType">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <input type="submit" value="Add User" id="submitr2">
                </form>

            </div>


            <!---------delete row------------>
            <div class="row row3">
                <h2>Delete User</h2>
                <form action="../utilities/userdelete.php" method="post">
                    <input type="text" name="email" placeholder="User email">
                    <input type="text" name="emailC" placeholder="Confirm email">
                    <input type="submit" value="Delete User" id="submitr3">
                </form>
            </div>
        </div>

    </div>



</body>

</html>