<?php
    require_once '../dompdf/autoload.inc.php';  
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


</head>
<style>

    
        /* container styles */
    .pastReports {
        border: 1px solid rgb(185, 185, 185);
        width: 21cm;
        height: auto;
        margin: 10px auto;
        min-width: 1000px;
        padding: 0 0.5% 0.5% 0.5%;
    }

    div.pastDocuments {
        border-top: 1px solid rgb(105, 105, 105);
        border-bottom: 1px solid rgb(105, 105, 105);
        width: auto;
        height: auto;
        margin: 0.5% 0% 0.5% 0%;
    }

    div.document {
        margin: 1.5% 0.5% 1.5% 0%;
        display: inline-block;
        height: auto;
        width: auto;
    }

    div.report {
        border: 1px solid rgb(105, 105, 105);
        width: 99.8%;
        height: auto;
        padding: 0 0.5% 0.5% 0.5%;
        margin: 0 0 0 2px;
    }

    /* button images styles */
    button.pdf {
        width: 20px;
        height: 20px;
        margin: 0 5px;
    }

    .icon {
        width: 15px;
    }


    /* strategic goals tabs styles */
    .buttonGoals {
        width: 100%;
        background-color: #003e51;
        color: white;
        text-align: center;
        height: 40px;
        border: none;
        border-radius: 3px 3px 0 0;
        cursor: pointer;
    }


    #coverpattern {
        width: 100%;
        height: 60px;
        background-image: url(../images/backgrounds/hexa.jpg);
        background-size: cover;
        border: 2px solid white;
    }

    /* table style for documents */
    table.tr.rowDocuments {
        width: auto;
    }

    table.td.gridDocuments {
        width: auto;
    }

    /* table styles */
    table.tableGoals {
        width: 100%;
        margin: 0;
        padding: 0;
    }

    tr.rowGoals {
        width: auto;
        margin: 0;
        padding: 0;
    }


    th.gridGoals {
        height: auto;
        margin: 0;
        padding: 0;
    }

    table.tablePastReport {
        width: 700px;
        border-collapse: collapse;
    }

    th.headerActivity {
        width: 60%;
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
        padding: 0 0 0 0.5%;
        background-color: #288f94;
        color: white;
        text-align: left;
    }

    th.headerRest {
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
        background-color: #288f94;
        color: white;
        font-weight: bold;
        text-align: left;
    }

    tr.rowPastReport {
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
    }

    /* This is a css for a row of the single question  */
    tr.rowPastReportSingle{
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
        font-weight: bold;
    }

    /* This is a css for a row for a composed sub-question*/
    tr.rowPastReportComposed{
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
    }

    td.gridActivity {
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
        text-align: left;
        padding: 0 0 0 0.3%;
    }

    /* This is a css for a grid of the composed main question*/
    td.gridComposedActivity {
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
        text-align: left;
        font-weight: bold;
    }

    td.gridRest {
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
        text-align: center;
    }

    /* text styles*/
    p.headers {
        font-weight: bold;
        margin: 0.5% 0 0.3% 1px;
        font-size: large;
    }

    p.regularText {
        margin: 0 0 0.2% 1px;
        font-size: medium;
    }

    p.document {
        color: black;
    }

    p.date {
        color: #040120;
    }

    p.SPRtext {
        color: rgb(0, 225, 255);
    }

    p.facility {
        color: rgb(105, 105, 105);
    }
    img{
        padding-top : 20px;
    }

    
</style>

<body>
   
<?php
    require('../models/ReportPDFModel.php');
?>
    

</body>
</html>

<?php
    $html = ob_get_contents();    
    ob_end_clean();

    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
      
    $dompdf->load_html($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("sample.pdf");
    
?>
