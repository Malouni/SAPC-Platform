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

    <script src="../scripts/Navigation.js"></script>

</head>

<body>

    <!-------------------------- Navigation section------------------------- -->
    <?php
        include('Navigation.php');
    ?>
    <!----------------------------- Main section -------------------------------->


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