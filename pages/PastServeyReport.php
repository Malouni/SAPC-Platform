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
    <link rel="stylesheet" href="../styles/PastServeyReport.css">

    


</head>

<body>

    <!-- Navigation section -->
    <nav>
        <img src="images/LOGOS/TRU-LG02.png" alt="logo">
        <ul>
            <li><a href="http://"><img src="images/icons/notifications.png" alt="notifications" class="icon"></a></li>
            <li><a href="http://"><img src="images/icons/message.png" alt="messages" class="icon"></a></li>
            <li><a href="http://"><span>UserName</span> <span>UserLastname</span></a></li>
            <li><a href="http://"><img src="images/icons/menu.png" alt="menu" class="icon"></a>
                <ul>
                    <li><a href="">Dashboard</a></li>
                    <li><a href="">Survey</a></li>
                    <li><a href="">Log Out</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="pastReports">
        <h3>Science Strategic Plan 2023</h3>
        <div class="pastDocuments">
            <div class="document">
                <table>
                    <tr class="rowDocuments">
                        <td class="gridDocuments"><p>Documents</p></td>
                    </tr>
                    <tr class="rowDocuments">
                        <td class="gridDocuments"><p>Friday, 3 February 2022</p></td>
                    </tr>
                    <tr class="rowDocuments">
                        <td class="gridDocuments"><a href="" style="margin-right: 30px;"> Strategic Plan Report (2022)</a> <button src="images/icons/pdf.png" class="pdf"> </button> <button src="images/icons/downloadpdf.png" class="pdf"> </button> </td>
                    </tr>
                    <tr class="rowDocuments">
                        <td class="gridDocuments"><p>Facility of Science</p></td>
                    </tr>
                </table>
            </div>
        </div>
        <h3 class="textGoals">Goals</h3>
        <table class="tableGoals">
            <tr class="rowGoals">
                <th class="gridGoals"><button class="buttonGoals" id="DIELbutton">Diverse, Inclusive & Equitable Learning</button></th>
                <th class="gridGoals"><button class="buttonGoals" id="SPbutton">Sustainable practice to promote well being</button></th>
                <th class="gridGoals"><button class="buttonGoals" id="TTLbutton">Transformational Teaching & Learning</button></th>
                <th class="gridGoals"><button class="buttonGoals" id="TCbutton">Transformation Communities</button></th>
                <th class="gridGoals"><button class="buttonGoals" id="GSDbutton">Guided skill development</button></th>
            </tr>
        </table>
        <div class="report">

        </div>



    </div>



</body>

</html>