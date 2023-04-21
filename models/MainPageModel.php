<?php

//This function returns the upcoming surveys, with non expired due dates and for a specific user position
function get_upcoming_surveys($userid, $userPosition)
{
    global $conn;

    $date = date('Y-m-d');

    if($userPosition == 'chair' || $userPosition == 'Chair' || $userPosition == 'CHAIR')
    {
        $sql = "SELECT SurveyTable.SurvID, SurveyTable.SurvName
                FROM SurveyTable
                WHERE SurveyTable.SurvDateEnd >= '$date' and SurveyTable.Position != 'admin' ";
    }
    else
    {
        $sql = "SELECT SurveyTable.SurvID, SurveyTable.SurvName
                FROM SurveyTable
                INNER JOIN UserTable
                ON SurveyTable.Position = UserTable.Position
                WHERE SurveyTable.SurvDateEnd >= '$date' and UserTable.UserID = '$userid'";
    }
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
            $data[] = $row;
        return $data;
    }
    else
        return $data[0] = "NoResults";
}

//This function returns the surveys, completed by the user
function get_surveys_completed_by_user($userid)
{
    global $conn;

    $sql = "SELECT DISTINCT rt.SurvID, rt.SurvName
            FROM
            (SELECT SurveyTable.SurvID, SurveyTable.SurvName
            FROM SurveyTable
            INNER JOIN UserTable
            ON SurveyTable.Position = UserTable.Position
            INNER JOIN useranswer
            ON UserTable.UserID = useranswer.UserID
            WHERE UserTable.UserID = '$userid')rt";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
            $data[] = $row;
        return $data;
    }
    else
        return $data[0] = "NoResults";
}

?>