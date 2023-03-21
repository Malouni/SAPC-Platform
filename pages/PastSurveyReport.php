<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>

    <!-- links to stylesheets -->
    <link rel="stylesheet" href="/fonts/arial-nova/stylesheet.css">
    <link rel="stylesheet" href="/styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/PastSurveyReport.css">

    <script src="../scripts/PastSurveyReport.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>

<body>

    <!-------------------------- Navigation section------------------------- -->
    <?php
        include('Navigation.php');
    ?>
    <!----------------------------- Main section -------------------------------->


    <div class="pastReports">
        <p class="headers">Science Strategic Plan 2023</p>
        <div class="pastDocuments" id="documents-pane">
            <?php
                if (!empty($result))
                    echo $result;
            ?>
        </div>

        <!--------------Goals tabs---------------->
        <p class="headers">Goals</p>
        <table class="tableGoals">
            <tr class="rowGoals">
                <th class="gridGoals"><button class="buttonGoals" onclick="diel_goal_show()" id="DIELbutton">Diverse, Inclusive & Equitable Learning</button></th>
                <th class="gridGoals"><button class="buttonGoals" onclick="sppb_goal_show()"  id="SPbutton">Sustainable practice to promote well being</button></th>
                <th class="gridGoals"><button class="buttonGoals" onclick="ttl_goal_show()" id="TTLbutton">Transformational Teaching & Learning</button></th>
                <th class="gridGoals"><button class="buttonGoals" onclick="tc_goal_show()"  id="TCbutton">Transformation Communities</button></th>
                <th class="gridGoals"><button class="buttonGoals" onclick="gcd_goal_show()" id="GSDbutton">Guided skill development</button></th>
            </tr>
        </table>
        <div class="report" id="report-pane">
            <?php
                if (!empty($result))
                    echo $result;
            ?>
        </div>

    </div>



</body>

</html>