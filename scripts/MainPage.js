document.addEventListener("DOMContentLoaded", function(){
    upcomingSurveys();
    historyOfSurveys();
    documents();
});

function upcomingSurveys (){
    var url = 'Controller.php';

    var query = {page: 'MainPage', command: 'UpcomingSurveys'};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);

        var upcomingSurveys = "<h1 class='sectionheader'>Upcoming</h1>";

        if(result == "NoResults")
        {
            upcomingSurveys += "<div class='activity'>";
            //upcomingSurveys += "<img src='../images/cover-textures/1.png' alt='cover'>";
            upcomingSurveys += "<p class='title'>No Upcoming Surveys</p>";
            upcomingSurveys += "</div>";
        }
        else
        {
            for (var row = 0; row < result.length; row++) {

                upcomingSurveys += "<div class='activity' onclick='upcomingSurveySelected(this.id)' id='" + result[row]['SurvID'] + "'>";
                upcomingSurveys += "<img src='../images/cover-textures/1.png' alt='cover'>";
                upcomingSurveys += "<p class='title'>Faculty of Science<br><span>" + result[row]['SurvName'] + "</span></p>";
                upcomingSurveys += "<div class='meter'></div>";
                upcomingSurveys += "</div>";
            }
        }

        $('#upcoming-pane').html(upcomingSurveys);
    });
}

function upcomingSurveySelected(surveyId)
{
    document.getElementById("upcomingSurveyID").value = surveyId;
    $('#surveystart').submit();
}

function historyOfSurveys(){
    var url = 'Controller.php';

    var query = {page: 'MainPage', command: 'HistoryOfSurveys'};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        //Only the surveys that user answers
        var historySurveys = "<h1 class='sectionheader'>History</h1>";

        if(result == "NoResults")
        {
            //historySurveys += "<img src='../images/cover-textures/1.png' alt='cover'>";
            historySurveys += "<p class='title'>No Past Reports Found<br></p>";
        }
        else
        {
            for (var row = 0; row < result.length; row++) {

                historySurveys += "<div class='activity' onclick='historySurveySelected(this.id)' id='" + result[row]['SurvID'] + "'>";
                historySurveys += "<img src='../images/cover-textures/1.png' alt='cover'>";
                historySurveys += "<p class='title'>Faculty of Science<br><span>" + result[row]['SurvName'] + "</span></p>";
                historySurveys += "</div>";
            }
        }

        $('#history-pane').html(historySurveys);
    });
}


function historySurveySelected(surveyId)
{
    document.getElementById("HSurveyID").value = surveyId;
    $('#HistoryView').submit();
}
