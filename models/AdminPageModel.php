<?php

//This function gets the user information from bd
function get_users_info($searchString)
{

    global $conn;

    if($searchString == null)
    {
        $sql = "SELECT UserID, Fname, Lname, UserName, Position, Department
                FROM UserTable
                ORDER BY Fname ASC;";
        $stmt = mysqli_prepare($conn, $sql);
    }
    else
    {
        $userInfo = explode(',', $searchString);
        $sql = "SELECT UserID, Fname, Lname, UserName, Position, Department
                FROM UserTable
                WHERE Fname LIKE ? AND Lname LIKE ? ORDER BY Fname ASC;";


        $stmt = mysqli_prepare($conn, $sql);
        $fname = "{$userInfo[0]}%";
        $lname = "{$userInfo[1]}%";
        mysqli_stmt_bind_param($stmt, "ss", $fname, $lname);
    }

    $result = mysqli_stmt_execute($stmt);
    $data = [];

    if ($result) {
        $result_set = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result_set)) {
            $data[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $data;
    } else {
        mysqli_stmt_close($stmt);
        return $data[0] = "NoResults";
    }
}

//This function inserts a new user to user's table
function add_new_user($email, $fName, $lName, $userType, $department)
{
    global $conn;
    global $defaultPassword;

    $userType = strtolower($userType);

    $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO UserTable (UserName, Password, Fname, Lname, Position, Department) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $email, $hashedPassword, $fName, $lName, $userType, $department);
    $result = $stmt->execute();
    
    if ($result)
        return true;
    else
        return false;
}


//This function removes user from user table
function remove_user($userId)
{
    global $conn;
    $sql = "DELETE FROM UserTable WHERE UserID = ? RETURNING UserName AS UserName;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        return $row['UserName'];
    }
    else
        return false;
}

//This function checks if user exists in user's table
function check_if_user_exists($email)
{
    global $conn;
    $sql = "SELECT * FROM UserTable WHERE UserName = ?"; 
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
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

    $position = strtolower($position);

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

//This function function checks if the survey exists in survey table
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

    $type = strtolower($type);

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

    $subType = strtolower($subType);

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

//This function sets the subquestion id to null instead of zero, to the questions that does not have subquestions
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

    if($fieldToChange == 'Position')
    {
        $value = strtolower($value);
    }

    $sql = "UPDATE UserTable SET ".$fieldToChange." = ? WHERE UserID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $value, $userID);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0)
        return true;
    else
        return false;
}

//This function resets the user password
function rest_user_password($userID)
{
    global $conn;
    global $defaultPassword;

    $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);

    $sql = "UPDATE UserTable SET Password = ? WHERE UserID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $hashedPassword, $userID);
    $result = mysqli_stmt_execute($stmt);

    if ($result)
        return true;
    else
        return false;
}

//This function updates the specified field of survey
function update_survey($survID, $fieldToChange, $value)
{
    global $conn;

    if($fieldToChange == 'Position')
    {
        $value = strtolower($value);
    }

    // Prepare the statement
    $sql =  "UPDATE SurveyTable SET $fieldToChange = ? WHERE SurvID = ?";
    $stmt = mysqli_prepare($conn, $sql );
    mysqli_stmt_bind_param($stmt, 'si', $value, $survID);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        return true;
    } else {
        return false;
    }
}


//This function populates the report for the survey with default values
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

//This function return the column name correspond to specific string for user table
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

//This function return the column name correspond to specific string for survey table
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
            WHERE st.SurvID = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $survID);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0)
    {
        return true;
    }
    else
        return false;
}

function downloadBackUpFromDB()
{
    date_default_timezone_set('US/Pacific');
    $backup_file = $_SERVER['DOCUMENT_ROOT']."/backupFiles/".DB_NAME."_".date("Y-m-d_H-i-s").".sql";

    // Create the backup command
    $command = 'mysqldump --host='.DB_HOST.' --user='.DB_USER.' --password='.DB_PASS.' '.DB_NAME.' > '.$backup_file;

    //$command = "mysqldump --opt --host=".DB_HOST." --user=".DB_USER." --password=".DB_PASS." ".DB_NAME." --result-file=".$backup_file."";

    //$command='mysqldump -h=' .DB_HOST.' -u=' .DB_USER.' -p=' .DB_PASS.' ' .DB_NAME.' > ' .$backup_file;

    // Execute the backup command
    exec($command,$output,$worked);

    // Check the output if the command
    switch($worked){
        case 0:
            $result = 'The database:' .DB_NAME.' was successfully stored in the following path ';
        break;

        case 1:
            $result = 'An error occurred when exporting: '.DB_NAME.' zu '.$backup_file.'';
            //unlink($backup_file);
        break;

        case 2:
            $result = 'An error occurred when exporting: '.DB_NAME.'';
            //unlink($backup_file);
        break;
    }

    // Check if the backup file was created successfully
    return $result;
}

function backUpFiles()
{
    $files = array_values(array_diff(scandir($_SERVER['DOCUMENT_ROOT']."/backupFiles/"), array('.', '..')));

    return $files;
}

function applyChosenFileToRestoreDB($chosenFile)
{
    global $conn;

    $sql = "CREATE OR REPLACE DATABASE ".DB_NAME.";";
    $result = mysqli_query($conn, $sql);

    if ($result)
    {
        $files = array_values(array_diff(scandir($_SERVER['DOCUMENT_ROOT']."/backupFiles/"), array('.', '..')));

        //Please do not change the following points
        //Import of the database and output of the status
        $command='mysql --host=' .DB_HOST.' --user='.DB_USER.' --password='.DB_PASS.' '.DB_NAME.' < ' .$_SERVER['DOCUMENT_ROOT']."/backupFiles/".$files[$chosenFile];
        exec($command,$output,$worked);
        switch($worked){
            case 0:
                $result = 'The data from the file' .$files[$chosenFile].' were successfully imported into the database '.DB_NAME.'';
            break;

            case 1:
                $result = 'An error occurred during the import, please try again';
            break;
    }


        return $result;
    }
    else
        return $result = 'An error occurred during the import, please try again';;

}

//This function goes through the array that was sent to controller and adds each question with the subquestion to the database
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