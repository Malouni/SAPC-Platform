document.addEventListener("DOMContentLoaded", function(){
    showUsersTable ();
    showSurveysTable();
});


//Functions
function showUsersTable(){
    var url = 'Controller.php';

    var query = {page: 'AdminPage', command: 'UserTable'};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);

        var userTable = "";

        userTable += "<table border='1'>";
        userTable += "<thead>";
        userTable += "<tr>";
        userTable += "<th>User First Name</th>";
        userTable += "<th>User Last Name</th>";
        userTable += "<th>Institutional Email</th>";
        userTable += "<th>User Type</th>";
        userTable += "<th>Department</th>";
        userTable += "</tr>";
        userTable += "</thead>";
        userTable += "<tbody>";

        if(result == "NoResults")
        {
            userTable += "<tr>";
            userTable += "<td>No</td>";
            userTable += "<td>Users</td>";
            userTable += "<td>Found</td>";
            userTable += "<td></td>";
            userTable += "<td></td>";
            userTable += "</tr>";
        }
        else
        {
            for (var row = 0; row < result.length; row++) {

                userTable += "<tr>";
                userTable += "<td>" + result[row]['Fname'] + "</td>";
                userTable += "<td>" + result[row]['Lname'] + "</td>";
                userTable += "<td>" + result[row]['UserName'] + "</td>";
                userTable += "<td>" + result[row]['Position'] + "</td>";
                userTable += "<td>" + result[row]['Department'] + "</td>";
                userTable += "</tr>";
            }
        }
        userTable += "</tbody></table>";

        $('#user-table').html(userTable);
    });
}

function showSurveysTable(){
    var url = 'Controller.php';

    var query = {page: 'AdminPage', command: 'SurveyTable'};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);

        var surveyTable = "";

        surveyTable += "<table border='1'>";
        surveyTable += "<thead>";
        surveyTable += "<tr>";
        surveyTable += "<th>Survey Name</th>";
        surveyTable += "<th>Survey Year</th>";
        surveyTable += "<th>Survey Start Date</th>";
        surveyTable += "<th>Survey End Date</th>";
        surveyTable += "<th>User Access</th>";
        surveyTable += "<th></th>";
        surveyTable += "<th></th>";
        surveyTable += "</tr>";
        surveyTable += "</thead>";
        surveyTable += "<tbody>";

        if(result == "NoResults")
        {
            surveyTable += "<tr>";
            surveyTable += "<td>No</td>";
            surveyTable += "<td>Surveys</td>";
            surveyTable += "<td>Found</td>";
            surveyTable += "<td></td>";
            surveyTable += "<td></td>";
            surveyTable += "<td></td>";
            surveyTable += "<td></td>";
            surveyTable += "</tr>";
        }
        else
        {
            for (var row = 0; row < result.length; row++) {

                surveyTable += "<tr>";
                surveyTable += "<td id='SurvName'"+ result[row]['SurvID'] +"''>" + result[row]['SurvName'] + "</td>";
                surveyTable += "<td id='SurvYear'"+ result[row]['SurvID'] +"''>" + result[row]['SurvYear'] + "</td>";
                surveyTable += "<td id='SurvDateStart'"+ result[row]['SurvID'] +"''>" + result[row]['SurvDateStart'] + "</td>";
                surveyTable += "<td id='SurvDateEnd'"+ result[row]['SurvID'] +"''>" + result[row]['SurvDateEnd'] + "</td>";
                surveyTable += "<td id='Position'"+ result[row]['SurvID'] +"''>" + result[row]['Position'] + "</td>";
                surveyTable += "<td><button button-Edit-SurveyId='" + result[row]['SurvID'] + "'>Edit</button></td>";
                surveyTable += "<td><button button-Delete-SurveyId='" + result[row]['SurvID'] + "'>Delete</button></td>";
                surveyTable += "</tr>";
            }
        }
        surveyTable += "</tbody></table>";

        $('#survey-table').html(surveyTable);

        $('td > button[button-Edit-SurveyId]').click(function() {
            var id = $(this).attr('button-Edit-SurveyId'); 
            showDiscussion(id);
        });

        $('td > button[button-Delete-SurveyId]').click(function() {
            var id = $(this).attr('button-Delete-SurveyId'); 
            showDiscussion(id);
        });
    });
}



function addNewUserFunction()
{
    var url = 'Controller.php';
    var query = {page: 'AdminPage', command: 'AddNewUser', Fname: $("#fName").val(),
                                                           Lname: $("#lName").val(),
                                                           Email: $("#email").val(),
                                                           EmailCon: $("#emailC").val(),
                                                           department: $("#department").val(),
                                                           userType: $("#userType").val()};
    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        alert(result);
        showUsersTable();
    });
}

function removeUserFunction()
{
    var url = 'Controller.php';
    var query = {page: 'AdminPage', command: 'RemoveUser', EmailDelete: $("#emailDelete").val(),
                                                           EmailConDelete: $("#emailCDelete").val()};
    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        alert(result);
        showUsersTable();
    });
}

function addUsersFromFileFunction(){
    var csvFile = document.querySelector('#csvFile').files[0];
    var reader = new FileReader();
    reader.readAsText(csvFile);

    reader.onload = function (e) {
        var text = e.target.result;
        var data = csvToArray(text);
        alert(data[0]["Department"]);
        var result2 = JSON.stringify(data);
        alert(result2);
        var url = 'Controller.php';
        var query = {page: 'AdminPage', command: 'csvAddUsers', csvFileDataUsers: data};
        $.post(url, query, function(data) {
        var result = JSON.parse(data);
        alert(result);
        showUsersTable();
        });
    };
}



function csvToArrayUsers(text)
{
    var delimiter = ",";

    var headers = text.slice(0, text.indexOf("\n")).split(delimiter);
    alert(headers);
    //alert(text);
    // slice from \n index + 1 to the end of the text
    // use split to create an array of each csv value row
    var rows = text.slice(text.indexOf("\n") + 1).split("\n");
   // alert(rows);

    // Map the rows
    // split values from each row into an array
    // use headers.reduce to create an object
    // object properties derived from headers:values
    // the object passed as an element of the array
    var arr = rows.map(function (row) {
        var values = row.split(delimiter);
        alert(values);
        var el = headers.reduce(function (object, header, index) {
        object[header] = values[index];
        alert(values[index]);
        return object;
      }, {});
      return el;
    });
    // return the array
    return arr;
}