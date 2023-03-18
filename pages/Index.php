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
    <link rel="stylesheet" href="/styles/dashboardstyles.css">

    <script>
        function hideShowMenu() {
            var subMenu = document.getElementById("sidemenu");
            if(subMenu.style.display == "block"){
                subMenu.style.display = "none";
            }
            else{
                subMenu.style.display = "block";
            }
        }

        function hideShowMessages() {
            var subMessages = document.getElementById("subMessages");
            if(subMessages.style.display == "block"){
                subMessages.style.display = "none";
            }
            else{
                subMessages.style.display = "block";
            }
        }

        function hideShowNotifications() {
            var subMessages = document.getElementById("subNotifications");
            if(subMessages.style.display == "block"){
                subMessages.style.display = "none";
            }
            else{
                subMessages.style.display = "block";
            }
        }
    </script>




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

        <!-- Timeline section -->
        <div class="timeline insidebox">
            <h1 class="sectionheader">Timeline</h1>
            <!--buttons container-->
            <div>
                <button class="sectionButton"><img src="../images/icons/timemenu.png" alt="order by time"></button>
                <button class="sectionButton sectionButton2"><img src="../images/icons/ordermenu.png" alt="order by "></button>
            </div>
            <!-- Due list container // list items are to be added according to items in database-->
            <ul id="TimelineDueList">
                <li>
                    <a href="">
                        <ul>
                            <li class="date">
                                <h2>Friday, 3 March 2023</h2>
                            </li>
                            <li class="item"><span>Strategic Plan Survey 2023</span>is due <span class="time">00:00</span></li>
                            <li class="faculty">Faculty of Science</li>
                        </ul>
                    </a>
                </li>
                <li>
                    <a href="">
                        <ul>
                            <li class="date">
                                <h2>Friday, 3 March 2023</h2>
                            </li>
                            <li class="item"><span>Strategic Plan Survey 2023</span>is due <span class="time">00:00</span></li>
                            <li class="faculty">Faculty of Science</li>
                        </ul>
                    </a>
                </li>
                <li>
                    <a href="">
                        <ul>
                            <li class="date">
                                <h2>Friday, 3 March 2023</h2>
                            </li>
                            <li class="item"><span>Strategic Plan Survey 2023</span>is due <span class="time">00:00</span></li>
                            <li class="faculty">Faculty of Science</li>
                        </ul>
                    </a>
                </li>
                <li>
                    <a href="">
                        <ul>
                            <li class="date">
                                <h2>Friday, 3 March 2023</h2>
                            </li>
                            <li class="item"><span>Strategic Plan Survey 2023</span>is due <span class="time">00:00</span></li>
                            <li class="faculty">Faculty of Science</li>
                        </ul>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Upcoming section -->
        <div class="upcoming insidebox">
            <h1 class="sectionheader">Upcoming</h1>
            <div class="activity">
                <img src="../images/cover-textures/1.png" alt="cover">
                <p class="title">Faculty of Science<br><span>Strategic Plan Survey</span></p>
                <button class="options">...</button>
                <div class="meter"></div>
            </div>
            <div class="activity">
                <img src="../images/cover-textures/2.png" alt="cover">
                <p class="title">Faculty of Science<br><span>Strategic Plan Survey</span></p>
                <button class="options">...</button>
                <div class="meter"></div>
            </div>

        </div>

        <!-- History section -->
        <div class="history insidebox">
            <h1 class="sectionheader">History</h1>
            <div class="activity">
                <img src="../images/cover-textures/3.png" alt="cover">
                <p class="title">Faculty of Science<br><span>Strategic Plan Survey</span></p>
                <button class="options">...</button>
                <div class="meter"></div>
            </div>
            <div class="activity">
                <img src="../images/cover-textures/4.png" alt="cover">
                <p class="title">Faculty of Science<br><span>Strategic Plan Survey</span></p>
                <button class="options">...</button>
                <div class="meter"></div>
            </div>
            <div class="activity">
                <img src="../images/cover-textures/5.png" alt="cover">
                <p class="title">Faculty of Science<br><span>Strategic Plan Survey</span></p>
                <button class="options">...</button>
                <div class="meter"></div>
            </div>
        </div>


        <!-- Documents section -->
        <div class="documents insidebox">
            <h1 class="sectionheader">Documents</h1>
            <!--buttons container-->
            <div>
                <button class="sectionButton"><img src="../images/icons/timemenu.png" alt="order by time"></button>
                <button class="sectionButton sectionButton2"><img src="../images/icons/ordermenu.png" alt="order by "></button>
            </div>
            <ul id="DocumentList">
                <li>
                    <a href="">
                        <ul>
                            <li class="date">
                                <h2>Friday, 3 March 2023</h2>
                            </li>
                            <li class="item"><span>Strategic Plan Survey 2023</span>is due <span class="pdflink"><button><img src="../images/icons/downloadpdf.png" alt=""></button></span></li>
                            <li class="faculty">Faculty of Science</li>
                        </ul>
                    </a>
                </li>
        </div>
    </div>





</body>

</html>