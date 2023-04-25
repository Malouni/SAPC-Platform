document.addEventListener("DOMContentLoaded", function(){
    $('#reportGraphs').hide();
    show_survey_documents();
    disable_goal_buttons();
});

//Global variables
var detailedReport = false;
var currentGoalDetailed ="";
var currentUserNumber = null;
var FirstTimeChooseDetailedReport = true;

function show_survey_documents() {
    var url = 'Controller.php';

    var query = {page: 'PastReport', command: 'SurveyDocuments'};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        
        var documents = "";
        if(result == "No Data")
        {
            documents +="<div class='document'>";
            documents +="<table>";
            documents +="<tr class='rowDocuments'>";
            documents +="<td class='gridDocuments'><p class='document'>No data found</p></td>";
            documents +="</tr>";
            documents +="</table>";
            documents +="</div>";
        }
        else
        {
            for (var row = 0; row < result.length; row++) {

                documents += "<div class='document'>";
                documents += "<table>";
                documents += "<tr class='rowDocuments'>";
                documents += "<td class='gridDocuments'><p class='document'>Document</p></td>";
                documents += "</tr>";
                documents += "<tr class='rowDocuments'>";
                documents += "<td class='gridDocuments'><p class='date'>" + result[row]['SurvYear'] + "</p></td>";
                documents += "</tr>";
                documents += "<tr class='rowDocuments'>";
                documents += "<td class='gridDocuments'><p class='SPRtext'>" + result[row]['SurvName'] + "</p> </td>";
                documents += "<td>";
                documents += "<button src='../images/icons/pdf.png' class='pdf' title='Average report' button-document-show-average-id = '" + result[row]['SurvID'] + "'> </button>";
                documents += "<button src='../images/icons/pdf.png' class='pdf' title='Detailed report' button-document-show-detailed-id = '" + result[row]['SurvID'] + "'> </button>";
                documents += "<button src='../images/icons/downloadpdf.png' class='pdf' title='Download Average report PDF' button-document-download-id = '" + result[row]['SurvID'] + "'> </button>";
                documents += "</td>";
                documents += "</tr>";
                documents += "<tr class='rowDocuments'>";
                documents += "<td class='gridDocuments'><p class='facility'>Facility of Science</p></td>";
                documents += "</tr>";
                documents += "</table>";
                documents += "</div>";
            }
        }

        $('#documents-pane').html(documents);

        $('td > button[button-document-show-average-id]').click(function() {
            var id = $(this).attr('button-document-show-average-id');
            set_current_document(id);
            $('#reportGraphs').show();
            enable_goal_buttons();
            currentUserNumber = null;
            detailedReport = false;
            diel_goal_show();
        });

        $('td > button[button-document-show-detailed-id]').click(function() {
            var id = $(this).attr('button-document-show-detailed-id');
            set_current_document(id);
            $('#reportGraphs').hide();
            enable_goal_buttons();
            currentUserNumber = null;
            detailedReport = true;
            FirstTimeChooseDetailedReport = true;
            diel_goal_show();
        });

        $('td > button[button-document-download-id]').click(function() {
            var id = $(this).attr('button-document-download-id');
            document.getElementById("PDFID").value = id;
            $('#GetPDF').submit();
        });
    });

}

function show_survey_goal_chosen(goal) {
    var url = 'Controller.php';

    var query = {page: 'PastReport', command: 'SurveyActivityGoal', goal: ''+goal+''};

    $.post(url, query, function(data) {

        var result = JSON.parse(data);
        //alert(result.length);
        if(result == "No Data")
        {
            var tables = "<p class='headers'>No data found</p>";
            updateCircularProgressBar(0);
        }
        else
        {
            if(result[0]['Goal'] == "DIEL")
                var tables = "<p class='headers'>Diverse, Inclusive & Equitable Learning</p>";
            else if(result[0]['Goal'] == "SPP")
                var tables = "<p class='headers'>Sustainable practice to promote well being</p>";
            else if(result[0]['Goal'] == "TTL")
                var tables = "<p class='headers'>Transformational Teaching & Learning</p>";
            else if(result[0]['Goal'] == "TC")
                var tables = "<p class='headers'>Transformation Communities</p>";
            else if(result[0]['Goal'] == "GSD")
                var tables = "<p class='headers'>Guided skill development</p>";

            for(var row = 0; row < result.length; row++)
            {
                if(row == 0)
                {
                    if(result[row]['SubGoal'] == "I&D")
                        tables += "<p class='headers'>Inclusion & Diversity</p>";
                    else if(result[row]['SubGoal'] == "CM")
                        tables += "<p class='headers'>Community mindedness</p>";
                    else if(result[row]['SubGoal'] == "C")
                        tables += "<p class='headers'>Curiosity</p>";
                    else if(result[row]['SubGoal'] == "S")
                        tables += "<p class='headers'>Sustainability</p>";

                    tables += "<table class='tablePastReport'>";
                    tables += "<tr class='rowPastReport'>";
                    tables += "<th class='headerActivity'>Activity</th>";
                    tables += "<th class='headerRest'>Involvement</th>";
                    tables += "<th class='headerRest'>Historical</th>";
                    tables += "</tr>";
                }
                else if(result[row-1]['SubGoal'] != result[row]['SubGoal'])
                {
                    if(result[row]['SubGoal'] == "I&D")
                        tables += "<p class='headers'>Inclusive & Diversity</p>";
                    else if(result[row]['SubGoal'] == "CM")
                        tables += "<p class='headers'>Community mindedness</p>";
                    else if(result[row]['SubGoal'] == "C")
                        tables += "<p class='headers'>Curiosity</p>";
                    else if(result[row]['SubGoal'] == "S")
                        tables += "<p class='headers'>Sustainability</p>";

                    tables += "<table class='tablePastReport'>";
                    tables += "<tr class='rowPastReport'>";
                    tables += "<th class='headerActivity'>Activity</th>";
                    tables += "<th class='headerRest'>Involvement</th>";
                    tables += "<th class='headerRest'>Historical</th>";
                    tables += "</tr>";
                }

                if(result[row]['Type'] == 'composed')
                {
                    var composedMainQuestion = true;
                    for(var composedQuestion = row; ;composedQuestion++)
                    {
                        if(composedMainQuestion)
                        {
                            tables += "<tbody class='composedQuestion'>";
                            tables += "<tr class='rowPastReportSingle'>";
                            tables += "<td class='gridComposedActivity' colspan='3'>" + result[composedQuestion]['Question'] + "</td>";
                            tables += "</tr>";
                            tables += "<tr class='rowPastReportComposed'>";
                            tables += "<td class='gridActivitySubQuestion'>" + result[composedQuestion]['Sub_Q'] + "</td>";
                            tables += "<td class='gridRest'>" + result[composedQuestion]['Activity_Involvement'] + "</td>";
                            tables += "<td class='gridRest'>"+ result[composedQuestion]['Activity_Historical'] +"</td>";
                            tables += "</tr>";
                            composedMainQuestion = false;
                        }
                        else
                        {
                            tables += "<tr class='rowPastReportComposed'>";
                            tables += "<td class='gridActivitySubQuestion'>" + result[composedQuestion]['Sub_Q'] + "</td>";
                            tables += "<td class='gridRest'>" + result[composedQuestion]['Activity_Involvement'] + "</td>";
                            tables += "<td class='gridRest'>"+ result[composedQuestion]['Activity_Historical'] +"</td>";
                            tables += "</tr>";
                        }
                        //alert(composedQuestion);
                        if(composedQuestion == result.length -1)
                        {
                            row = composedQuestion;
                            break;
                        }
                        else if(result[composedQuestion]['Type'] != result[composedQuestion+1]['Type'])
                        {
                            row = composedQuestion;
                            break;
                        }else if(result[composedQuestion]['SubGoal'] != result[composedQuestion+1]['SubGoal'])
                        {
                            row = composedQuestion;
                            break;
                        }else if(result[composedQuestion]['QuestionID'] != result[composedQuestion+1]['QuestionID'])
                        {
                            row = composedQuestion;
                            break;
                        }
                    }
                    composedMainQuestion = true;
                    tables += "</tbody>";
                }
                else
                {
                    tables += "<tr class='rowPastReportSingle'>";
                    tables += "<td class='gridActivity'>" + result[row]['Question'] + "</td>";
                    tables += "<td class='gridRest'>" + result[row]['Activity_Involvement'] + "</td>";
                    tables += "<td class='gridRest'>"+ result[row]['Activity_Historical'] +"</td>";
                    tables += "</tr>";
                }
                if(row == result.length -1)
                {
                    tables += "</table>";
                }
                else if(result[row]['SubGoal'] != result[row+1]['SubGoal'])
                {
                    tables += "</table>";
                }
            }
            var progress = result[0]['Answer_Percentage'];
            updateCircularProgressBar(progress);
        }
        $('#report-pane').html(tables);
    });

}

function show_survey_goal_detailed() {
    var url = 'Controller.php';

    var query = {page: 'PastReport', command: 'SurveyActivityDetailedGoal', goal: ''+currentGoalDetailed+'', userNumber:currentUserNumber};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        var tables;
        tables = "<button class='searchUser' onclick='showUserSearchPopupWindow();'>Search by user <div id='searchicon'></div></button>";
        if(FirstTimeChooseDetailedReport)
        {
            tables += "<p class='headers'>Please select user</p>";
        }
        else if(result == "No Data")
        {
            tables += "<p class='headers'>No data found</p>";
        }
        else
        {
            if(result[0]['Goal'] == "DIEL")
                tables += "<p class='headers'>Diverse, Inclusive & Equitable Learning</p>";
            else if(result[0]['Goal'] == "SPP")
                tables += "<p class='headers'>Sustainable practice to promote well being</p>";
            else if(result[0]['Goal'] == "TTL")
                tables += "<p class='headers'>Transformational Teaching & Learning</p>";
            else if(result[0]['Goal'] == "TC")
                tables += "<p class='headers'>Transformation Communities</p>";
            else if(result[0]['Goal'] == "GSD")
                tables += "<p class='headers'>Guided skill development</p>";

            for(var row = 0; row < result.length; row++)
            {
                if(row == 0)
                {
                    if(result[row]['SubGoal'] == "I&D")
                        tables += "<p class='headers'>Inclusion & Diversity</p>";
                    else if(result[row]['SubGoal'] == "CM")
                        tables += "<p class='headers'>Community mindedness</p>";
                    else if(result[row]['SubGoal'] == "C")
                        tables += "<p class='headers'>Curiosity</p>";
                    else if(result[row]['SubGoal'] == "S")
                        tables += "<p class='headers'>Sustainability</p>";

                    tables += "<table class='detailedReportTable'>";
                    tables += "<tr>";
                    tables += "<th class='otherHeaders'>First Name</th>";
                    tables += "<th class='otherHeaders'>Last Name</th>";
                    tables += "<th class='otherHeaders'>Question</th>";
                    tables += "<th class='subQuestionColumn'>Sub Question</th>";
                    tables += "<th class='answerColumnHeader'>Answer</th>";
                    tables += "<th class='commentHeader'>Comment</th>";
                    tables += "</tr>";
                }
                else if(result[row-1]['SubGoal'] != result[row]['SubGoal'])
                {
                    if(result[row]['SubGoal'] == "I&D")
                        tables += "<p class='headers'>Inclusive & Diversity</p>";
                    else if(result[row]['SubGoal'] == "CM")
                        tables += "<p class='headers'>Community mindedness</p>";
                    else if(result[row]['SubGoal'] == "C")
                        tables += "<p class='headers'>Curiosity</p>";
                    else if(result[row]['SubGoal'] == "S")
                        tables += "<p class='headers'>Sustainability</p>";

                    tables += "<table class='detailedReportTable'>";
                    tables += "<tr>";
                    tables += "<th class='otherHeaders'>First Name</th>";
                    tables += "<th class='otherHeaders'>Last Name</th>";
                    tables += "<th class='otherHeaders'>Question</th>";
                    tables += "<th class='subQuestionColumn'>Sub Question</th>";
                    tables += "<th class='answerColumnHeader'>Answer</th>";
                    tables += "<th class='commentHeader'>Comment</th>";
                    tables += "</tr>";
                }

                if(result[row]['Type'] == 'composed')
                {
                    var composedMainQuestion = true;

                    for(var composedQuestion = row; ;composedQuestion++)
                    {
                        if(composedMainQuestion)
                        {
                            tables += "<tbody class='composedQuestion'>";
                            tables += "<tr>";
                            tables += "<td class='userName' rowspan='" + result[composedQuestion]['ComposedCount'] + "'>" + result[composedQuestion]['Fname'] + "</td>";
                            tables += "<td class='userName' rowspan='" + result[composedQuestion]['ComposedCount'] + "'>" + result[composedQuestion]['Lname'] + "</td>";
                            tables += "<td class='otherCells' rowspan='" + result[composedQuestion]['ComposedCount'] + "'>"+ result[composedQuestion]['Question'] +"</td>";
                            tables += "<td class='subQuestion'>"+ result[composedQuestion]['Sub_Q'] +"</td>";
                            tables += "<td class='userAnswer'>"+ result[composedQuestion]['SubQuestionAnswer'] +"</td>";
                            if(result[composedQuestion]['NoteText'] == null)
                            {
                                tables += "<td class='userComment' rowspan='" + result[composedQuestion]['ComposedCount'] + "'>No Comment</td>";
                            }
                            else
                            {
                                tables += "<td class='userComment' rowspan='" + result[composedQuestion]['ComposedCount'] + "'>"+ result[composedQuestion]['NoteText'] +"</td>";
                            }
                            tables += "</tr>";
                            composedMainQuestion = false;
                        }
                        else
                        {
                            tables += "<tr>";
                            tables += "<td class='subQuestion'>" + result[composedQuestion]['Sub_Q'] + "</td>";
                            tables += "<td class='userAnswer'>" + result[composedQuestion]['SubQuestionAnswer'] + "</td>";
                            tables += "</tr>";
                        }
                        //alert(composedQuestion);
                        if(composedQuestion == result.length -1)
                        {
                            row = composedQuestion;
                            break;
                        }
                        else if(result[composedQuestion]['Type'] != result[composedQuestion+1]['Type'])
                        {
                            row = composedQuestion;
                            break;
                        }else if(result[composedQuestion]['SubGoal'] != result[composedQuestion+1]['SubGoal'])
                        {
                            row = composedQuestion;
                            break;
                        }else if(result[composedQuestion]['QuestionID'] != result[composedQuestion+1]['QuestionID'])
                        {
                            row = composedQuestion;
                            break;
                        }else if(result[composedQuestion]['UserNumber'] != result[composedQuestion+1]['UserNumber'])
                        {
                            composedMainQuestion = true;
                        }
                    }
                    composedMainQuestion = true;
                    tables += "</tbody>";
                }
                else
                {
                    tables += "<tr>";
                    tables += "<td class='userName'>" + result[row]['Fname'] + "</td>";
                    tables += "<td class='userName'>" + result[row]['Lname'] + "</td>";
                    tables += "<td class='otherCells' colspan='2'>"+ result[row]['Question'] +"</td>";
                    tables += "<td class='userAnswer'>"+ result[row]['QuestionAnswer'] +"</td>";
                    if(result[row]['NoteText'] == null)
                    {
                        tables += "<td class='userComment'>No Comment</td>";
                    }
                    else
                    {
                        tables += "<td class='userComment'>"+ result[row]['NoteText'] +"</td>";
                    }
                    tables += "</tr>";
                }
                if(row == result.length -1)
                {
                    tables += "</table>";
                }
                else if(result[row]['SubGoal'] != result[row+1]['SubGoal'])
                {
                    tables += "</table>";
                }
            }
        }
        $('#report-pane').html(tables);
    });

}

function showUserSearchPopupWindow()
{
    searchByUser(null);
    $('#blanket').show();
    $('#popup').show();
}

function searchUserFunction(inputElementId)
{
    var stringInputUser = $("#"+inputElementId+"").val();
    var userInfo = [];
    var lastNameFound = false;
    var firstName = "";
    var lastName = "";
    for(var indexFistName = 0; indexFistName < stringInputUser.length; indexFistName++)
    {
        if(stringInputUser[indexFistName] == ' ')
        {
            lastNameFound = true;
            if(!(indexFistName < stringInputUser.length))
                break;
            else
                indexFistName++;
        }

        if(lastNameFound)
        {
            for(var indexLastName = indexFistName; ;indexLastName++)
            {
                if(!(indexLastName < stringInputUser.length))
                {
                    indexFistName = indexLastName;
                    break;
                }
                else if(stringInputUser[indexLastName] == ' ')
                {
                    indexFistName = stringInputUser.length;
                    break;
                }
                else
                {
                    lastName += stringInputUser[indexLastName];
                }
            }
            lastNameFound = false;
        }
        else
        {
            firstName += stringInputUser[indexFistName];
        }
    }

    userInfo = firstName+","+lastName;
    searchByUser(userInfo);
}

function searchByUser(userInfoString)
{

    var url = 'Controller.php';
    var query = {page: 'PastReport', command: 'SendUserList', searchString:userInfoString};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);

        var usersTable = "";

        usersTable += "<table>";
        usersTable += "<tr>";
        usersTable += "<th>First Name</th>";
        usersTable += "<th>Last Name</th>";
        usersTable += "<th>Department</th>";
        usersTable += "</tr>";

        if(result == "No Data")
        {
            usersTable += "<tr>";
            usersTable += "<td>No</td>";
            usersTable += "<td>Users</td>";
            usersTable += "<td>Found</td>";
            usersTable += "</tr>";
        }
        else
        {
            for (var row = 0; row < result.length; row++) {

                usersTable += "<tr onclick='chooseClickedUser(this.id)' id='" + result[row]['UserNumber'] + "'>";
                usersTable += "<td name='First Name'>" + result[row]['FirstName'] + "</td>";
                usersTable += "<td name='Last Name'>" + result[row]['LastName'] + "</td>";
                usersTable += "<td name='Department'>" + result[row]['Department'] + "</td>";
                usersTable += "</tr>";
            }
        }
        usersTable += "</table>";

        $('#searchUser').html(usersTable);
    });
}

function chooseClickedUser(userId)
{
    currentUserNumber = userId;
    FirstTimeChooseDetailedReport = false;
    show_survey_goal_detailed();
    hideCover();
}

function set_current_document (id)
{
    var url = 'Controller.php';
    var query = {page: 'PastReport', command: 'CurrentSurveyDocumentID', CurrentDocumentID:''+ id +''};
    $.post(url, query);
}

function diel_goal_show()
{
    currentGoalDetailed = 'DIEL';
    if(detailedReport)
    {
        show_survey_goal_detailed();
    }
    else
    {
        show_survey_goal_chosen('DIEL');
        if(chart != null){ chart.destroy();}
        load_charts('DIEL');
    }
}

function sppb_goal_show()
{
    currentGoalDetailed = 'SPP';
    if(detailedReport)
    {
        show_survey_goal_detailed();
    }
    else
    {
        show_survey_goal_chosen('SPP');
        chart.destroy();
        load_charts('SPP');
    }
}

function ttl_goal_show()
{
    currentGoalDetailed = 'TTL';
    if(detailedReport)
    {
        show_survey_goal_detailed();
    }
    else
    {
        show_survey_goal_chosen('TTL');
        chart.destroy();
        load_charts('TTL');
    }
}

function tc_goal_show()
{
    currentGoalDetailed = 'TC';
    if(detailedReport)
    {
        show_survey_goal_detailed();
    }
    else
    {
        show_survey_goal_chosen('TC');
        chart.destroy();
        load_charts('TC');
    }
}

function gcd_goal_show()
{
    currentGoalDetailed = 'GSD';
    if(detailedReport)
    {
        show_survey_goal_detailed();
    }
    else
    {
        show_survey_goal_chosen('GSD');
        chart.destroy();
        load_charts('GSD');
    }
}

function disable_goal_buttons()
{
    $('#DIELbutton').prop('disabled', true);
    $('#SPbutton').prop('disabled', true);
    $('#TTLbutton').prop('disabled', true);
    $('#TCbutton').prop('disabled', true);
    $('#GSDbutton').prop('disabled', true);
}

function enable_goal_buttons()
{
    $('#DIELbutton').prop('disabled', false);
    $('#SPbutton').prop('disabled', false);
    $('#TTLbutton').prop('disabled', false);
    $('#TCbutton').prop('disabled', false);
    $('#GSDbutton').prop('disabled', false);
}


//----------------------------------Scripts for charts-------------------------------------

function load_charts(goal){

    var url = 'Controller.php';
    var query = {page: 'PastReport', command: 'AnswerPercentage', goal: ''+goal+''};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);

        if(result != "No Data")
        {
            //list of year
            var CurrentYear = result[0]['CurrentYear'];
            var Year1 = result[0]['Year1'];
            var Year2 = result[0]['Year2'];

            //list of Answer_Percentage
            var Value  = result[0]['Value'];
            var Value1 = result[0]['Value1'];
            var Value2 = result[0]['Value2'];

            calculateGraph(CurrentYear , Year1 , Year2 ,Value , Value1 ,Value2);
        }else{
            calculateGraph(0 , 0 , 0 ,0 , 0 ,0);
        }
    });

}



//circular graph
function updateCircularProgressBar(progress) {
    const circleProgress = document.querySelector(".circle-progress");
    const progressPercentage = document.querySelector(".progress-percentage");
    const percentage = Math.max(0, Math.min(100, progress * 100));

    const circumference = 2 * Math.PI * 45;
    const strokeDashArray = `${(percentage * circumference) / 100} ${circumference}`;
    circleProgress.style.strokeDasharray = strokeDashArray;
    progressPercentage.textContent = `${Math.round(percentage)}%`;
}

var chart;
// Linear graph
function calculateGraph(CurrentYear, year1 , year2 ,value, value1, value2) {

    if(year1 === null && year2 !== null){
        var previousYears = [year2 , CurrentYear];
        var dataNum = [value2 * 100 , value * 100];
    }
    else if(year2 === null && year1 !== null){
        var previousYears = [year1 , CurrentYear];
        var dataNum = [value1 * 100 , value * 100];
    }
    else if(year1 === null && year2 === null ){
        var previousYears = [0 , 0 , 0];
        var dataNum = [0 , 0 , 0 ];
    }
    else{
        var previousYears = [year2 , year1 , CurrentYear];
        var dataNum = [value2 * 100 , value1 * 100 , value * 100 ];
    }

    const ctx = document.getElementById("lineChart").getContext("2d");
    chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: previousYears,
            datasets: [
                {
                    label: "survey answer percentage",
                    data: dataNum,
                    backgroundColor: "rgba(255, 255, 0, 0.1)",
                    borderColor: " rgb(255, 145, 0)",
                    borderWidth: 2,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 110,
                    title: {
                        display: true,
                        text: "Survey Answer Percentage",
                    },
                },
                x: {
                    title: {
                        display: true,
                        text: "Year",
                    },
                },
            },
        },
    });
    
}


//Blanket function
function hideCover()
{
    $('#blanket').hide();
    $('#popup').hide();
}





