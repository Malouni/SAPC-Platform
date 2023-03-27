<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "Oleg";
    $password = "asd123@#4";
    $dbname = "sciencestrategicplan";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $emailC = mysqli_real_escape_string($conn, $_POST["emailC"]);

    if ($email === $emailC) {
        $sql = "DELETE FROM UserTable WHERE UserName = '$email'";
        if ($conn->query($sql) === TRUE) {
            echo "User record deleted successfully";

            //Add the code to redirect to users page again
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Email and Confirm email do not match";
    }
    
    $conn->close();
}
?>
