<?php

function getChartData($survId){
    global $conn;
        
    $Year1_ID = $survId - 1;
    $Year2_ID = $survId - 2;

    $sql = "SELECT  ST.SurvYear as CurrentYear , ST.TotalAnswersAvg as Value ,
                    ST1.SurvYear as Year1 , ST1.TotalAnswersAvg as Value1 ,
                    ST2.SurvYear as Year2 , ST2.TotalAnswersAvg as Value2
    
            FROM SurveyTable ST
            LEFT JOIN SurveyTable ST1 ON ST1.SurvID =  '$Year1_ID'
            LEFT JOIN SurveyTable ST2 ON ST2.SurvID = '$Year2_ID'
            WHERE ST.SurvID = '$survId' ";

    $result = mysqli_query($conn, $sql);
    $data = [];

    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
            $data[] = $row;
        return $data;
    }
    else
        return $data[0] = "No Data";
}
?>
