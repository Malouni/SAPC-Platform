<?php

?>

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

    <script src="../scripts/PastSurveyReport.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>

<body>

    <!-- Navigation section -->
    <!-------------------------- Navigation section------------------------- -->
    <nav>
        <img src="../images/LOGOS/TRU-LG02.png" alt="logo">
        <ul>
            <li><button onclick="hideShowNotifications()"><img src="../images/icons/notifications.png" alt="notifications" class="icon"></button></li>
            <li><button onclick="hideShowMessages()"><img src="../images/icons/message.png" alt="messages" class="icon"></button></li>
            <li><span id="username"><?php echo $_SESSION['userFirstName'];?></span><span id="userlastname"><?php echo $_SESSION['userLastName']; ?></span></li>
            <li><button onclick="hideShowMenu()"><img src="../images/icons/menu.png" alt="menu" class="icon"></button></li>
        </ul>
    </nav>
    <div class="submenu" id="sidemenu">
        <button class="closebutton" onclick="hideShowMenu()">X</button>
        <ul>
            <li><a href="Index.php">
                    <p>Dashboard</p>
                </a></li>
            <li><a href="surveyStart.php">
                    <p>Survey</p>
                </a></li>
            <li><a href="PastSurveyReport.php">
                    <p>Current Report</p>
                </a></li>
            <li><a href="Loginpage.php">
                    <p>Log Out</p>
                </a></li>
        </ul>
    </div>

    <div class="textsubmenu" id="subMessages">
        <button class="closebutton" onclick="hideShowMessages()">X</button>
        <p>Messages</p>
        <div class="messagescontainer">
            <p>No messages yet</p>
        </div>
        <form action="sendMessage.php">
            <input type="text" placeholder="Send message to admin">
            <button type="submit"> Send Message</button>
        </form>

    </div>

    <div class="notsubmenu" id="subNotifications">
        <button class="closebutton" onclick="hideShowNotifications()">X</button>
        <p>Notifications</p>
        <div class="messagescontainer">
            <p>No notifications yet</p>
        </div>
    </div>

    <!----------------------Main content----------------------------->


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