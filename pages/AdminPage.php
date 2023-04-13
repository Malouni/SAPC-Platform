<?php
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
            </div>

            <div class="header">
                <h2>Surveys</h2>
            </div>
            <div class="surveyTable" id="survey-table">
            </div>
        </div>


        <!------------right side container----------->
        <div class="rightside">
            <div class="header">
                <h2>Add Users</h2>
            </div>

            <!---------user info file row------------>
            <div class="row row1">
                <form onsubmit="addUsersFromFileFunction(); return false">
                    <label for="csvFile">Upload CSV file containing user information:</label>
                    <input type="file" name="csvUserFile" id="csvUserFile" accept=".csv" required>
                    <br>
                    <input type="submit" value="Upload" id="csvSureInfoFileSend">
                </form>
            </div>

            <!---------manually row------------>
            <div class="row row2">
                <p>Add user manually</p>
                <form onsubmit="addNewUserFunction(); return false">
                    <input type="text" name="fName" id = "fName" placeholder="User First Name" required>
                    <input type="text" name="lName" id = "lName" placeholder="User Last Name" required>
                    <input type="text" name="email" id = "email" placeholder="User email" required>
                    <input type="text" name="emailC" id = "emailC" placeholder="Confirm email" required>
                    <input type="text" name="department" id = "department" placeholder="User Department" required>
                    <select name="userType" id="userType" require>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <input type="submit" value="Add User" id="addNewUser">
                </form>
            </div>

            <div class="header">
                <h2>Add Survey</h2>
            </div>

            <!---------survey info file row------------>
            <div class="row row3">
                <!-----
                <input type="file" name="csvSurveyFile" id="csvSurveyFile" accept=".csv" required>
                <button onclick="addSurveyFromFileFunction()">Click</button>
                ------>
                <form onsubmit="addSurveyFromFileFunction(); return false">
                    <label for="csvFile">Upload CSV file containing Survey information:</label>
                    <input type="file" name="csvSurveyFile" id="csvSurveyFile" accept=".csv" required>
                    <br>
                    <input type="submit" value="Upload" id="csvSurvInfoFileSend">
                </form>
            </div>
        </div>

    </div>



</body>

</html>