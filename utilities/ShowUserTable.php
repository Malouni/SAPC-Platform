<?php
$servername = "localhost";
$username = "Oleg";
$password = "asd123@#4";
$dbname = "sciencestrategicplan";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Fname, Lname, UserName, Position FROM UserTable ORDER BY Fname ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>User First Name</th>
                    <th>User Last Name</th>
                    <th>Institutional Email</th>
                    <th>User Type</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['Fname']}</td>
                <td>{$row['Lname']}</td>
                <td>{$row['UserName']}</td>
                <td>{$row['Position']}</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "0 results";
}

$conn->close();
?>
