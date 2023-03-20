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



// SurveyUserTable query
$UserAnswerSQL = "INSERT INTO UserAnswer (SurvID, UserID, Progress,    Q0, Q1, Q2, Q3_1, Q3_2, Q4, Q5, Q6_1, Q6_2, Q6_3, Q6_4, Q6_5, Q7_1, Q7_2, Q7_3, Q7_4, Q7_5, Q8, Q9, Q10, Q11, Q12_1, Q12_2, Q12_3, Q12_4, Q13_1, Q13_2, Q14_1, Q14_2, Q15, Q16, Q1_note, Q2_note, Q3_note, Q4_note, Q5_note, Q6_note, Q7_note, Q8_note, Q9_note, Q10_note, Q11_note, Q12_note, Q13_note, Q14_note, Q15_note, Q16_note)
VALUES 
(1, 101, 0.25,    4, 5, 3, 2, 4, 5, 1, 5, 4, 5, 2, 3, 1, 5, 2, 3, 4, 3, 2, 5, 3, 5, 2, 1, 3, 5, 4, 3, 2, 4, 2, 'Good experience overall', 'Helpful staff', 'Not enough resources', 'Slow internet', 'Lack of diversity', 'Sub-questions were not clear', 'Facilities could be improved', 'Course material was not challenging enough', 'Curriculum was outdated', 'Too many assignments', 'Could use more extracurricular activities', 'Faculty could be more involved with students', 'Lack of mentorship opportunities', 'Would like to see more guest speakers', 'Overall satisfied', NULL),
(1, 102, 0.5,     3, 4, 4, 5, 1, 2, 3, 4, 3, 5, 4, 1, 3, 4, 2, 5, 2, 4, 3, 3, 4, 3, 5, 4, 1, 2, 4, 2, 4, 2, 1, 'Mixed experience', 'Staff could be more approachable', 'Not enough study space', 'Difficulty finding resources', 'Curriculum could be more structured', 'Sub-questions were helpful', 'Facilities were well-maintained', 'Course material was relevant and challenging', 'Curriculum was well-designed', 'Assignments were manageable', 'Good extracurricular activities available', 'Faculty was supportive and encouraging', 'Mentorship opportunities were sufficient', 'Guest speakers were valuable', 'Overall satisfied', NULL);
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

if ($conn->query($UserAnswerSQL) === TRUE) {
    echo "Table UserAnswer populated successfully\n<br>";
}
else{
    echo "Table UserAnswerTable error\n<br>";
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


// close the database connection
mysqli_close($conn);
