<?php
// Database connection
$servername = "localhost";
$username = "Oleg";
$password = "asd123@#4";
$dbname = "sciencestrategicplan";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// UserTable query
$UserTableSQL = "CREATE TABLE IF NOT EXISTS UserTable (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    UserName varchar(100),
    Password char(60),
    Fname varchar(100),
    Lname varchar(100),
    Position varchar(100),
    Department varchar(100)
)";

$SurveyTableSQL = "CREATE TABLE IF NOT EXISTS SurveyTable (
    SurvID INT PRIMARY KEY AUTO_INCREMENT,
    SurvYear SMALLINT,
    SurvName varchar(100),
    SurvDateStart DATE,
    SurvDateEnd DATE,
    AmPeopleFin INT,
    LastUpdatedDate DATE,
    Position varchar(100)
  )";

  // SurveyQuestionsTable query 
$SurveyQuestionsTableSQL = "CREATE TABLE IF NOT EXISTS SurveyQuestions (
    QuestionID INT PRIMARY KEY AUTO_INCREMENT,
    SurvID INT,
    Goal VARCHAR(200),
    SubGoal VARCHAR(200),
    Question VARCHAR(200),
    Type VARCHAR(200)
)";

//SubQuestions query
$SubQuestionsTableSQL = "CREATE TABLE IF NOT EXISTS SubQuestions (
    SubQuestionID INT PRIMARY KEY AUTO_INCREMENT,
    SurvID INT,
    QuestionID INT,
    Sub_Q VARCHAR(200)
)";

//Options for possible answers
$AnswerOptions = "CREATE TABLE IF NOT EXISTS AnswerOptions(
    SurvID INT,
    QuestionID INT,
    SubQuestionID INT,
    InputValue varchar(200)
)";





// SurveyReportTable query
$SurveyReportSQL = "CREATE TABLE IF NOT EXISTS SurveyReport (
    SurvID INT,
    QuestionID INT,
    SubQuestionID INT,
    Answer_Percentage Float,
    Activity_Involvement TINYINT,
    Activity_Historical TINYINT
)";

// SurveyUserTable query
$UserAnswerSQL = "CREATE TABLE IF NOT EXISTS UserAnswer(
    UserID INT,
    QuestionID INT,
    SurvID INT,
    Answer INT
)";

//subquestions answers table
$SQAnswerSQL = "CREATE TABLE IF NOT EXISTS SubQuestionAnswer (
    UserID INT,
    QuestionID INT,
    SubQuestionID INT,
    Answer INT
); ";

//answer notes table
$AnswerNotesSQL = " CREATE TABLE IF NOT EXISTS AnswerNotes (
    NoteID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    QuestionID INT,
    NoteText TEXT
);";



// execute the query and check for errors
if ($conn->query($UserTableSQL) === TRUE) {
    echo "Table UserTable created successfully\n<br>";
}

if ($conn->query($SurveyTableSQL) === TRUE) {
    echo "Table SurveyTable created successfully\n<br>";
}

if ($conn->query($SurveyQuestionsTableSQL) === TRUE) {
    echo "Table SurveyQuestions created successfully\n<br>";
}

if ($conn->query($SubQuestionsTableSQL) === TRUE) {
    echo "Table SubQuestion created successfully\n<br>";
}

if ($conn->query($SurveyReportSQL) === TRUE) {
    echo "Table SurveyReport created successfully\n<br>";
}

if ($conn->query($UserAnswerSQL) === TRUE) {
    echo "Table UserAnswer created successfully\n<br>";
}

if ($conn->query($SQAnswerSQL) === TRUE) {
    echo "Table Sub-Question answers created successfully\n<br>";
}

if ($conn->query($AnswerNotesSQL) === TRUE) {
    echo "Table answer-notes created successfully\n<br>";
}

if ($conn->query($AnswerOptions) === TRUE) {
    echo "Table answer-options created successfully\n<br>";
}

// close the database connection
mysqli_close($conn);
