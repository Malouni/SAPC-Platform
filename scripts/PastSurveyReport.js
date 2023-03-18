function search_discussions() {
    var url = 'Controller.php';

    var query = {page: 'PastReport', command: 'SurveyReport'};

    $.post(url, query, function(data) {

        var result = JSON.parse(data);

        var tables = "<p class='headers'>Inclusion and Diversity</p>";
        tables += "<p class='regularText'>Ensure the staff and facility compliment is equitable, diverse and inclusive</p>";




        for (var row = 0; row < result.length; row++) {

            tables += "<table class='tablePastReport'>";
            tables += "<tr class='rowPastReport'>";
            tables += "<th class='headerActivity'>Activity</th>";
            tables += "<th class='headerRest'>Involvement</th>";
            tables += "<th class='headerRest'>Historical</th>";
            tables += "</tr>";

            for (var columns = 0; columns < result[row].length; columns++)
            {
                tables += "<tr class='rowPastReport'>";
                tables += "<td class='gridActivity'>" + result[row]['Activity' + columns] + "</td>";
                tables += "<td class='gridRest'>" + result[row]['Activity' + columns + '_Involvement'] + "</td>";
                tables += "<td class='gridRest'>"+ result[row]['Activity' + columns + '_Historical'] +"</td>";
                tables += "</tr>";
            }
            tables += "<tr>";
            tables += "<td>";
            tables += "<button src='../images/icons/pdf.png' class='pdf' button-goal-id = '"+ row + "add" +"' ></button>";
            tables += "<button src='../images/icons/pdf.png' class='pdf' button-goal-id = '"+ row + "remove" +"' ></button>";
            tables += "<button src='../images/icons/pdf.png' class='pdf' button-goal-id = '"+ row + "info" +"' ></button>";
            tables += "</td>";
            tables += "</tr>";
            tables += "</table>";
        }

        $('#report-pane').html(table);

        $('td > button[button-goal-id]').click(function() {
            var id = $(this).attr('button-goal-id');
            
            if()
            {

            }
            else if()
            {
                
            }
            else
            {

            }
        });
    });

}

function search_discussions() {
    var url = 'Controller.php';

    var query = {page: 'PastReport', command: 'SurveyReport'};

    $.post(url, query, function(data) {

        var result = JSON.parse(data);

        var documents = "";

        for (var row = 0; row < result.length; row++) {

            documents += "<div class='document'>";
            documents += "<table>";
            documents += "<tr class='rowDocuments'>";
            documents += "<td class='gridDocuments'><p class='document'>Document</p></td>";
            documents += "</tr>";
            documents += "<tr class='rowDocuments'>";
            documents += "<td class='gridDocuments'><p class='date'>" + $row['Year'] + "</p></td>";
            documents += "</tr>";
            documents += "<tr class='rowDocuments'>";
            documents += "<td class='gridDocuments'><p class='SPRtext'>" + $row['SurveyName'] + "</p> </td>";
            documents += "<td>";
            documents += "<button src='../images/icons/pdf.png' class='pdf' button-document-id = '" + row + "'> </button>";
            documents += "<button src='../images/icons/downloadpdf.png' class='pdf' button-document-id = '" + row + "'> </button>";
            documents += "</td>";
            documents += "</tr>";
            documents += "<tr class='rowDocuments'>";
            documents += "<td class='gridDocuments'><p class='facility'>Facility of Science</p></td>";
            documents += "</tr>";
            documents += "</table>";
            documents += "</div>";
        }

        $('#documents-pane').html(table);

        $('td > button[button-document-show-id]').click(function() {
            var id = $(this).attr('button-document-show-id');

        });

        $('td > button[button-document-download-id]').click(function() {
            var id = $(this).attr('button-document-download-id');
 
        });
    });

}

function diel_show ()
{

}

function sp_show()
{

}

function ttl_show()
{

}

function tc_show()
{

}

function _show()
{

}






