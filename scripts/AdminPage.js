document.addEventListener("DOMContentLoaded", function(){
    showUsersTable ();
});

//Button click listeners
$('#addNewUser').click(addNewUser);
$('#deleteUser').click(removeUser);
$('#csvFileSend').click(addUsersFromFile);

//Functions
function showUsersTable(){
    var url = 'Controller.php';

    var query = {page: 'AdminPage', command: 'UserTable'};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);

        var userTable = "";

        if(result == "NoResults")
        {
            userTable += "<table border='1'>";
            userTable += "<thead>";
            userTable += "<tr>";
            userTable += "<th>User First Name</th>";
            userTable += "<th>User Last Name</th>";
            userTable += "<th>Institutional Email</th>";
            userTable += "<th>User Type</th>";
            userTable += "</tr>";
            userTable += "</thead>";
            userTable += "<tbody>";
        }
        else
        {
            userTable += "<table border='1'>";
            userTable += "<thead>";
            userTable += "<tr>";
            userTable += "<th>User First Name</th>";
            userTable += "<th>User Last Name</th>";
            userTable += "<th>Institutional Email</th>";
            userTable += "<th>User Type</th>";
            userTable += "</tr>";
            userTable += "</thead>";
            userTable += "<tbody>";
            for (var row = 0; row < result.length; row++) {

                userTable += "<tr>";
                userTable += "<td>"+$row['Fname']+"</td>";
                userTable += "<td>"+$row['Lname']+"</td>";
                userTable += "<td>"+$row['UserName']+"</td>";
                userTable += "<td>"+$row['Position']+"</td>";
                userTable += "</tr>";
            }
            userTable += "</tbody></table>";
        }

        $('#user-table').html(userTable);
    });
}



function addNewUser(){
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

function removeUser(){
    var url = 'Controller.php';
    var query = {page: 'AdminPage', command: 'RemoveUser', EmailDelete: $("#emailDelete").val(),
                                                           EmailConDelete: $("#emailCDelete").val()};
    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        alert(result);
        showUsersTable();
    });
}

function addUsersFromFile(){

    const csvFile = $("#csvFile").val();
    const input = csvFile.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        const text = e.target.result;
        const data = csvToArray(text);
        alert(data);

        var url = 'Controller.php';
        var query = {page: 'AdminPage', command: 'csvAddUsers', usersData: data};
        $.post(url, query, function(data) {
        var result = JSON.parse(data);
        alert(result);
        showUsersTable();
        });
    };

    reader.readAsText(input);
}

function csvToArray(text)
{
    var delimiter = ",";

    const headers = text.slice(0, text.indexOf("\n")).split(delimiter);

    // slice from \n index + 1 to the end of the text
    // use split to create an array of each csv value row
    const rows = text.slice(text.indexOf("\n") + 1).split("\n");

    // Map the rows
    // split values from each row into an array
    // use headers.reduce to create an object
    // object properties derived from headers:values
    // the object passed as an element of the array
    const arr = rows.map(function (row) {
      const values = row.split(delimiter);
      const el = headers.reduce(function (object, header, index) {
        object[header] = values[index];
        return object;
      }, {});
      return el;
    });

    // return the array
    return arr;
}