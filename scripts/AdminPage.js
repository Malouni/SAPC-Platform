document.addEventListener("DOMContentLoaded", function(){
    showUsersTable();
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
        userTable += "<th>Reset Password</th>";
        userTable += "<th>Delete</th>";
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
            userTable += "<td></td>";
            userTable += "<td></td>";
            userTable += "</tr>";
        }
        else
        {
            for (var row = 0; row < result.length; row++) {

                userTable += "<tr id='" + result[row]['UserID'] + "'>";
                userTable += "<td name='First Name' onclick='changeTheClickedFieldUserTable(this.id)' id='Fname" + result[row]['UserID'] + "'>" + result[row]['Fname'] + "</td>";
                userTable += "<td name='Last Name' onclick='changeTheClickedFieldUserTable(this.id)' id='Lname" + result[row]['UserID'] + "'>" + result[row]['Lname'] + "</td>";
                userTable += "<td name='Email' onclick='changeTheClickedFieldUserTable(this.id)' id='UserName" + result[row]['UserID'] + "'>" + result[row]['UserName'] + "</td>";
                userTable += "<td name='Position' onclick='changeTheClickedFieldUserTable(this.id)' id='Position" + result[row]['UserID'] + "'>" + result[row]['Position'] + "</td>";
                userTable += "<td name='Department' onclick='changeTheClickedFieldUserTable(this.id)' id='Department" + result[row]['UserID'] + "'>" + result[row]['Department'] + "</td>";
                userTable += "<td class='buttonForEdit'><button class='editDelete' button-Reset-UserId='" + result[row]['UserID'] + "'>Reset</button></td>";
                userTable += "<td class='buttonForEdit'><button class='editDelete' button-Delete-UserId='" + result[row]['UserID'] + "'>Delete</button></td>";
                userTable += "</tr>";
            }
        }
        userTable += "</tbody></table>";

        $('#user-table').html(userTable);

        $('td > button[button-Reset-UserId]').click(function() {
            var userId = $(this).attr('button-Reset-UserId');
            var userName = $("#UserName"+userId+"").text();
            let text = "Are you sure, you want to reset password to DEFAULT for user: "+userName+"?";
            if (confirm(text) == true){
                resetUserPassword(userId, userName);
            }
        });

        $('td > button[button-Delete-UserId]').click(function() {
            var userId = $(this).attr('button-Delete-UserId');
            var userName = $("#UserName"+userId+"").text();
            let text = "Are you sure, you want to delete user: "+userName+"?";
            if (confirm(text) == true){
                removeUserFunction(userId);
            }
            showUsersTable();
        });
    });
}

function changeTheClickedFieldUserTable(clicked_id)
{
    var rowId = $("#"+clicked_id+"").closest('tr').attr("id");
    var choice = $("#"+clicked_id+"").attr('name');
    let newData = prompt("Enter new "+ choice +"", $("#"+clicked_id+"").text());
    if (newData)
    {
        var url = 'Controller.php';
        var query = {page: 'AdminPage', command: 'ChangeUser', choice: choice, rowId: rowId, value: newData};
        $.post(url, query, function(data) {
            var result = JSON.parse(data);
            alert(result);
            showUsersTable();
        });
    }
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
        surveyTable += "<th>Delete</th>";
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
            surveyTable += "</tr>";
        }
        else
        {
            for (var row = 0; row < result.length; row++) {
                surveyTable += "<tr id='" + result[row]['SurvID'] + "'>";
                surveyTable += "<td name='Survey Name' onclick='changeTheClickedFieldSurveyTable(this.id)' id='SurvName"+ result[row]['SurvID'] +"'>" + result[row]['SurvName'] + "</td>";
                surveyTable += "<td name='Survey Year' onclick='changeTheClickedFieldSurveyTable(this.id)' id='SurvYear"+ result[row]['SurvID'] +"'>" + result[row]['SurvYear'] + "</td>";
                surveyTable += "<td name='Survey Date Start' onclick='changeTheClickedFieldSurveyTable(this.id)' id='SurvDateStart"+ result[row]['SurvID'] +"'>" + result[row]['SurvDateStart'] + "</td>";
                surveyTable += "<td name='Survey Date End' onclick='changeTheClickedFieldSurveyTable(this.id)' id='SurvDateEnd"+ result[row]['SurvID'] +"'>" + result[row]['SurvDateEnd'] + "</td>";
                surveyTable += "<td name='Position' onclick='changeTheClickedFieldSurveyTable(this.id)' id='Position"+ result[row]['SurvID'] +"'>" + result[row]['Position'] + "</td>";
                surveyTable += "<td class='buttonForEdit'><button class='editDelete' button-Delete-SurveyId='" + result[row]['SurvID'] + "'>Delete</button></td>";
                surveyTable += "</tr>";
            }
        }
        surveyTable += "</tbody></table>";

        $('#survey-table').html(surveyTable);

        $('td > button[button-Delete-SurveyId]').click(function() {
            var suvId= $(this).attr('button-Delete-SurveyId');
            var survName = $("#SurvName"+suvId+"").text();
            let text = "Are you sure, you want to delete the Survey: "+survName+"?";
            if (confirm(text) == true){
                removeUserFunction(suvId);
                showSurveysTable();
            }
        });
    });
}

function changeTheClickedFieldSurveyTable(clicked_id)
{
    var rowId = $("#"+clicked_id+"").closest('tr').attr("id");
    var choice = $("#"+clicked_id+"").attr('name');
    let newData = prompt("Enter new "+ choice +"", $("#"+clicked_id+"").text());
    if (newData)
    {
        var url = 'Controller.php';
        var query = {page: 'AdminPage', command: 'ChangeSurv', choice: choice, rowId: rowId, value: newData};
        $.post(url, query, function(data) {
            var result = JSON.parse(data);
            alert(result);
            showSurveysTable();
        });
    }
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

function removeUserFunction(userId)
{
    var url = 'Controller.php';
    var query = {page: 'AdminPage', command: 'RemoveUser', RemoveUserId: userId};
    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        alert(result);
        showUsersTable();
    });
}

function resetUserPassword(userId,userName)
{
    var url = 'Controller.php';
    var query = {page: 'AdminPage', command: 'ResetPassword', ResetPwdUserId: userId};
    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        alert(result+userName);
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