<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>


    <!-- links to stylesheets -->
    <link rel="stylesheet" href="/fonts/arial-nova/stylesheet.css">
    <link rel="stylesheet" href="/styles/generalStyles.css">
    <link rel="stylesheet" href="/styles/dashboardstyles.css">

    <!-- links to scripts -->
    <script src="../scripts/MainPage.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>

<body>

    <!-------------------------- Navigation section------------------------- -->
    <?php
    require('Navigation.php');
    ?>
    <!----------------------------- Main section -------------------------------->

    <!-- Container div to act as grid template -->
    <div class="container">

        <!-- About plan section -->
        <div class="about insidebox">

            <h1 class="sectionheader">Science Strategic Plan</h1>
            <div class="flexbox">
                <p>
                    In September 2021 the Faculty of Science committed to a Strategic Academic Plan for 2021-2026.<br><br>
                    The Plan details can be found on our webpage
                    <a href="https://www.tru.ca/science/about/Strategic_Plan.html">https://www.tru.ca/science/about/Strategic_Plan.html</a>.<br><br>
                    The purpose of this survey is to collect data concerning our
                    achievements related to the Strategic Academic Plan that are individual in nature.
                    Having said that, no individual results will be shared with aggregated results
                    being used to track and monitor the success of the Faculty of Science in meeting
                    its commitment to the planning goals and objectives.<br><br>
                    This survey should only take ten minutes of your time.<br><br>
                    Should you have any questions, please contact the Dean at <a href="mailto: ganderson@tru.ca">ganderson@tru.ca</a>
                </p>


                <!-- video container frame // link is to be updated -->
                <iframe src="https://www.youtube.com/embed/XIMLoLxmTDw" title="About the survey" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

            </div>

        </div>
        <!-- Upcoming section -->
        <div class="upcoming insidebox" id="upcoming-pane">
            <?php
            if (!empty($result))
                echo $result;
            ?>
        </div>

        <!-- History section -->
        <div class="history insidebox" id="history-pane">
            <?php
            if (!empty($result))
                echo $result;
            ?>
        </div>
    </div>



    
<form method='post' action='Controller.php' id='surveystart' style='display:none'>
    <input type='hidden' name='page' value='MainPage'>
    <input type='hidden' name='command' value='upcomingSurveysID'>
    <input type='hidden' id='upcomingSurveyID' name='ID' value='0'>
</form>

    
<form method='post' action='Controller.php' id='HistoryView' style='display:none'>
    <input type='hidden' name='page' value='MainPage'>
    <input type='hidden' name='command' value='HistorySurveysID'>
    <input type='hidden' id='HSurveyID' name='P_ID' value='0'>
</form>



</body>

</html>