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
    Position varchar(100)
  )";

// SurveyUserTable query
$UserAnswerSQL = "CREATE TABLE IF NOT EXISTS UserAnswer (
    AnswID INT PRIMARY KEY AUTO_INCREMENT,
    SurvID INT,
    UserID INT,
    Progress float,
    Q0 TINYINT,
    Q1 TINYINT,
    Q2 TINYINT,
    Q3_1 TINYINT,
    Q3_2 TINYINT,
    Q4 TINYINT,
    Q5 TINYINT,
    Q6_1 INT,
    Q6_2 INT,
    Q6_3 INT,
    Q6_4 INT,
    Q6_5 INT,
    Q7_1 INT,
    Q7_2 INT,
    Q7_3 INT,
    Q7_4 INT,
    Q7_5 INT,
    Q8 TINYINT,
    Q9 INT,
    Q10 TINYINT,
    Q11 TINYINT,
    Q12_1 TINYINT,
    Q12_2 TINYINT,
    Q12_3 TINYINT,
    Q12_4 TINYINT,
    Q13_1 TINYINT,
    Q13_2 TINYINT,
    Q14_1 TINYINT,
    Q14_2 TINYINT,
    Q15 TINYINT,
    Q16 TINYINT,
    Q1_note TEXT,
    Q2_note TEXT,
    Q3_note TEXT,
    Q4_note TEXT,
    Q5_note TEXT,
    Q6_note TEXT,
    Q7_note TEXT,
    Q8_note TEXT,
    Q9_note TEXT,
    Q10_note TEXT,
    Q11_note TEXT,
    Q12_note TEXT,
    Q13_note TEXT,
    Q14_note TEXT,
    Q15_note TEXT,
    Q16_note TEXT
)";


// SurveyQuestionsTable query 
$SurveyQuestionsTableSQL = "CREATE TABLE IF NOT EXISTS SurveyQuestions (
    SurvID INT,
    QuestionID INT,
    Goal VARCHAR(200),
    SubGoal VARCHAR(200),
    Question VARCHAR(200),
    Sub_Q1 VARCHAR(200),
    Sub_Q2 VARCHAR(200),
    Sub_Q3 VARCHAR(200),
    Sub_Q4 VARCHAR(200),
    Type VARCHAR(200)
)";

// SurveyReportTable query
$SurveyReportSQL = "CREATE TABLE IF NOT EXISTS SurveyReport (
    SurvID INT,
    QuestionID INT,
    Activity VARCHAR(200),
    Activity_Involvement TINYINT,
    Activity_Historical TINYINT
)";



// execute the query and check for errors
if ($conn->query($UserTableSQL) === TRUE) {
    echo "Table UserTable created successfully\n";
}

if ($conn->query($SurveyTableSQL) === TRUE) {
    echo "Table SurveyTable created successfully\n";
}

if ($conn->query($UserAnswerSQL) === TRUE) {
    echo "Table UserAnswer created successfully\n";
}

if ($conn->query($SurveyQuestionsTableSQL) === TRUE) {
    echo "Table SurveyQuestions created successfully\n";
}

if ($conn->query($SurveyReportSQL) === TRUE) {
    echo "Table SurveyReport created successfully\n";
}

// close the database connection
mysqli_close($conn);

?>




