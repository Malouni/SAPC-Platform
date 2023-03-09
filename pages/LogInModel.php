<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'Oleg');
define('DB_PASS', 'asd123@#4');
define('DB_NAME', 'sciencestrategicplan');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

function check_validity($truid, $password)
{
    global $conn;

    $sql = "select * from usertable where TruID = '$truid' and Password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function get_user_first_name ($truid)
{
    global $conn;

    $sql = "select * from usertable where TruID = '$truid'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Fname'];
    } else
        return -1;
}

function get_user_last_name ($truid)
{
    global $conn;

    $sql = "select * from usertable where TruID = '$truid'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Lname'];
    } else
        return -1;
}

function get_user_position ($truid)
{
    global $conn;

    $sql = "select * from usertable where TruID = '$truid'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Position'];
    } else
        return -1;
}



?>