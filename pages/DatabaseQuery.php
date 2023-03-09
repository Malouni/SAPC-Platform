<?php
// Database connection
$servername = "localhost";
$username = "yourusername";
$password = "yourpassword";
$dbname = "yourdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// UserTable query
$UserTableSQL = "CREATE TABLE IF NOT EXISTS UserTable (
  TruID varchar(15) PRIMARY KEY,
  Password char(60),
  Fname varchar(100),
  Lname varchar(100),
  Position varchar(100),
  Department varchar(100)
)";


// SurveyUserTable query 
$SurveyUserTableSQL = "CREATE TABLE IF NOT EXISTS SurveyUserTable (
    TruID VARCHAR(15) PRIMARY KEY,
    Progress TINYINT,
    Year SMALLINT,
    SurveyName VARCHAR(100),
    DateStart DATE,
    DateEnd DATE,
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
$SurveyQuestionsTableSQL = "CREATE TABLE IF NOT EXISTS SurveyQuestionsTable (
    Year SMALLINT PRIMARY KEY,
    SurveyName VARCHAR(100),
    DateStart DATE,
    DateEnd DATE,
    Goal1 VARCHAR(200),
    Goal2 VARCHAR(200),
    Goal3 VARCHAR(200),
    Goal4 VARCHAR(200),
    Q0 VARCHAR(200),
    Q1 VARCHAR(200),
    Q2 VARCHAR(200),
    Q3 VARCHAR(200),
    Q4 VARCHAR(200),
    Q5 VARCHAR(200),
    Q6 VARCHAR(200),
    Q7 VARCHAR(200),
    Q8 VARCHAR(200),
    Q9 VARCHAR(200),
    Q10 VARCHAR(200),
    Q11 VARCHAR(200),
    Q12 VARCHAR(200),
    Q13 VARCHAR(200),
    Q14 VARCHAR(200),
    Q15 VARCHAR(200),
    Q16 VARCHAR(200),
    Q0_Type VARCHAR(100),
    Q1_Type VARCHAR(100),
    Q2_Type VARCHAR(100),
    Q3_Type VARCHAR(100),
    Q4_Type VARCHAR(100),
    Q5_Type VARCHAR(100),
    Q6_Type VARCHAR(100),
    Q7_Type VARCHAR(100),
    Q8_Type VARCHAR(100),
    Q9_Type VARCHAR(100),
    Q10_Type VARCHAR(100),
    Q11_Type VARCHAR(100),
    Q12_Type VARCHAR(100),
    Q13_Type VARCHAR(100),
    Q14_Type VARCHAR(100),
    Q15_Type VARCHAR(100),
    Q16_Type VARCHAR(100)
)";

// SurveyReportTable query 
$SurveyReportTableSQL = "CREATE TABLE IF NOT EXISTS SurveyReportTable (
    Year SMALLINT PRIMARY KEY,
    SurveyName VARCHAR(100),
    DateStart DATE,
    DateEnd DATE,
    Goal_Achievement TINYINT,
    Survey_Answer TINYINT,
    Activity0 VARCHAR(200),
    Activity0_Involement TINYINT,
    Activity0_Hidtorical TINYINT,
    Activity1 VARCHAR(200),
    Activity1_Involement TINYINT,
    Activity1_Hidtorical TINYINT,
    Activity2 VARCHAR(200),
    Activity2_Involement TINYINT,
    Activity2_Hidtorical TINYINT,
    Activity3 VARCHAR(200),
    Activity3_Involement TINYINT,
    Activity3_Hidtorical TINYINT,
    Activity4 VARCHAR(200),
    Activity4_Involement TINYINT,
    Activity4_Hidtorical TINYINT,
    Activity5 VARCHAR(200),
    Activity5_Involement TINYINT,
    Activity5_Hidtorical TINYINT,
    Activity6 VARCHAR(200),
    Activity6_Involement TINYINT,
    Activity6_Hidtorical TINYINT,
    Activity7 VARCHAR(200),
    Activity7_Involement TINYINT,
    Activity7_Hidtorical TINYINT,
    Activity8 VARCHAR(200),
    Activity8_Involement TINYINT,
    Activity8_Hidtorical TINYINT,
    Activity9 VARCHAR(200),
    Activity9_Involement TINYINT,
    Activity9_Hidtorical TINYINT,
    Activity10 VARCHAR(200),
    Activity10_Involement TINYINT,
    Activity10_Hidtorical TINYINT,
    Activity11 VARCHAR(200),
    Activity11_Involement TINYINT,
    Activity11_Hidtorical TINYINT,
    Activity12 VARCHAR(200),
    Activity12_Involement TINYINT,
    Activity12_Hidtorical TINYINT,
    Activity13 VARCHAR(200),
    Activity13_Involement TINYINT,
    Activity13_Hidtorical TINYINT,
    Activity14 VARCHAR(200),
    Activity14_Involement TINYINT,
    Activity14_Hidtorical TINYINT,
    Activity15 VARCHAR(200),
    Activity15_Involement TINYINT,
    Activity15_Hidtorical TINYINT,
    Activity16 VARCHAR(200),
    Activity16_Involement TINYINT,
    Activity16_Hidtorical TINYINT
)";



// execute the query and check for errors
if ($conn->query($UserTableSQL) === TRUE) {
    echo "Table UserTable created successfully";
}

if ($conn->query($SurveyUserTableSQL) === TRUE) {
    echo "Table SurveyUserTable created successfully";
}

if ($conn->query($SurveyQuestionsTableSQL) === TRUE) {
    echo "Table SurveyQuestionsTable created successfully";
}

if ($conn->query($SurveyReportTableSQL) === TRUE) {
    echo "Table SurveyReportTable created successfully";
}

// close the database connection
mysqli_close($conn);

?>




