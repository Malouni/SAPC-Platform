<?php

function get_users_info()
{
    global $conn;

    $sql = "SELECT Fname, Lname, UserName, Position FROM UserTable ORDER BY Fname ASC";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
            $data[] = $row;
        return $data;
    }
    else
        return $data[0] = "Failed";
}

function add_new_user($email, $fName, $lName, $userType, $department)
{
    global $conn;
    $defaultPassword = "changeme";
    $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);
    $sql = "INSERT INTO UserTable (UserName, Password, Fname, Lname, Position, Department) VALUES ('$email', '$hashedPassword', '$fName', '$lName', '$userType', '$department')";
    $result = mysqli_query($conn, $sql);

    if ($result)
        return true;
    else
        return false;
}

function remove_user($email)
{
    global $conn;
    $sql = "DELETE FROM UserTable WHERE UserName = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result)
        return true;
    else
        return false;
}

function check_if_user_exists($email)
{
    global $conn;

    $sql = "select * from UserTable where UserName = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else
        return false;
}



?>