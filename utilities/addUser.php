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
    
    $fName = mysqli_real_escape_string($conn, $_POST["fName"]);
    $lName = mysqli_real_escape_string($conn, $_POST["lName"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $emailC = mysqli_real_escape_string($conn, $_POST["emailC"]);
    $userType = mysqli_real_escape_string($conn, $_POST["userType"]);
    $department = mysqli_real_escape_string($conn, $_POST["department"]);

    if ($email === $emailC) {
        // Set a default password for all new users
        $defaultPassword = "changeme";
        $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);

        $sql = "INSERT INTO UserTable (UserName, Password, Fname, Lname, Position, Department) VALUES ('$email', '$hashedPassword', '$fName', '$lName', '$userType', '$department')";
        if ($conn->query($sql) === TRUE) {
            echo "New user record created successfully";

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
