<?php

//This function return the password of a specified user
function get_users_password($userName)
{
    global $conn;

    $sql = "SELECT * FROM UserTable WHERE UserName = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userName);
    $stmt->execute();

    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0)
    {
        $row = $result->fetch_assoc();
        return $row['Password'];
    }
    else
        return false;
}

//This function return the First Name of a specified user
function get_user_first_name ($userName)
{
    global $conn;

    $sql = "SELECT * FROM UserTable WHERE UserName = '$userName'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Fname'];
    } else
        return -1;
}

//This function return the Last Name of a specified user
function get_user_last_name ($userName)
{
    global $conn;

    $sql = "SELECT * FROM UserTable WHERE UserName = '$userName'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Lname'];
    } else
        return -1;
}

//This function return the Position of a specified user
function get_user_position ($userName)
{
    global $conn;

    $sql = "SELECT * FROM UserTable WHERE UserName = '$userName'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Position'];
    } else
        return -1;
}

//This function return the user id of a specified user
function get_user_id ($userName)
{
    global $conn;
    $sql = "SELECT * FROM UserTable WHERE UserName = '$userName'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['UserID'];
    } else
        return -1;
}

//This function changes the password of a specified user
function change_user_password($userID, $newPassword)
{
    global $conn;

    $sql = "UPDATE UserTable SET Password = '$newPassword' WHERE UserID = '$userID'";
    $result = mysqli_query($conn, $sql);
    if ($result)
    {
        return true;
    }
    else
        return false;
}

function getIp()
{
    return 1;
}

function getAttemptsFromIp($ip)
{
    return 1;
}


?>