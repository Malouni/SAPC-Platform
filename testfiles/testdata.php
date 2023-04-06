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
$UserTableSQL = "INSERT INTO UserTable (UserName, password, Fname, Lname, Position, Department) 
VALUES ('gamso17@mytru.ca', 'password', 'Oleg', 'Gams', 'user', 'Science'), 
       ('t00618261@mytru.ca', 'password', 'Alexander', 'Ramirez', 'user', 'Science'), 
       ('nguyend19@mytru.ca', 'password', 'Duy', 'Nguyen', 'user', 'Science'), 
       ('fahmed@tru.ca', 'password', 'Faheem', 'Ahmed', 'admin', 'Science')";

$SurveyTableSQL = "INSERT INTO SurveyTable (SurvYear, SurvName, SurvDateStart, SurvDateEnd, AmPeopleFin,LastUpdatedDate, Position)
VALUES 
    (2021, 'SP21', '2021-05-01', '2021-05-31', 200, '2021-01-31', 'user'),
    (2021, 'SD21', '2021-05-01', '2021-05-31', 200, '2021-01-31', 'chair'),
    (2022, 'SP22', '2022-05-01', '2022-05-31', 200, '2022-01-31', 'user'),
    (2022, 'SD22', '2022-05-01', '2022-05-31', 200, '2022-01-31', 'chair'),
    (2023, 'SP23', '2023-05-01', '2023-05-31', 200, '2023-01-31', 'user'),
    (2023, 'SD23', '2023-05-01', '2023-05-31', 200, '2023-01-31', 'chair')
    
    ;";



// query to populate answer tables
$UserAnswerSQL = "INSERT INTO UserAnswer (UserID, QuestionID, SurvID, Answer)
VALUES
  (1, 1, 1, 5),
  (1, 2, 1, 4),
  (1, 3, 1, 2),
  (1, 4, 1, NULL),
  (1, 5, 1, 3),
  (1, 6, 1, 1),
  (1, 7, 1, NULL),
  (1, 8, 1, NULL),
  (1, 9, 1, 25000),
  (1, 10, 1, 2),
  (1, 11, 1, 1),
  (1, 12, 1, NULL),
  (1, 13, 1, NULL),
  (1, 14, 1, NULL),
  (1, 15, 1, 3),
  (1, 16, 1, 2),
  (2, 1, 1, 3),
  (2, 2, 1, 6),
  (2, 3, 1, 1),
  (2, 4, 1, NULL),
  (2, 5, 1, 1),
  (2, 6, 1, 2),
  (2, 7, 1, NULL),
  (2, 8, 1, NULL),
  (2, 9, 1, 12000),
  (2, 10, 1, 3),
  (2, 11, 1, 0),
  (2, 12, 1, NULL),
  (2, 13, 1, NULL),
  (2, 14, 1, NULL),
  (2, 15, 1, 1),
  (2, 16, 1, 3),


(1, 1, 3, 5),
(1, 2, 3, 4),
(1, 3, 3, 2),
(1, 4, 3, NULL),
(1, 5, 3, 3),
(1, 6, 3, 1),
(1, 7, 3, NULL),
(1, 8, 3, NULL),
(1, 9, 3, 25000),
(1, 10, 3, 2),
(1, 11, 3, 1),
(1, 12, 3, NULL),
(1, 13, 3, NULL),
(1, 14, 3, NULL),
(1, 15, 3, 3),
(1, 16, 3, 2),
(2, 1, 3, 3),
(2, 2, 3, 6),
(2, 3, 3, 1),
(2, 4, 3, NULL),
(2, 5, 3, 1),
(2, 6, 3, 2),
(2, 7, 3, NULL),
(2, 8, 3, NULL),
(2, 9, 3, 12000),
(2, 10, 3, 3),
(2, 11, 3, 0),
(2, 12, 3, NULL),
(2, 13, 3, NULL),
(2, 14, 3, NULL),
(2, 15, 3, 1),
(2, 16, 3, 3)


  
;";

$UserSQAnswerSQL = "INSERT INTO SubQuestionAnswer (UserID, QuestionID, SubQuestionID, Answer)
VALUES
  (1, 4, 1, 2),
  (1, 4, 2, 0),
  (1, 7, 3, 2),
  (1, 7, 4, 1),
  (1, 7, 5, 15000),
  (1, 7, 6, 1),
  (1, 7, 7, 10000),
  (1, 8, 8, 3),
  (1, 8, 9, 2),
  (1, 8, 10, 8000),
  (1, 8, 11, 1),
  (1, 8, 12, 7000),
  (1, 12, 13, 1),
  (1, 12, 14, 2),
  (1, 12, 15, 0),
  (1, 12, 16, 1),
  (1, 13, 17, 3),
  (1, 13, 18, 1),
  (1, 14, 19, 2),
  (1, 14, 20, 1),
  (2, 4, 1, 1),
  (2, 4, 2, 1),
  (2, 7, 3, 3),
  (2, 7, 4, 2),
  (2, 7, 5, 20000),
  (2, 7, 6, 1),
  (2, 7, 7, 5000),
  (2, 8, 8, 4),
  (2, 8, 9, 3),
  (2, 8, 10, 12000),
  (2, 8, 11, 1),
  (2, 8, 12, 3000),
  (2, 12, 13, 2),
  (2, 12, 14, 1),
  (2, 12, 15, 1),
  (2, 12, 16, 0),
  (2, 13, 17, 2),
  (2, 13, 18, 0),
  (2, 14, 19, 1),
  (2, 14, 20, 2);

";

$UserAnswerNotesSQL = "INSERT INTO AnswerNotes (UserID, QuestionID, NoteText) VALUES
(1, 1, 'This question was unclear.'),
(1, 2, 'I strongly disagree with this question.'),
(2, 1, 'I found this question very helpful.'),
(2, 2, 'This question needs more context.'),
(3, 1, 'I am not sure how to answer this question.'),
(3, 2, 'I am very satisfied with this question.');

";


// SurveyQuestionsTable query 
$SurveyQuestionsTableSQL = "INSERT INTO SurveyQuestions (SurvID, Goal, SubGoal, Question, Type)
VALUES 
  (1,  'DIEL',  'C',   'Please tell us the number of times you included an elder visit (or other Indigenous presenters) in your classroom',   'single'),
  (1,  'TTL',  'C',   'Please provide the number of course sections you taught in the 2020/21 academic year that included project-based learning opportunities, if teaching two sections of the same courses please put 2. ',   'single'),
  (1,  'TTL',  'C',   'Please provide the number of course sections you taught in the 2020/21 academic year that included learning on the land in the form of field trips, if teaching two sections of the same courses please put 2. ',   'single'),
  (1,  'TTL',  'C',   'Please provide us the number of field course sections that you taught as the primary instructor of record in the 2020/21 academic year', 'composed'),
  (1,  'GSD',  'I&D',   'Please provide the number of external committees or boards you participated on during the 2021/22 academic year',   'single'),
  (1,  'TTL',  'S',   'Please provide the number of peer reviewed publications you had published in 2021', 'single'),
  (1,  'GSD',  'CM',   'Please provide information concerning grant applications submitted that you were a primary investigator (lead applicant) on during 2021 ',   'composed'),
  (1,  'GSD',  'CM',    'Please provide information concerning grant applications submitted that you were a co-investigator or co-applicant on during 2021 ',    'composed'),
  (1,  'GSD',  'CM',   'What was the total value of research dollars administered this past 2020/21 academic year?', 'single'),
  (1,  'TC',  'I&D',   'Please provide the number of Indigenous communities or organizations within our region that you worked with in your research and scholarship during the 2021/22 academic year.',   'single'),
  (1,  'TC',  'I&D',   'Please provide the number of Indigenous communities or organizations outside our region that you worked with in your research and scholarship during the 2021/22 academic year',   'single'),
  (1,  'TC',  'C',   'Please indicate the number of students employed during the 2021/22 academic year to help you with your research',   'composed'),
  (1,  'TC',  'C',   'Please indicate the number of students you were the primary supervisor for during the 2021/22 academic year in each category',  'composed'),
  (1,  'TC',  'CM',   'Please provide the number of high school outreach visits you participated in during the 2020/21 academic year:',  'composed'),
  (1,  'TC',  'CM',   'Please provide the number of high school visits to TRU that you participated in during the 2020/21 academic year',  'single'),
  (1,  'TC',  'CM',   'Please provide the number of community learning events you hosted as a primary instructor for which university or K-12 students were not the primary audience, eg. Rotary presentation.',  'single')
  
  ;";


//SubquestionTable Query

$SubQuestionSQL = "INSERT INTO SubQuestions (SurvID, QuestionID, Sub_Q)
VALUES
    (1,4,'Domestic Field Courses'),
    (1,4,'International Field Courses'),
    (1,7,'Total Number'),
    (1,7,'Number that were successful'),
    (1,7, 'Dollar value of successful grants'),
    (1,7, 'Number that were not successful'),
    (1,7, 'Dollar value of unsuccessful grants'),
    (1,8,'Total Number'),
    (1,8,'Number that were successful'),
    (1,8, 'Dollar value of successful grants'),
    (1,8, 'Number that were not successful'),
    (1,8, 'Dollar value of unsuccessful grants'),
    (1,12, 'Undergraduate'),
    (1,12, 'Graduate'),
    (1,12, 'Post-doctoral fellow'),
    (1,12, 'MITACS funded'),
    (1,13, 'Undergraduate'),
    (1,13, 'Graduate student'),
    (1,14, 'Within TRU region'),
    (1,14, 'Outside TRU region');";


// SurveyReportTable query - In this example, we're populating the SurvID column with values from the SurvID column in SurveyQuestions. 
//The Activity column is populated with the Question column from SurveyQuestions. 
//The Activity_Involvement and Activity_Historical columns are populated with sample values of 3 and 4, respectively. You can adjust these values to match your needs.
$SurveyReportSQL = "
  INSERT INTO SurveyReport (SurvID, QuestionID, SubQuestionID, Answer_Percentage, Activity_Involvement, Activity_Historical)
  SELECT 
    SurveyQuestions.SurvID, 
    SurveyQuestions.QuestionID, 
    CASE WHEN SubQuestions.SubQuestionID IS NOT NULL THEN SubQuestions.SubQuestionID ELSE NULL END AS SubQuestionID, 
    0.5, 
    3, 
    4
  FROM SurveyQuestions
  LEFT JOIN SubQuestions
  ON SurveyQuestions.QuestionID = SubQuestions.QuestionID;
";




// execute the query and check for errors
if ($conn->query($UserTableSQL) === TRUE) {
    echo "Table UserTable populated successfully\n<br>";
} else {
    echo "Table UserTable error\n<br>";
}


if ($conn->query($SurveyTableSQL) === TRUE) {
    echo "Table SurveyTable populated successfully\n<br>";
} else {
    echo "Table SurveyTable error\n<br>";
}

if ($conn->query($SurveyQuestionsTableSQL) === TRUE) {
    echo "Table SurveyQuestions populated successfully\n<br>";
} else {
    echo "Table SurveyQuestionTable error\n<br>";
}

if ($conn->query($SurveyReportSQL) === TRUE) {
    echo "Table SurveyReport populated successfully\n<br>";
} else {
    echo "Error: " . $SurveyReportSQL . "<br>" . $conn->error;
}

if ($conn->query($SubQuestionSQL) === TRUE) {
    echo "Table SubQuestions populated successfully\n<br>";
} else {
    echo "Table SubQuestions error\n<br>";
}

if ($conn->query($UserAnswerSQL) === TRUE) {
    echo "Table UserAnswer populated successfully\n<br>";
} else {
    echo "Table UserAnswerTable error\n<br>";
}

if ($conn->query($UserSQAnswerSQL) === TRUE) {
    echo "Table UserAnswer Sub-Questions populated successfully\n<br>";
} else {
    echo "Table UserAnswerTable error\n<br>";
}


if ($conn->query($UserAnswerNotesSQL) === TRUE) {
    echo "Table UserAnswerNotes populated successfully\n<br>";
} else {
    echo "Table UserAnswerTable error\n<br>";
}





// close the database connection
mysqli_close($conn);
