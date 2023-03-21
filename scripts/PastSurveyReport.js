document.addEventListener("DOMContentLoaded", function(){
    show_survey_documents();
});

function show_survey_documents() {
    var url = 'Controller.php';

    var query = {page: 'PastReport', command: 'SurveyDocuments'};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        var documents = "";
        if(result[0] == "Failed")
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
                documents += "<button src='../images/icons/pdf.png' class='pdf' button-document-id = '" + result[row]['SurvID'] + "'> </button>";
                documents += "<button src='../images/icons/downloadpdf.png' class='pdf' button-document-id = '" + result[row]['SurvID'] + "'> </button>";
                documents += "</td>";
                documents += "</tr>";
                documents += "<tr class='rowDocuments'>";
                documents += "<td class='gridDocuments'><p class='facility'>Facility of Science</p></td>";
                documents += "</tr>";
                documents += "</table>";
                documents += "</div>";
            }
        }
        alert(documents);
        $('#documents-pane').html(documents);

        $('button[button-document-show-id]').click(function() {
            var id = $(this).attr('button-document-show-id');
            alert(id);
            set_current_document(id);
            diel_goal_show();
        });

        $('button[button-document-download-id]').click(function() {
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

        if(result[0] == "Failed" || result)
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
            else
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
                    else
                        tables += "<p class='headers'>Sustainability</p>";
                    //tables += "<p class='regularText'>"+ result[row]['desc'] +"</p>";
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
                    else
                        tables += "<p class='headers'>Sustainability</p>";
                    //tables += "<p class='regularText'>"+ result[row]['desc'] +"</p>";
                    tables += "<table class='tablePastReport'>";
                    tables += "<tr class='rowPastReport'>";
                    tables += "<th class='headerActivity'>Activity</th>";
                    tables += "<th class='headerRest'>Involvement</th>";
                    tables += "<th class='headerRest'>Historical</th>";
                    tables += "</tr>";
                }

                tables += "<tr class='rowPastReport'>";
                tables += "<td class='gridActivity'>" + result[row]['Question'] + "</td>";
                tables += "<td class='gridRest'>" + result[row]['Activity_Involvement'] + "</td>";
                tables += "<td class='gridRest'>"+ result[row]['Activity_Historical'] +"</td>";
                tables += "</tr>";

                if(result[row]['SubGoal'] != result[row+1]['SubGoal'])
                    tables += "</table>";
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






