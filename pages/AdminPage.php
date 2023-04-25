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
    <link rel="stylesheet" href="../styles/adminPage.css">

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

    <!-----------------cover-------------------->
    <div class='cover' id="blanket" onclick="hideCover()">
    </div>
    <!-----------------popup-------------------->
    <div class='popup' id="popup" >
        <button id=”close” onclick="hideCover();">&times;</button>
        <p>Select backup file</p>
        <div id="backUpFiles">
        </div>
    </div>
    <div class="container">

        <!-------------left side container---------->
        <div class="leftside">
            <div class="header">
                <h2>Survey Users</h2>
            </div>
            <div class="usertable">
                <h2>Search For A User</h2>
                <input type="text" onkeyup="searchUserFunction(this.id);" id="userInfo" placeholder="Please enter (First Name Last Name **Note** Space separated)">
                <div id="user-table">
                </div>
            </div>

            <div class="header">
                <h2>Surveys</h2>
            </div>
            <div class="surveyTable" id="survey-table">
            </div>
        </div>


        <!------------right side container----------->
        <div class="rightside">
            <div class="header split2">
                <h2>Add Users -CSV</h2>
                <h2>Add Survey -CSV</h2>
            </div>

            <!---------user info file row------------>
            <div class="row row1">
                <form onsubmit="addUsersFromFileFunction(); return false">
                    <label for="csvFile">Upload CSV file containing user information:</label>
                    <input type="file" name="csvUserFile" id="csvUserFile" accept=".csv" required>
                    <br>
                    <input type="submit" value="Upload" id="csvSureInfoFileSend">
                </form>
                <form onsubmit="addSurveyFromFileFunction(); return false">
                    <label for="csvFile">Upload CSV file containing Survey information:</label>
                    <input type="file" name="csvSurveyFile" id="csvSurveyFile" accept=".csv" required>
                    <br>
                    <input type="submit" value="Upload" id="csvSurvInfoFileSend">
                </form>
            </div>

            <!---------manually row------------>
            <div class="row row2">
                <p>Add user manually</p>
                <form onsubmit="addNewUserFunction(); return false">
                    <input type="text" name="fName" id="fName" placeholder="User First Name" required>
                    <input type="text" name="lName" id="lName" placeholder="User Last Name" required>
                    <input type="text" name="email" id="email" placeholder="User email" required>
                    <input type="text" name="emailC" id="emailC" placeholder="Confirm email" required>
                    <input type="text" name="department" id="department" placeholder="User Department" required>
                    <select name="userType" id="userType" require>
                        <option value="user">User</option>
                        <option value="chair">Chair</option>
                        <option value="admin">Admin</option>
                    </select>
                    <input type="submit" value="Add User" id="addNewUser">
                </form>
            </div>

            <div class="header">
                <h2>Data Back-Ups</h2>
            </div>

            <!---------survey info file row------------>
            <div class="row row3">

                <button class="Bfloatright fButton" onclick="getBackupFile()">Save data to Back-up file</button>

                <button class="Bfloatright fButton" onclick="showBackUpFilesPopupWindow()">Restore Database from Back-Up file</button>

            </div>
        </div>

    </div>



</body>

</html>