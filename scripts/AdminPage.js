document.addEventListener("DOMContentLoaded", function(){
    showUsersTable();
    showSurveysTable();
});

var userFilter = "";

//Function creates a table of all users from database
function showUsersTable(){
    var url = 'Controller.php';

    var query = {page: 'AdminPage', command: 'UserTable', filter:userFilter};

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
            userFilter = '';
            showUsersTable();
        });
    });
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
    userFilter = userInfo;
    showUsersTable();
}

//Function send a request to a controller to change the specific filed of the user
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

//Function creates a table of all surveys from database
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
            var survId= $(this).attr('button-Delete-SurveyId');
            var survName = $("#SurvName"+survId+"").text();
            let text = "Are you sure, you want to delete the Survey: "+survName+"?";
            if (confirm(text) == true){
                removeSurveyFunction(survId,survName);
                showSurveysTable();
            }
        });
    });
}

//Function send a request to a controller to change the specific filed of the survey
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

//Function send a request to a controller to create a new user with the given information
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

//Function send a request to a controller to remove a specific user
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

//Function send a request to a controller to remove a specific survey
function removeSurveyFunction(surveyId,survName)
{
    var url = 'Controller.php';
    var query = {page: 'AdminPage', command: 'RemoveSurvey', RemoveSurveyId: surveyId};
    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        alert(survName+result);
        showSurveysTable();
    });
}

//Function send a request to a controller to reset a password for a specific user
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

//Function send a request to a controller to add multiple users from a file
function addUsersFromFileFunction(){
    var csvFile = document.querySelector('#csvUserFile').files[0];
    var reader = new FileReader();
    reader.readAsText(csvFile);
    reader.onload = function (e) {
        var text = e.target.result;
        var data = csvToArrayUsers(text);

        var url = 'Controller.php';
        var query = {page: 'AdminPage', command: 'csvAddUsers', csvFileDataUsers: data};
        $.post(url, query, function(data) {
            var result = JSON.parse(data);
            alert(result);
            showUsersTable();
        });
    };
}

//This function reads a file of users and adds it each values to a specific header(eg: First Name, Last Name)
function csvToArrayUsers(text)
{
    var rows = text.split(/\r?\n|\r/);
    rows = rows.filter(item => item);
    var array = [];
    var headers;
    var delimiter = ",";

    for(singleRow = 0; singleRow < rows.length; singleRow++)
    {
        cells = rows[singleRow].split(delimiter);
        if(singleRow == 0 && cells[0] !="")
        {
            headers = rows[singleRow].split(delimiter);
            //Filters headers array from empty elements
            headers = headers.filter(item => item);
            headers = removeUnnecessarySpaces(headers);
            singleRow++;
        }
        cells = rows[singleRow].split(delimiter);

        if(cells[0] !="")
        {
            var values = rows[singleRow].split(delimiter);
            values = values.filter(item => item);
            values = removeUnnecessarySpaces(values);
            array.push(
                headers.reduce(function (object, header, index) {
                object[header] = values[index];
                return object;
                }, {})
            );
        }
    }
    return array;
}

//Function send a request to a controller to add a surveys from a file
function addSurveyFromFileFunction(){
    var csvFile = document.querySelector('#csvSurveyFile').files[0];
    var reader = new FileReader();
    reader.readAsText(csvFile);

    reader.onload = function (e) {
        var text = e.target.result;
        var data = csvToArraySurvey(text);
        var url = 'Controller.php';
        var query = {page: 'AdminPage', command: 'csvAddSurvey', csvFileDataSurveys: data};
        $.post(url, query, function(data) {
            var result = JSON.parse(data);
            alert(result);
            showSurveysTable();
        });
    };
}

//This function reads a file of users and adds it each values to a specific header(eg: Survey Name, Survey Year)
function csvToArraySurvey(text)
{
    var dataSectionAmount = 3;
    var rows = text.split(/\r?\n|\r/);
    rows = rows.filter(item => item);
    var array = [dataSectionAmount];
    var surveyInfoArray = [];
    var questionArray = [];
    var subQuestionArray = [];
    var headers;
    var arrayOfPossibleAns = [];
    var possibleAnsPositionHolder = false;
    var dataSection;
    var delimiter = ",";
    var cells;

    for(singleRow = 0; singleRow < rows.length; singleRow++)
    {
        cells = rows[singleRow].split(delimiter);
        for(singleCell = 0; singleCell < cells.length; singleCell++)
        {
            if(singleCell == 0 && (cells[singleCell] == "SurvYear" || cells[singleCell] == "Goal" || cells[singleCell] == "Question"))
            {
                headers = rows[singleRow].split(delimiter);
                //Filters headers array from empty elements
                headers = headers.filter(item => item);
                headers = removeUnnecessarySpaces(headers);
                singleRow++;
                if(singleCell == 0 && cells[singleCell] == "SurvYear")
                {
                    dataSection = 0;
                }
                else if(singleCell == 0 && cells[singleCell] == "Goal")
                {
                    dataSection = 1;
                }
                else if(singleCell == 0 && cells[singleCell] == "Question")
                {
                    dataSection = 2;
                }
            }
            else if(cells[0] == "Goal" || cells[0] == "Question")
            {
                if(cells[singleCell] == "PossibleAnswers")
                {
                    possibleAnsPositionHolder = singleCell;
                }
            }
            else
            {
                break;
            }
        }

        cells = rows[singleRow].split(delimiter);
        if (cells[0] !="")
        {
            if(possibleAnsPositionHolder)
            {
                for(possibleAns = 0; possibleAns < (rows.length - possibleAnsPositionHolder - 1); possibleAns++)
                {
                    arrayOfPossibleAns[possibleAns] = cells[possibleAnsPositionHolder+possibleAns];
                }
                arrayOfPossibleAns = arrayOfPossibleAns.filter(item => item);
            }

            if(dataSection == 0)
            {
                var values = rows[singleRow].split(delimiter);
                values = values.filter(item => item);
                values = removeUnnecessarySpaces(values);
                surveyInfoArray.push(
                    headers.reduce(function (object, header, index) {
                        object[header] = values[index];
                        return object;
                        }, {})
                );
            }
            else if(dataSection == 1)
            {
                var values = rows[singleRow].split(delimiter, possibleAnsPositionHolder + 1);
                values = values.filter(item => item);
                values = removeUnnecessarySpaces(values);
                values[possibleAnsPositionHolder] = arrayOfPossibleAns;
                questionArray.push(
                    headers.reduce(function (object, header, index) {
                        object[header] = values[index];
                        return object;
                        }, {})
                );
            }
            else if(dataSection == 2)
            {
                var values = rows[singleRow].split(delimiter, possibleAnsPositionHolder + 1);
                values = values.filter(item => item);
                values = removeUnnecessarySpaces(values);
                values[possibleAnsPositionHolder] = arrayOfPossibleAns;
                subQuestionArray.push(
                    headers.reduce(function (object, header, index) {
                        object[header] = values[index];
                        return object;
                        }, {})
                );
            }
        }

        arrayOfPossibleAns = [];
    }
    array[0] = surveyInfoArray;
    array[1] = questionArray;
    array[2] = subQuestionArray;
    return array;
}

//This function removes spaces before and after provided values
function removeUnnecessarySpaces(array)
{
    for(var index = 0; index < array.length; index++)
    {
        array[index] = array[index].trim();
    }
    return array;
}

function getBackupFile()
{
    var url = 'Controller.php';
    var query = {page: 'AdminPage', command: 'DownloadBackupFromDB'};
    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        alert(result);
    });
}