<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>

    <!--Links to stylesheets-->
    <link rel="stylesheet" href="/fonts/arial-nova/stylesheet.css">
    <link rel="stylesheet" href="/styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/surveyStart.css">

    <script src="../scripts/hideShowScripts.js"></script>


</head>

<body>

    <!-------------------------- Navigation section------------------------- -->
    <nav>
        <img src="../images/LOGOS/TRU-LG02.png" alt="logo">
        <ul>
            <li><button onclick="hideShowNotifications()"><img src="../images/icons/notifications.png" alt="notifications" class="icon"></button></li>
            <li><button onclick="hideShowMessages()"><img src="../images/icons/message.png" alt="messages" class="icon"></button></li>
            <li><span id="username">Alexander </span><span id="userlastname">Ramirez </span></li>
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
                Due date: Friday, 03 February 2023
            </p>

        </div>


        <!-- Status section -->
        <div class="status insidebox">
            <h6 class="sectionheader2">Status</h6>
            <p>No attempts have been made yet</p>

        </div>

        <!-- Progress section -->
        <div class="progress insidebox">
            <h6 class="sectionheader2">Progress</h6>
            <p>0%</p>

        </div>


        <!-- Begin section -->
        <div class="begin insidebox">

            <button id="beginQbutton">Begin Questionarie</button>

        </div>
    </div>




</body>

</html>