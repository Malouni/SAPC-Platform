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

    <!-- links to scripts -->
    <script src="../scripts/AdminPage.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


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
            <div class="usertable" id="user-table">
                <?php
                    if (!empty($result))
                        echo $result;
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
                <form>
                    <label for="csvFile">Upload CSV file containing user information:</label>
                    <input type="file" name="csvFile" id="csvFile" accept=".csv">
                    <br>
                    <input type="submit" value="Upload" name="csvFileSend" id="csvFileSend">
                </form>
            </div>

            <!---------manually row------------>
            <div class="row row2">
                <p>Add user manually</p>
                <form>
                    <input type="text" name="fName" id = "fName" placeholder="User First Name">
                    <input type="text" name="lName" id = "lName" placeholder="User Last Name">
                    <input type="text" name="email" id = "email" placeholder="User email">
                    <input type="text" name="emailC" id = "emailC" placeholder="Confirm email">
                    <input type="text" name="department" id = "department" placeholder="User Department">
                    <select name="userType" id="userType">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <input type="submit" value="Add User" id="addNewUser">
                </form>
            </div>


            <!---------delete row------------>
            <div class="row row3">
                <h2>Delete User</h2>
                <form>
                    <input type="text" name="emailDelete"  id="emailDelete" placeholder="User email">
                    <input type="text" name="emailCDelete" id="emailCDelete" placeholder="Confirm email">
                    <input type="submit" value="Delete User" id="deleteUser">
                </form>
            </div>
        </div>

    </div>



</body>

</html>