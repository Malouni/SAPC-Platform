document.addEventListener("DOMContentLoaded", function(){
    show_survey_documents();
    disable_goal_buttons();
});

function show_survey_documents() {
    var url = 'Controller.php';

    var query = {page: 'PastReport', command: 'SurveyDocuments'};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        
        var documents = "";
        if(result == "Failed")
        {
            documents +="<div class='document'>";
            documents +="<table>";
            documents +="<tr class='rowDocuments'>";
            documents +="<td class='gridDocuments'><p class='document'>Error, no connection to the server</p></td>";
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
                documents += "<button src='../images/icons/pdf.png' class='pdf' button-document-show-id = '" + result[row]['SurvID'] + "'> </button>";
                documents += "<button src='../images/icons/downloadpdf.png' class='pdf' button-document-download-id = '" + result[row]['SurvID'] + "'> </button>";
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

        $('td > button[button-document-show-id]').click(function() {
            var id = $(this).attr('button-document-show-id');
            set_current_document(id);
            enable_goal_buttons();
            diel_goal_show();
        });

        $('td > button[button-document-download-id]').click(function() {
            var id = $(this).attr('button-document-download-id');
            download_chosen_document(id);
        });
    });

}

function show_survey_goal_chosen(goal) {
    var url = 'Controller.php';

    var query = {page: 'PastReport', command: 'SurveyActivityGoal', goal: ''+goal+''};

    $.post(url, query, function(data) {

        var result = JSON.parse(data);
        alert(data);
        //alert(result.length);
        alert(result);
        if(result == "Failed")
        {
            var tables = "<p class='headers'>No connection to the DataBase, Please try again latter</p>";
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
                            tables += "<tr class='rowPastReportSingle'>";
                            //TODO: We need to change the attribute for column span for the grid below and move it to css file for the corresponding style
                            tables += "<td class='gridComposedActivity' colspan='3'>" + result[composedQuestion]['Question'] + "</td>";
                            tables += "</tr>";
                            tables += "<tr class='rowPastReportComposed'>";
                            tables += "<td class='gridActivity'>" + result[composedQuestion]['Sub_Q'] + "</td>";
                            tables += "<td class='gridRest'>" + result[composedQuestion]['Activity_Involvement'] + "</td>";
                            tables += "<td class='gridRest'>"+ result[composedQuestion]['Activity_Historical'] +"</td>";
                            tables += "</tr>";
                            composedMainQuestion = false;
                        }
                        else
                        {
                            tables += "<tr class='rowPastReportComposed'>";
                            tables += "<td class='gridActivity'>" + result[composedQuestion]['Sub_Q'] + "</td>";
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
                        }else if(result[composedQuestion]['SubGoal'] != result [composedQuestion+1]['SubGoal'])
                        {
                            row = composedQuestion;
                            break;
                        }
                    }
                    composedMainQuestion = true;
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
        }
        $('#report-pane').html(tables);
    });

}

function set_current_document (id)
{
    var url = 'Controller.php';
    var query = {page: 'PastReport', command: 'CurrentSurveyDocumentID', CurrentDocumentID:''+ id +''};
    $.post(url, query);
}

function diel_goal_show()
{
    show_survey_goal_chosen('DIEL');
}

function sppb_goal_show()
{
    show_survey_goal_chosen('SPP');
}

function ttl_goal_show()
{
    show_survey_goal_chosen('TTL');
}

function tc_goal_show()
{
    show_survey_goal_chosen('TC');
}

function gcd_goal_show()
{
    show_survey_goal_chosen('GSD');
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






