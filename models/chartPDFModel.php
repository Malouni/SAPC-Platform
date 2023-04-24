<?php

function getChartData($survId){
    global $conn;
        
   
    $sql = "SELECT  ST.SurvYear as CurrentYear , ST.TotalAnswersAvg as Value ,
                    ST1.SurvYear as Year1 , ST1.TotalAnswersAvg as Value1 ,
                    ST2.SurvYear as Year2 , ST2.TotalAnswersAvg as Value2
    
            FROM SurveyTable ST
            LEFT JOIN SurveyTable ST1 ON ST1.SurvYear = ST.SurvYear - 1 AND ST1.Position = ST.Position
            LEFT JOIN SurveyTable ST2 ON ST2.SurvYear = ST.SurvYear - 2 AND ST2.Position = ST.Position
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
