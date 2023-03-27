document.addEventListener("DOMContentLoaded", function(){
    showUsersTable ();
});


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
                userTable += "<td>" + result[row]['Fname'] + "</td>";
                userTable += "<td>" + result[row]['Lname'] + "</td>";
                userTable += "<td>" + result[row]['UserName'] + "</td>";
                userTable += "<td>" + result[row]['Position'] + "</td>";
                userTable += "</tr>";
            }
            userTable += "</tbody></table>";
        }

        $('#user-table').html(userTable);
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
        var query = {page: 'AdminPage', command: 'csvAddUsers', usersData: data};
        $.post(url, query, function(data) {
        var result = JSON.parse(data);
        alert(result);
        showUsersTable();
        });
    };
}

function csvToArray(text)
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