

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
    <link rel="stylesheet" href="../styles/PastSurveyReport.css">

</head>

<body>

    <!-- Navigation section -->
    <nav>
        <img src="../images/LOGOS/TRU-LG02.png" alt="logo">
        <ul>
            <li><a href="http://"><img src="../images/icons/notifications.png" alt="notifications" class="icon"></a></li>
            <li><a href="http://"><img src="../images/icons/message.png" alt="messages" class="icon"></a></li>
            <li><a href="http://"><span><?php echo $_SESSION['userFirstName'];?></span> <span><?php echo $_SESSION['userLastName']; ?></span></a></li>
            <li><a href="http://"><img src="../images/icons/menu.png" alt="menu" class="icon"></a>
                <ul>
                    <li><a href="">Dashboard</a></li>
                    <li><a href="">Survey</a></li>
                    <li><a href="">Log Out</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="pastReports">
        <p class="headers">Science Strategic Plan 2023</p>
        <div class="pastDocuments" id="documents-pane">
            <?php
                if (!empty($result))
                    echo $result;
            ?>
        </div>
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