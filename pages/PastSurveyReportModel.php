<?php

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

function get_survey_report()
{
    global $conn;

    $sql = "select * from SurveyReportTable";
    $result = mysqli_query($conn, $sql);
    $data = [];
    
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        $data[] = $row;
        return $data;
    }
    else
        return false;
}

function get_surveys_documents()
{
    global $conn;

    $sql = "select * from SurveyReportTable";
    $result = mysqli_query($conn, $sql);
    $data = [];

    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        $data[] = $row;
        return $data;
    }
    else
        return false;
}





?>