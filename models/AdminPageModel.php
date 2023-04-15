<?php

function get_users_info()
{
    global $conn;

    $sql = "SELECT UserID, Fname, Lname, UserName, Position, Department FROM UserTable ORDER BY Fname ASC";
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
    global $defaultPassword;

    $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);
    $sql = "INSERT INTO UserTable (UserName, Password, Fname, Lname, Position, Department) VALUES ('$email', '$hashedPassword', '$fName', '$lName', '$userType', '$department')";
    $result = mysqli_query($conn, $sql);

    if ($result)
        return true;
    else
        return false;
}

function remove_user($userId)
{
    global $conn;
    $sql = "DELETE FROM UserTable WHERE UserID = '$userId' RETURNING UserName AS UserName;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        return $row['UserName'];
    }
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


    $sql = "INSERT INTO SurveyTable (SurvYear, SurvName, SurvDateStart, SurvDateEnd, TotalAnswersAvg, LastUpdatedDate, Position)
            VALUES ('$survYear', '$survName', '$survDateStart', '$survDateEnd', '$AmPeopleFin', '$lastUpdatedDate', '$position')";
    $result = mysqli_query($conn, $sql);

    if ($result)
    {
        $sql = "SELECT SurvID FROM SurveyTable
                WHERE SurvYear = '$survYear' AND SurvName = '$survName' and Position = '$position'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            return $row['SurvID'];
        }
        else
            return false;
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

    $sql = "INSERT INTO SurveyQuestions (SurvID, Goal, SubGoal, Question, Type)
            VALUES ('$survID', '$goal', '$subGoal', '$question', '$type')";
    $result = mysqli_query($conn, $sql);

    if ($result)
    {
        $sql = "SELECT QuestionID FROM SurveyQuestions
                WHERE SurvID = '$survID' AND Goal = '$goal' and SubGoal = '$subGoal' and Question = '$question' and Type = '$type'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            return $row['QuestionID'];
        }
        else
            return false;
    }
    else
        return false;
}

//This function creates a SubQuestions record and outputs its id from the SurveyQuestions table
function add_survey_sub_question($survID, $questionID, $sub_Q, $subType)
{
    global $conn;

    $sql = "INSERT INTO SubQuestions (SurvID, QuestionID, Sub_Q, SubType)
            VALUES ('$survID', '$questionID', '$sub_Q', '$subType')";
    $result = mysqli_query($conn, $sql);

    if ($result)
    {
        $sql = "SELECT SubQuestionID FROM SubQuestions
                WHERE SurvID = '$survID' AND QuestionID = '$questionID' and Sub_Q = '$sub_Q'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            return $row['SubQuestionID'];
        }
        else
            return false;
    }
    else
        return false;
}

//This function adding a possible answer to a question into separate table
function add_possible_answer_to_question($survID, $questionID, $subQuestionID, $inputValue)
{
    global $conn;

    $sql = "INSERT INTO AnswerOptions (SurvID, QuestionID, SubQuestionID, InputValue)
            VALUES ('$survID', '$questionID', '$subQuestionID', '$inputValue')";
    $result = mysqli_query($conn, $sql);

    if ($result)
        return true;
    else
        return false;
}

function update_table_where_subQstID_is_zero ($tableName)
{
    global $conn;

    $sql = "UPDATE ".$tableName."
            SET SubQuestionID = NULL
            WHERE SubQuestionID = 0;";
    $result = mysqli_query($conn, $sql);

    if ($result)
    {
        return true;
    }
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
        return $data[0] = "NoResults";
}

//This function updates the specific column chosen by the admin tools
function update_user($userID, $fieldToChange, $value)
{
    global $conn;

    $sql = "UPDATE UserTable SET ".$fieldToChange." = '$value'  WHERE UserID = '$userID'";
    $result = mysqli_query($conn, $sql);

    if ($result)
        return true;
    else
        return false;
}

function rest_user_password($userID)
{
    global $conn;

    //This is the field for changing the default password for new users
    $defaultPassword = "password";
    $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);

    $sql = "UPDATE UserTable SET Password = '$hashedPassword' WHERE UserID = '$userID'";
    $result = mysqli_query($conn, $sql);

    if ($result)
        return true;
    else
        return false;
}

function update_survey($survID, $fieldToChange, $value)
{
    global $conn;

    $sql = "UPDATE SurveyTable SET ".$fieldToChange." = '$value'  WHERE SurvID = '$survID'";
    $result = mysqli_query($conn, $sql);

    if ($result)
        return true;
    else
        return false;
}

function populate_survey_report_table($survID, $questionID, $subQuestionID)
{
    global $conn;

    $sql = "INSERT INTO SurveyReport (SurvID, QuestionID, SubQuestionID, Answer_Percentage, Activity_Involvement, Activity_Historical)
            VALUES ('$survID', '$questionID', '$subQuestionID', 0, 0 ,0)";
    $result = mysqli_query($conn, $sql);

    if ($result)
        return true;
    else
        return false;
}

function get_the_column_name_user($rawData)
{
    if($rawData == "First Name")
        return "Fname";
    else if ($rawData == "Last Name")
        return "Lname";
    else if ($rawData == "Email")
        return "UserName";
    else if ($rawData == "Position")
        return "Position";
    else if ($rawData == "Department")
        return "Department";
    else
        return false;
}

function get_the_column_name_survey($rawData)
{
    if($rawData == "Survey Name")
        return "SurvName";
    else if ($rawData == "Survey Year")
        return "SurvYear";
    else if ($rawData == "Survey Date Start")
        return "SurvDateStart";
    else if ($rawData == "Survey Date End")
        return "SurvDateEnd";
    else if ($rawData == "Position")
        return "Position";
    else
        return false;
}

//This function deletes the survey, as well as all dependencies from other tables using the cascading.
function delete_survey($survID)
{
    global $conn;

    $sql = "DELETE st, survQ, sq, an , aoq, aosb, ua, sqa, sp FROM surveytable st
                LEFT JOIN surveyquestions as survQ
                ON st.SurvID = survQ.SurvID
                LEFT JOIN subquestions as sq
                ON survQ.QuestionID = sq.QuestionID
                LEFT JOIN answernotes as an
                ON survQ.QuestionID = an.QuestionID
                LEFT JOIN answeroptions as aoq
                ON survQ.QuestionID = aoq.QuestionID
                LEFT JOIN answeroptions as aosb
                ON sq.SubQuestionID = aosb.SubQuestionID
                LEFT JOIN useranswer as ua
                ON survQ.QuestionID = ua.QuestionID
                LEFT JOIN subquestionanswer as sqa
                ON sq.SubQuestionID = sqa.SubQuestionID
                LEFT JOIN surveyreport as sp
                ON st.SurvID = sp.SurvID
WHERE st.SurvID = '$survID'";
    $result = mysqli_query($conn, $sql);

    if ($result)
        return true;
    else
        return false;
}

function add_questions_to_new_survey($dataQuestions, $dataSubQuestions, $newSurvId)
{
    $result = true;
    for($lineQuestion = 0; $lineQuestion < count($dataQuestions); $lineQuestion++)
    {
        if($newQuestionId = add_survey_question($newSurvId, $dataQuestions[$lineQuestion]["Goal"], $dataQuestions[$lineQuestion]["SubGoal"], $dataQuestions[$lineQuestion]["Question"], $dataQuestions[$lineQuestion]["Type"],))
        {
            if($dataQuestions[$lineQuestion]["Type"] != "composed" && $dataQuestions[$lineQuestion]["Type"] != "single_short")
            {
                if(populate_survey_report_table($newSurvId, $newQuestionId, NULL))
                {
                    for($linePossibleAns = 0; $linePossibleAns < count($dataQuestions[$lineQuestion]["PossibleAnswers"]); $linePossibleAns++)
                    {
                        if(!add_possible_answer_to_question($newSurvId, $newQuestionId, NULL, $dataQuestions[$lineQuestion]["PossibleAnswers"][$linePossibleAns]))
                        {
                            $result = false;
                            break;
                        }
                    }
                }
                else
                {
                    $result = false;
                    break;
                }
            }
            else if($dataQuestions[$lineQuestion]["Type"] == "single_short")
            {
                if(!populate_survey_report_table($newSurvId, $newQuestionId, NULL))
                {
                    $result = false;
                    break;
                }
            }
            else
            {
                for($lineSubQuestion = 0; $lineSubQuestion < count($dataSubQuestions); $lineSubQuestion++)
                {
                    if($dataQuestions[$lineQuestion]["Question"] == $dataSubQuestions[$lineSubQuestion]["Question"])
                    {
                        if($newSubQuestionId = add_survey_sub_question($newSurvId, $newQuestionId, $dataSubQuestions[$lineSubQuestion]["Sub_Q"], $dataSubQuestions[$lineSubQuestion]["SubType"]))
                        {
                            if(populate_survey_report_table($newSurvId, $newQuestionId, $newSubQuestionId))
                            {
                                if($dataSubQuestions[$lineSubQuestion]["SubType"] != "short")
                                {
                                    for($linePossibleAns = 0; $linePossibleAns < count($dataSubQuestions[$lineSubQuestion]["PossibleAnswers"]); $linePossibleAns++)
                                    {
                                        if(!add_possible_answer_to_question($newSurvId, $newQuestionId, $newSubQuestionId, $dataSubQuestions[$lineSubQuestion]["PossibleAnswers"][$linePossibleAns]))
                                        {
                                            $result = false;
                                            break;
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
                        else
                        {
                            $result = false;
                            break;
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