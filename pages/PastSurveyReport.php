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
    <link rel="stylesheet" href="../fonts/arial-nova/stylesheet.css">
    <link rel="stylesheet" href="../styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/PastSurveyReport.css">

    <script src="../scripts/PastSurveyReport.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../scripts/chart.js"></script>

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

        <!--------------Graphs container---------------->
        <div class="graphs">

            <!--------------Circular graph container---------------->
            <div class="circular-graph metrics">
                <svg class="progress-circle" viewBox="0 0 100 100">
                    <circle class="circle-track" cx="50" cy="50" r="45"></circle>
                    <circle class="circle-progress" cx="50" cy="50" r="45"></circle>
                </svg>
                <div class="progress-text">
                    <span class="progress-percentage">0%</span>
                </div>
            </div>

            <!--------------Line graph container---------------->
            <div class="line-chart metrics">
                <canvas id="lineChart"></canvas>
            </div>

            <script>
                calculateGraph(0 , 0 , 0 ,0 , 0 ,0);       
            </script>
        </div>

        <!--------------Goals tabs---------------->
        <p class="headers">Goals</p>
        <table class="tableGoals">
            <tr class="rowGoals">
                <th class="gridGoals"><button class="buttonGoals" onclick="diel_goal_show()" id="DIELbutton">Diverse, Inclusive & Equitable Learning</button></th>
                <th class="gridGoals"><button class="buttonGoals" onclick="sppb_goal_show()" id="SPbutton">Sustainable practice to promote well being</button></th>
                <th class="gridGoals"><button class="buttonGoals" onclick="ttl_goal_show()" id="TTLbutton">Transformational Teaching & Learning</button></th>
                <th class="gridGoals"><button class="buttonGoals" onclick="tc_goal_show()" id="TCbutton">Transformation Communities</button></th>
                <th class="gridGoals"><button class="buttonGoals" onclick="gcd_goal_show()" id="GSDbutton">Guided skill development</button></th>
            </tr>
        </table>
        <div class="cover-pic"></div>
        <div class="report" id="report-pane">
            <?php
            if (!empty($result))
                echo $result;
            ?>
        </div>

    </div>

        
    <form method='post' action='Controller.php' id='GetPDF' style='display:none'>
        <input type='hidden' name='page' value='PastReport'>
        <input type='hidden' name='command' value='GetPDFReport'>
        <input type='hidden' id = 'PDFID' name='PDF_ID' value='0'>
    </form>



</body>

</html>