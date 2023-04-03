<?php

function get_users_info()
{
    global $conn;

    $sql = "SELECT Fname, Lname, UserName, Position, Department FROM UserTable ORDER BY Fname ASC";
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

    $sql = "SELECT * FROM UserTable WHERE UserName = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

//This function creates a survey record and outputs its id from the SurveyTable table
function add_new_survey($survYear, $survName, $survDateStart, $survDateEnd, $position)
{
    global $conn;
    $lastUpdatedDate = date("Y/m/d");
    $AmPeopleFin = 0;


    $sql = "INSERT INTO SurveyTable (SurvYear, SurvName, SurvDateStart, SurvDateEnd, AmPeopleFin, LastUpdatedDate, Position) OUTPUT INSERTED.SurvID VALUES ('$survYear', '$survName', '$survDateStart', '$survDateEnd', '$AmPeopleFin', '$lastUpdatedDate', '$position')";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        return $row['SurvID'];
    }
    else
        return false;
}

function check_if_survey_exists($survYear, $survName)
{
    global $conn;

    $sql = "SELECT * FROM SurveyTable WHERE SurvYear = '$survYear' AND SurvName = '$survName'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

//This function creates a question record and outputs its id from the SurveyQuestions table
function add_survey_question($survID, $goal, $subGoal, $question, $type)
{
    global $conn;

    $sql = "INSERT INTO SurveyQuestions (SurvID, Goal, SubGoal, Question, Type) OUTPUT INSERTED.QuestionID VALUES ('$survID', '$goal', '$subGoal', '$question', '$type')";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        return $row['QuestionID'];
    }
    else
        return false;
}

//This function creates a SubQuestions record and outputs its id from the SurveyQuestions table
function add_survey_sub_question($survID, $questionID, $sub_Q)
{
    global $conn;

    $sql = "INSERT INTO SubQuestions (SurvID, QuestionID, Sub_Q ) OUTPUT INSERTED.SubQuestionID VALUES ('$survID', '$questionID', '$sub_Q')";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        return $row['SubQuestionID'];
    }
    else
        return false;
}

//This function adding a possible answer to a question into separate table
function add_possible_answer_to_question($survID, $questionID, $subQuestionID, $inputValue)
{
    global $conn;

    $sql = "INSERT INTO AnswerOptions (SurvID, QuestionID, SubQuestionID, InputValue) VALUES ('$survID', '$questionID', '$subQuestionID', '$inputValue')";
    $result = mysqli_query($conn, $sql);

    if ($result)
        return true;
    else
        return false;
}

//This function is returning all records from the SurveyTable
function get_surveys_info()
{
    global $conn;

    $sql = "SELECT SurvID, SurvYear, SurvName, SurvDateStart, SurvDateEnd, Position FROM SurveyTable ORDER BY SurvYear DESC";
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

//This function deletes the survey, as well as all dependencies from other tables using the cascading.
function delete_survey($survID)
{
    global $conn;

    $sql = "DELETE * FROM SurveyTable WHERE SurvID = '$survID'";
    $result = mysqli_query($conn, $sql);

    if ($result)
        return true;
    else
        return false;
}

//This function ..... TODO
function add_questions_to_new_survey($dataQuestions, $dataSubQuestions, $newSurvId)
{
    $result = true;
    for($lineQuestion = 0; $lineQuestion < count($dataQuestions) - 1; $lineQuestion++)
    {
        if($newQuestionId = add_survey_question($newSurvId, $dataQuestions[$lineQuestion]["Goal"], $dataQuestions[$lineQuestion]["SubGoal"], $dataQuestions[$lineQuestion]["Question"], $dataQuestions[$lineQuestion]["Type"],))
        {
            if($dataQuestions[$lineQuestion]["Type"] != "composed")
            {
                for($linePossibleAns = 0; $linePossibleAns < count($dataQuestions[$lineQuestion]["InputValue"]); $linePossibleAns++)
                {
                    if(!add_possible_answer_to_question($newSurvId, $newQuestionId, null, $dataQuestions[$lineQuestion]["InputValue"][$linePossibleAns]))
                    {
                        $result = false;
                        break;
                    }
                }
            }
            else
            {
                for($lineSubQuestion = 0; $lineSubQuestion < count($dataSubQuestions); $lineSubQuestion++)
                {
                    if($dataQuestions[$lineQuestion]["Question"] == $dataSubQuestions[$lineSubQuestion]["Sub_Q"])
                    {
                        if($newSubQuestionId = add_survey_sub_question($newSurvId, $newQuestionId, $dataSubQuestions[$lineSubQuestion]["Sub_Q"]))
                        {
                            for($linePossibleAns = 0; $linePossibleAns < count($dataSubQuestions[$lineSubQuestion]["InputValue"]); $linePossibleAns++)
                            {
                                if(!add_possible_answer_to_question($newSurvId, $newQuestionId, $newSubQuestionId, $dataSubQuestions[$lineSubQuestion]["InputValue"][$linePossibleAns]))
                                {
                                    $result = false;
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
        else
        {
            $result = false;
            break;
        }
    }
    return $result;
}



?>