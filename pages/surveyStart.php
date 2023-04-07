<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>

    <!--Links to stylesheets-->
    <link rel="stylesheet" href="../fonts/arial-nova/stylesheet.css">
    <link rel="stylesheet" href="../styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/surveyStart.css">
    
    <script src="../scripts/surveyStart.js"></script>

</head>

<body>

    <!-------------------------- Navigation section------------------------- -->
    <?php
        include('Navigation.php');
    ?>
    <!----------------------------- Main section -------------------------------->

    <!-- Container div to act as grid template -->
    <div class="container">

        <!-- About plan section -->
        <div class="about insidebox">

            <h1 class="sectionheader">Science Strategic Plan</h1>
            <p>
                Thanks for your participation, the only time constraint for this survey is the due date, otherwise you can answer the questions <br>
                at any moment, all your progress will be automatically saved and you can come back to it at any time you like. <br><br>
                The survey is designed to take a total of 10 minutes. <br><br>
            </p>

            <p id="date">Due date: Friday, 03 February 2023</p>


        </div>


        <!-- Status section -->
        <div class="status insidebox">
            <h6 class="sectionheader2">Status</h6>
            <p id ="status">No attempts have been made yet</p>

        </div>

        <!-- Progress section -->
        <div class="progress insidebox">
            <h6 class="sectionheader2">Progress</h6>
            <p id="progress">0%</p>
        </div>


        <!-- Begin section -->
        <div class="begin insidebox">

            <button id="beginQbutton" onclick="BeginSurvey()">Begin Questionarie</button>

        </div>
    </div>


        
<form method='post' action='Controller.php' id='BeginSurvey' style='display:none'>
    <input type='hidden' name='page' value='SuveryStart'>
    <input type='hidden' name='command' value='StartSurvey'>
</form>





</body>

</html>