<?php

global $conn;

$userId = $_SESSION['userId'];

// If a year is selected, use it; otherwise, default to the current year
$survYear = isset($_POST['year']) ? intval($_POST['year']) : date('Y');

// Fetch the data for the selected year
$sql = "SELECT sq.QuestionID, sq.Question, sq.Type, ua.Answer as UserAnswer
        FROM SurveyQuestions sq
        JOIN UserAnswer ua ON sq.QuestionID = ua.QuestionID
        JOIN SurveyTable st ON sq.SurvID = st.SurvID
        WHERE ua.UserID = ? AND st.SurvYear = ? AND ua.SurvID = sq.SurvID";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $userId, $survYear);
$stmt->execute();
$result = $stmt->get_result();


// Display table if data is found
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Questions</th><th>Answer</th></tr>";

    while ($row = $result->fetch_assoc()) {
        $questionId = $row['QuestionID'];
        $question = $row['Question'];
        $type = $row['Type'];
        $userAnswer = $row['UserAnswer'];

        if ($type == 'composed') {
            echo "<tr><td colspan='2' style='font-weight: bold;'>$question</td></tr>";

            $sql_sub = "SELECT sq.SubQuestionID, sq.Sub_Q, sqa.Answer as SubAnswer
                        FROM SubQuestions sq
                        JOIN SubQuestionAnswer sqa ON sq.SubQuestionID = sqa.SubQuestionID
                        WHERE sqa.UserID = ? AND sqa.QuestionID = ?";
            $stmt_sub = $conn->prepare($sql_sub);
            $stmt_sub->bind_param('ii', $userId, $questionId);
            $stmt_sub->execute();
            $result_sub = $stmt_sub->get_result();

            while ($row_sub = $result_sub->fetch_assoc()) {
                $subQuestion = $row_sub['Sub_Q'];
                $subAnswer = $row_sub['SubAnswer'];
                echo "<tr><td style='text-indent: 30px;'>$subQuestion</td><td>$subAnswer</td></tr>";
            }
        } else {
            echo "<tr><td style='font-weight: bold;'>$question</td><td>$userAnswer</td></tr>";
        }
    }

    echo "</table>";

} else {
    // Display "No data found" if no data
    echo "<p>No data found for the selected year.</p>";
}