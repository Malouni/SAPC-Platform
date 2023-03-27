<?php
if (isset($_FILES["csvfile"])) {
    $servername = "localhost";
    $username = "Oleg";
    $password = "asd123@#4";
    $dbname = "sciencestrategicplan";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $file = $_FILES["csvfile"]["tmp_name"];
    if ($_FILES["csvfile"]["type"] !== 'text/csv') {
        echo "Error: Invalid file type. Please upload a CSV file.";
    } else {
        $csvFile = fopen($file, 'r');
        fgetcsv($csvFile); // Skipping header line
        
        $uploadLog = "";
        while (($line = fgetcsv($csvFile)) !== FALSE) {
            $fname = mysqli_real_escape_string($conn, $line[0]);
            $lname = mysqli_real_escape_string($conn, $line[1]);
            $email = mysqli_real_escape_string($conn, $line[2]);
            $userType = mysqli_real_escape_string($conn, $line[3]);
            $department = mysqli_real_escape_string($conn, $line[4]);

            // Check if user already exists
            $checkUserSql = "SELECT UserID FROM UserTable WHERE UserName = '$email'";
            $checkUserResult = $conn->query($checkUserSql);
            if ($checkUserResult->num_rows > 0) {
                $uploadLog .= "User already exists: {$fname} {$lname}<br>";
                continue;
            }

            // Set a default password for all new users
            $defaultPassword = "password";
            
            $sql = "INSERT INTO UserTable (UserName, Password, Fname, Lname, Position, Department) VALUES ('$email', '$defaultPassword', '$fname', '$lname', '$userType', '$department')";
            if ($conn->query($sql) === TRUE) {
                $uploadLog .= "New user record created successfully: {$fname} {$lname}<br>";
            } else {
                echo $uploadLog;
                echo "User upload error, check CSV file format";
            }
        }
        
        fclose($csvFile);
    }
    
    $conn->close();
}
?>

