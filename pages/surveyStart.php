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


</head>

<body>

    <!-------------------------- Navigation section------------------------- -->
    <nav>
        <img src="../images/LOGOS/TRU-LG02.png" alt="logo">
        <ul>
            <li><a href="http://"><img src="../images/icons/notifications.png" alt="notifications" class="icon"></a></li>
            <li><a href="http://"><img src="../images/icons/message.png" alt="messages" class="icon"></a></li>
            <li><a href="http://"><span><?php echo $_SESSION['userimage']; ?></span> <span>UserLastname</span></a></li>
            <li><a href="http://"><img src="../images/icons/menu.png" alt="menu" class="icon"></a>
                <ul>
                    <li><a href="">Dashboard</a></li>
                    <li><a href="">Survey</a></li>
                    <li><a href="">Log Out</a></li>
                </ul>
            </li>
        </ul>
    </nav>

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