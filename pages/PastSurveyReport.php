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
        <p class="headers">Science Strategic Plan 2023</p>
        <div class="pastDocuments">
            <div class="document">
                <table>
                    <tr class="rowDocuments">
                        <td class="gridDocuments"><p class="document">Documents</p></td>
                    </tr>
                    <tr class="rowDocuments">
                        <td class="gridDocuments"><p class="date">Friday, 3 February 2022</p></td>
                    </tr>
                    <tr class="rowDocuments">
                        <td class="gridDocuments"><p class="SPRtext"> Strategic Plan Report (2022)</p> </td>
                        <td><button src="images/icons/pdf.png" class="pdf"> </button> <button src="images/icons/downloadpdf.png" class="pdf"> </button> </td>
                    </tr>
                    <tr class="rowDocuments">
                        <td class="gridDocuments"><p class="facility">Facility of Science</p></td>
                    </tr>
                </table>
            </div>
        </div>
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
        <div class="report">
            <p class="headers">Diverse, Inclusive & Equitable Learning</p>
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
                <tr>
                    <td><button src="images/icons/pdf.png" class="pdf"></button><button src="images/icons/pdf.png" class="pdf"></button><button src="images/icons/pdf.png" class="pdf"></button></td>
                </tr>
            </table>

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
        </div>



    </div>



</body>

</html>