
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="../scripts/chart.js"></script>
  <script src="../scripts/chartPDF.js"></script>

  <title>Document</title>
</head>
<body>

    <canvas id="lineChart" width="400" height="300" style='display:none'></canvas>   
    <canvas id="circleChart" width="220" height="220" style='display:none'></canvas>

    <form method='post' action='Controller.php' id='sendChart' style='display:none'>
        <input type='hidden' name='page' value='ReportPDF'>
        <input type='hidden' name='command' value='getPDFRport'>
        <input type='hidden' id='lineChartData' name='lineChart' value='0'>
        <input type='hidden' id='circleChartData' name='circleChart' value='0'>
    </form>
            
    <script>
        load_charts_PDF();
    </script>

</body>
</html>

