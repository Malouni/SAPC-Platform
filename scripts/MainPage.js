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
            upcomingSurveys += "<p class='title'>No Results Found<br><span>Try to reload the page</span></p>";
            upcomingSurveys += "<button class='options'>...</button>";
            upcomingSurveys += "<div class='meter'></div>";
            upcomingSurveys += "</div>";
        }
        else
        {
            for (var row = 0; row < result.length; row++) {

                upcomingSurveys += "<div class='activity'>";
                upcomingSurveys += "<img src='../images/cover-textures/1.png' alt='cover'>";
                upcomingSurveys += "<p class='title'>Faculty of Science<br><span>" + result[row]['SurvName'] + "</span></p>";
                upcomingSurveys += "<button class='options' button-document-id = '" + result[row]['SurvID'] + "'>...</button>";
                upcomingSurveys += "<div class='meter'></div>";
                upcomingSurveys += "</div>";
            }
        }

        $('#upcoming-pane').html(upcomingSurveys);

        $('button[button-document-id]').click(function() {
            var id = $(this).attr('button-document-id');
        });

    });
}

function historyOfSurveys(){
    var url = 'Controller.php';

    var query = {page: 'MainPage', command: 'HistoryOfSurveys'};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);

        var historySurveys = "<h1 class='sectionheader'>History</h1>";

        if(result == "NoResults")
        {
            historySurveys += "<div class='activity'>";
            //historySurveys += "<img src='../images/cover-textures/1.png' alt='cover'>";
            historySurveys += "<p class='title'>No Results Found<br><span>Try to reload the page</span></p>";
            historySurveys += "<button class='options'>...</button>";
            historySurveys += "<div class='meter'></div>";
            historySurveys += "</div>";
        }
        else
        {
            for (var row = 0; row < result.length; row++) {

                historySurveys += "<div class='activity'>";
                historySurveys += "<img src='../images/cover-textures/1.png' alt='cover'>";
                historySurveys += "<p class='title'>Faculty of Science<br><span>" + result[row]['SurvName'] + "</span></p>";
                historySurveys += "<button class='options' button-document-id = '" + result[row]['SurvID'] + "'>...</button>";
                historySurveys += "<div class='meter'></div>";
                historySurveys += "</div>";
            }
        }

        $('#history-pane').html(historySurveys);

        $('button[button-document-id]').click(function() {
            var id = $(this).attr('button-document-id');
        });

    });
}

function documents(){
    var url = 'Controller.php';

    var query = {page: 'MainPage', command: 'Documents'};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);

        var documents = "";

        if(result == "NoResults")
        {
            documents += "<div class='activity'>";
            documents += "<img src='../images/cover-textures/1.png' alt='cover'>";
            documents += "<p class='title'>No Results Found<br><span>Try to reload the page</span></p>";
            documents += "<button class='options'>...</button>";
            documents += "<div class='meter'></div>";
            documents += "</div>";
        }
        else
        {
            for (var row = 0; row < result.length; row++) {

                documents += "<li>";
                documents += "<a>";
                documents += "<ul>";
                documents += "<li class='date'>";
                documents += "<h2>Friday, 3 March 2023</h2>";
                documents += "</li>";
                documents += "<li class='item'><span>Strategic Plan Survey 2023</span>is due <span class='pdflink'>";
                documents += "<button><img src='../images/icons/downloadpdf.png' alt=''></button></span>";
                documents += "</li>";
                documents += "<li class='faculty'>Faculty of Science</li>";
                documents += "</ul>";
                documents += "</a>";
                documents += "</li>";
            }
        }

        $('#DocumentList').html(documents);

        $('button[button-document-id]').click(function() {
            var id = $(this).attr('button-document-id');
        });

    });
}