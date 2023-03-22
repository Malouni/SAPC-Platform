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
  (2021, 'SP21', '2021-01-01', '2021-01-31', 100, '2021-01-31', 'user'),
  (2022, 'SP22', '2022-03-15', '2022-03-31', 50, '2021-01-31', 'user'),
  (2023, 'SP23', '2023-05-01', '2023-05-31', 200, '2021-01-31', 'admin')";



// query to populate answer tables
$UserAnswerSQL = "INSERT INTO UserAnswer (UserID, QuestionID, SurvID, Answer) VALUES
(1, 1, 1, 3),
(1, 2, 1, 2),
(2, 1, 1, 4),
(2, 2, 1, 5),
(3, 1, 1, 2),
(3, 2, 1, 3);

";

$UserSQAnswerSQL = "INSERT INTO SubQuestionAnswer (UserID, QuestionID, SubQuestionID, Answer) VALUES
(1, 3, 1, 2),
(1, 3, 2, 3),
(2, 3, 1, 4),
(2, 3, 2, 1),
(3, 3, 1, 3),
(3, 3, 2, 2);

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
  (1,  'DIEL',  'I&D',   'How would you rate your experience at school?',   'single'),
  (1,  'DIEL',  'CM',   'What do you think are the strengths of the school as an employer?',   'single'),
  (1,  'DIEL',  'C',   'What areas do you think the school can improve as an employer?',   'single'),
  (1,  'SPP',  'I&D',   'How satisfied are you with your working conditions?',   'composed'),
  (1,  'SPP',  'CM',   'How satisfied are you with your work-life balance?',   'composed'),
  (1,  'SPP',  'C',   'How satisfied are you with your working conditions?',   'single'),
  (1,  'SPP',  'S',    'How satisfied are you with your work-life balance?',   'single'),
  (1,  'TTL',  'I&D',   'How effective do you think communication is between staff members?',   'single'),
  (1,  'TTL',  'CM',   'How effective do you think communication is from management?',   'single'),
  (1,  'TTL',  'C',   'How effective do you think communication is between staff members?',    'single'),
  (1,  'TTL',  'S',   'How effective do you think communication is from management?',   'single'),
  (1,  'TC',  'I&D',   'How satisfied are you with the professional development opportunities offered by the school?',   'composed'),
  (1,  'TC',  'CM',   'What professional development opportunities would you like to see offered by the school?',   'single'),
  (1,  'TC',  'C',   'How effective do you think the leadership is at the school?',   'single'),
  (1,  'TC',  'S',   'What areas do you think the school leadership can improve?',    'single'),
  (1,  'GSD',  'I&D',   'How satisfied are you with your compensation and benefits?', 'single'),
  (1,  'GSD',  'CM',   'What changes would you like to see in your compensation and benefits?',   'single'),
  (1,  'GSD',  'C',   'How effective do you think teamwork is at the school?',   'single'),
  (1,  'GSD',  'S',   'What areas do you think the school can improve in terms of teamwork?',   'single'),
  (1,  'DIEL',  'S',   'Would you recommend this school as an employer to a friend or colleague?',  'single');
";


//SubquestionTable Query

$SubQuestionSQL = "INSERT INTO SubQuestions (SurvID, QuestionID, Sub_Q)
VALUES
    (1,4,'Equipment and tools provided'),
    (1,4,'Physical work environment'),
    (1,5,'Flexibility of working hours'),
    (1,5,'Opportunities to work from home'),
    (1,12, 'Relevance of professional development'),
    (1,12, 'Opportunities for advancement');";


// SurveyReportTable query - In this example, we're populating the SurvID column with values from the SurvID column in SurveyQuestions. 
//The Activity column is populated with the Question column from SurveyQuestions. 
//The Activity_Involvement and Activity_Historical columns are populated with sample values of 3 and 4, respectively. You can adjust these values to match your needs.
$SurveyReportSQL = "INSERT INTO SurveyReport (SurvID, QuestionID, SubQuestionID, Answer_Percentage, Activity_Involvement,Activity_Historical)
SELECT SurveyQuestions.SurvID, SurveyQuestions.QuestionID, SubQuestions.SubQuestionID, 0.5, 3, 4
FROM SurveyQuestions
INNER JOIN SubQuestions
ON SurveyQuestions.QuestionID=SubQuestions.QuestionID";




// execute the query and check for errors
if ($conn->query($UserTableSQL) === TRUE) {
    echo "Table UserTable populated successfully\n<br>";
}
else{
    echo "Table UserTable error\n<br>";
}
    

if ($conn->query($SurveyTableSQL) === TRUE) {
    echo "Table SurveyTable populated successfully\n<br>";
}
else{
    echo "Table SurveyTable error\n<br>";
}

if ($conn->query($SurveyQuestionsTableSQL) === TRUE) {
    echo "Table SurveyQuestions populated successfully\n<br>";
}
else{
    echo "Table SurveyQuestionTable error\n<br>";
}

if ($conn->query($SurveyReportSQL) === TRUE) {
    echo "Table SurveyReport populated successfully\n<br>";
}
else{
    echo "Table SurveyReportTable error\n<br>";
}

if ($conn->query($SubQuestionSQL) === TRUE) {
    echo "Table SubQuestions populated successfully\n<br>";
}
else{
    echo "Table SubQuestions error\n<br>";
}

if ($conn->query($UserAnswerSQL) === TRUE) {
    echo "Table UserAnswer populated successfully\n<br>";
}
else{
    echo "Table UserAnswerTable error\n<br>";
}

if ($conn->query($UserSQAnswerSQL) === TRUE) {
    echo "Table UserAnswer Sub-Questions populated successfully\n<br>";
}
else{
    echo "Table UserAnswerTable error\n<br>";
}


if ($conn->query($UserAnswerNotesSQL) === TRUE) {
    echo "Table UserAnswerNotes populated successfully\n<br>";
}
else{
    echo "Table UserAnswerTable error\n<br>";
}





// close the database connection
mysqli_close($conn);
