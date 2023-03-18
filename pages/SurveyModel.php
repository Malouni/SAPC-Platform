<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'Oleg');
define('DB_PASS', 'asd123@#4');
define('DB_NAME', 'sciencestrategicplan');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//Questions Loading
function loadQuestions($SurvID)
{  
    global $conn;
    
    // Upadte the answer to database 
    $Q_ID = "Q". $Question_ID; 
    $sql = "UPDATE UserAnswer SET '$Q_ID' ='$Answers' WHERE TruID = '$truid' AND  SurvID = '$SurvID'";
   

}








//Update the user answer everytime they click Next 
function AnswersUpadte($truid , $SurveyID , $Question , $Answers)
{
    global $conn;
    
    // Upadte the answer to database 
    $Q_ID = "Q". $Question; 
    $sql = "UPDATE UserAnswer SET '$Q_ID' ='$Answers' WHERE TruID = '$truid' AND  SurveyID = '$SurveyID'";
   
    //check the update success(+1) or not(-1) 
    if (mysqli_query($conn, $sql)) 
    {
        return 1;
    } else 
        return -1;    

}

// Load the user answers everytime they click Back.
function AnswersLoad($truid , $SurveyID, $Question)
{
    global $conn;
    
    // Load the answer to database 
    $Q_ID = "Q". $Question; 
    $sql = "SELECT '$Q_ID' FROM UserAnswer WHERE TruID = '$truid' AND  SurveyID = '$SurveyID'";
    $result = mysqli_query($conn, $sql);
   
    //Check and return the answers 
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        return $row[0];
    } else
        return -1;
    
}

//Update the user progress 
function ProgressUpdate($truid , $SurveyID)
{
    global $conn;

    //Calculate the progress
    $sql_check = "SELECT COUNT() FROM UserAnswer WHERE TruID = '$truid' AND  SurveyID = '$SurveyID' AND ";
    
    // Upadte the progress to database 
    $sql = "UPDATE UserAnswer SET Progress ='$Answers' WHERE TruID = '$truid' AND  SurveyID = '$SurveyID'";
   
}

?>

