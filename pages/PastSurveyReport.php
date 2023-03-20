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

    <script src="../scripts/hideShowScripts.js"></script>

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

        <!---------info section--------->
        <p class="headers">Science Strategic Plan <span class="year">2023<span></p>
        <div class="pastDocuments">
            <div class="document">
                <table>
                    <tr class="rowDocuments">
                        <td class="gridDocuments">
                            <p class="document">Documents</p>
                        </td>
                    </tr>
                    <tr class="rowDocuments">
                        <td class="gridDocuments">
                            <p class="date">Friday, 3 February 2022</p>
                        </td>
                    </tr>
                    <tr class="rowDocuments">
                        <td class="gridDocuments">
                            <p class="SPRtext"> Strategic Plan Report (2022)</p>
                        </td>
                        <td><button class="pdf"><img src="../images/icons/pdf.png" alt="pdf" class="icon"></button></td>
                    </tr>
                    <tr class="rowDocuments">
                        <td class="gridDocuments">
                            <p class="facility">Facility of Science</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!--------------Goals tabs---------------->
        <p class="headers">Goals</p>
        <table class="tableGoals">
            <tr class="rowGoals">
                <th class="gridGoals"><button class="buttonGoals" id="DIELbutton">Diverse, Inclusive & Equitable Learning</button></th>
                <th class="gridGoals"><button class="buttonGoals" id="SPbutton">Sustainable practice to promote well being</button></th>
                <th class="gridGoals"><button class="buttonGoals" id="TTLbutton">Transformational Teaching & Learning</button></th>
                <th class="gridGoals"><button class="buttonGoals" id="TCbutton">Transformation Communities</button></th>
                <th class="gridGoals"><button class="buttonGoals" id="GSDbutton">Guided skill development</button></th>
            </tr>
        </table>
        <div id="coverpattern"></div>

        <!---------------------------DIEL report--------------------------------->
        <div class="report" id="DIEL-R">
            <p class="headers">Fostering diverse, inclusive and equitable learning and working environments</p>
            <!--------------------SubGoal1------------------------>
            <p class="headers">Inclusion and Diversity</p>
            <p class="regularText">Ensure the staff and facility compliment is equitable, diverse and inclusive</p>
            <table class="tablePastReport">
                <tr class="rowPastReport">
                    <th class="headerActivity">Activity</th>
                    <th class="headerRest">Involvement</th>
                    <th class="headerRest">Historical</th>
                </tr>
                <tr class="rowPastReport">
                    <td class="gridActivity">Indigenous presenters in classroom</td>
                    <td class="gridRest">3</td>
                    <td class="gridRest">+2</td>
                </tr>
                <tr class="rowPastReport">
                    <td class="gridActivity"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                </tr>
                <tr class="rowPastReport">
                    <td class="gridActivity"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                </tr>
                <!--add php code for adding a new row-->
            </table>

            <!--------------------SubGoal2------------------------>
            <p class="headers">Community mindedness</p>
            <p class="regularText">Promote, support and strengthen a respectful, inclusive, equitable and welcoming culture for all faculty, staff and students</p>

            <table class="tablePastReport">
                <tr class="rowPastReport">
                    <th class="headerActivity">Activity</th>
                    <th class="headerRest">Involvement</th>
                </tr>
                <tr class="rowPastReport">
                    <td class="gridActivity"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                </tr>
                <tr class="rowPastReport">
                    <td class="gridActivity"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                </tr>
                <tr class="rowPastReport">
                    <td class="gridActivity"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                </tr>
            </table>

            <!--------------------SubGoal3------------------------>
            <p class="headers">Curiosity</p>
            <p class="regularText">Foster an environment that encourages interaction and shows respect to Indigenous learning and knowledge</p>

            <table class="tablePastReport">
                <tr class="rowPastReport">
                    <th class="headerActivity">Activity</th>
                    <th class="headerRest">Involvement</th>
                </tr>
                <tr class="rowPastReport">
                    <td class="gridActivity"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                </tr>
                <tr class="rowPastReport">
                    <td class="gridActivity"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                </tr>
                <tr class="rowPastReport">
                    <td class="gridActivity"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                </tr>
            </table>

            <!--------------------SubGoal4------------------------>
            <p class="headers">Sustainability</p>
            <p class="regularText">Eliminate achievement gaps for marginalized students</p>

            <table class="tablePastReport">
                <tr class="rowPastReport">
                    <th class="headerActivity">Activity</th>
                    <th class="headerRest">Involvement</th>
                </tr>
                <tr class="rowPastReport">
                    <td class="gridActivity"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                </tr>
                <tr class="rowPastReport">
                    <td class="gridActivity"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                </tr>
                <tr class="rowPastReport">
                    <td class="gridActivity"> &nbsp; </td>
                    <td class="gridRest"> &nbsp; </td>
                </tr>
            </table>
        </div>

       




    </div>



</body>

</html>