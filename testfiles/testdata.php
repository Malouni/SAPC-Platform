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
VALUES ('gamso17@mytru.ca', 'password', 'Oleg', 'Gams', 'user', 'Science')
 ('t00618261@mytru.ca', 'password', 'Alexander', 'Ramirez', 'user', 'Science')
 ('nguyend19@mytru.ca', 'password', 'Duy', 'Nguyen', 'user', 'Science')
 ('Fahmed@tru.ca', 'password', 'Faheem', 'Ahmed', 'admin', 'Science')";

$SurveyTableSQL = "INSERT INTO SurveyTable (SurvYear, SurvName, SurvDateStart, SurvDateEnd, AmPeopleFin, Position)
VALUES 
  (2021, 'SP21', '2021-01-01', '2021-01-31', 100, 'user'),
  (2022, 'SP22', '2022-03-15', '2022-03-31', 50, 'user'),
  (2023, 'SP23', '2023-05-01', '2023-05-31', 200, 'admin')";



// SurveyUserTable query
$UserAnswerSQL = "INSERT INTO UserAnswer (SurvID, UserID, Progress, Q0, Q1, Q2, Q3_1, Q3_2, Q4, Q5, Q6_1, Q6_2, Q6_3, Q6_4, Q6_5, Q7_1, Q7_2, Q7_3, Q7_4, Q7_5, Q8, Q9, Q10, Q11, Q12_1, Q12_2, Q12_3, Q12_4, Q13_1, Q13_2, Q14_1, Q14_2, Q15, Q16, Q1_note, Q2_note, Q3_note, Q4_note, Q5_note, Q6_note, Q7_note, Q8_note, Q9_note, Q10_note, Q11_note, Q12_note, Q13_note, Q14_note, Q15_note, Q16_note)
VALUES 
(1, 101, 0.25, 4, 5, 3, 2, 4, 5, 1, 5, 4, 5, 2, 3, 1, 5, 2, 3, 4, 3, 2, 5, 3, 5, 2, 1, 3, 5, 4, 3, 2, 4, 2, 'Good experience overall', 'Helpful staff', 'Not enough resources', 'Slow internet', 'Lack of diversity', 'Sub-questions were not clear', 'Facilities could be improved', 'Course material was not challenging enough', 'Curriculum was outdated', 'Too many assignments', 'Could use more extracurricular activities', 'Faculty could be more involved with students', 'Lack of mentorship opportunities', 'Would like to see more guest speakers', 'Overall satisfied'),
(1, 102, 0.5, 3, 4, 4, 5, 1, 2, 3, 4, 3, 5, 4, 1, 3, 4, 2, 5, 2, 4, 3, 3, 4, 3, 5, 4, 1, 2, 4, 2, 4, 2, 'Mixed experience', 'Staff could be more approachable', 'Not enough study space', 'Difficulty finding resources', 'Curriculum could be more structured', 'Sub-questions were helpful', 'Facilities were well-maintained', 'Course material was relevant and challenging', 'Curriculum was well-designed', 'Assignments were manageable', 'Good extracurricular activities available', 'Faculty was supportive and encouraging', 'Mentorship opportunities were sufficient', 'Guest speakers were valuable', 'Overall satisfied'),
";


// SurveyQuestionsTable query 
$SurveyQuestionsTableSQL = "INSERT INTO SurveyQuestions (SurvID, Goal, SubGoal, Question, Sub_Q1, Sub_Q2, Sub_Q3, Sub_Q4, Type)
VALUES 
  (1, 'Staff Experience', 'DIEL', 'How would you rate your experience at school?', NULL, NULL, NULL, NULL, 'single'),
  (1, 'Staff Experience', 'DIEL', 'What do you think are the strengths of the school as an employer?', NULL, NULL, NULL, NULL, 'single'),
  (1, 'Staff Experience', 'DIEL', 'What areas do you think the school can improve as an employer?', NULL, NULL, NULL, NULL, 'single'),
  (1, 'Staff Experience', 'SPP', 'How satisfied are you with your working conditions?', 'Equipment and tools provided', 'Physical work environment', NULL, NULL, 'composed'),
  (1, 'Staff Experience', 'SPP', 'How satisfied are you with your work-life balance?', 'Flexibility of working hours', 'Opportunities to work from home', NULL, NULL, 'composed'),
  (1, 'Staff Experience', 'TTL', 'How effective do you think communication is between staff members?', 'Frequency of communication', 'Clarity of communication', 'Openness of communication', NULL, 'composed'),
  (1, 'Staff Experience', 'TTL', 'How effective do you think communication is from management?', 'Frequency of communication', 'Clarity of communication', 'Openness of communication', NULL, 'composed'),
  (1, 'Staff Experience', 'TC', 'How satisfied are you with the professional development opportunities offered by the school?', 'Relevance of professional development', 'Opportunities for advancement', NULL, NULL, 'composed'),
  (1, 'Staff Experience', 'TC', 'What professional development opportunities would you like to see offered by the school?', NULL, NULL, NULL, NULL, 'single'),
  (1, 'Staff Experience', 'TC', 'How effective do you think the leadership is at the school?', 'Clarity of vision and direction', 'Support for staff', NULL, NULL, 'composed'),
  (1, 'Staff Experience', 'TC', 'What areas do you think the school leadership can improve?', NULL, NULL, NULL, NULL, 'single'),
  (1, 'Staff Experience', 'GSD', 'How satisfied are you with your compensation and benefits?', 'Salary', 'Benefits (healthcare, retirement, etc.)', NULL, NULL, 'composed'),
  (1, 'Staff Experience', 'GSD', 'What changes would you like to see in your compensation and benefits?', NULL, NULL, NULL, NULL, 'single'),
  (1, 'Staff Experience', 'GSD', 'How effective do you think teamwork is at the school?', 'Collaboration among colleagues', 'Support from colleagues', 'Teamwork with management', NULL, 'composed'),
  (1, 'Staff Experience', 'GSD', 'What areas do you think the school can improve in terms of teamwork?', NULL, NULL, NULL, NULL, 'single'),
  (1, 'Staff Experience', 'DIEL', 'Would you recommend this school as an employer to a friend or colleague?', NULL, NULL, NULL, NULL, 'single');
";

// SurveyReportTable query - In this example, we're populating the SurvID column with values from the SurvID column in SurveyQuestions. 
//The Activity column is populated with the Question column from SurveyQuestions. 
//The Activity_Involvement and Activity_Historical columns are populated with sample values of 3 and 4, respectively. You can adjust these values to match your needs.
$SurveyReportSQL = "INSERT INTO SurveyReport (SurvID, Activity, Activity_Involvement, Activity_Historical)
SELECT SurvID, Question, 3, 4
FROM SurveyQuestions";  




// execute the query and check for errors
if ($conn->query($UserTableSQL) === TRUE) {
    echo "Table UserTable populated successfully\n";
}

if ($conn->query($SurveyTableSQL) === TRUE) {
    echo "Table SurveyTable populated successfully\n";
}

if ($conn->query($UserAnswerSQL) === TRUE) {
    echo "Table UserAnswer populated successfully\n";
}

if ($conn->query($SurveyQuestionsTableSQL) === TRUE) {
    echo "Table SurveyQuestions populated successfully\n";
}

if ($conn->query($SurveyReportSQL) === TRUE) {
    echo "Table SurveyReport populated successfully\n";
}

// close the database connection
mysqli_close($conn);
