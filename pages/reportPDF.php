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
</head>
<style>
        /* container styles */


    body {
        background: rgb(255, 255, 255); 
    }
    
   
    div.pastReports {
        width: 98%;
        height: auto;
        margin: 0.5% 0.5% 0% 0.5%;
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

    div.report{
        width: 98.65%;
        height: auto;
        padding: 0 0.5% 0.5% 0.5%;
        margin: 0 0 0 2px;
    }

    /* images styles */
    button.pdf {
        margin: 0 5px;
    }

    /* buttons styles */
    button.buttonGoals {
        width:100%;
        background-color: #003e51;
        color: white;
        text-align: center;
    }

    /* table style for documents */
    table.tr.rowDocuments{
        width: auto;
    }
    table.td.gridDocuments{
        width: auto;
    }

    /* table styles */
    table.tableGoals{
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

    table.tablePastReport{
        width: 100%;
        border-collapse: collapse;
    }
    th.headerActivity{
        width: 60%;
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
        padding: 0 0 0 0.5%;
        background-color: #288f94;
        text-align: left;
    }
    th.headerRest{
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
        background-color: #288f94;
        text-align: center;
    }
    tr.rowPastReport{
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
    }
    td.gridActivity{
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
        text-align: left;
        padding: 0 0 0 0.3%;
    }
    td.gridRest{
        border: 1px solid rgb(105, 105, 105);
        border-collapse: collapse;
        text-align: center;
    }
    /* text styles*/
    p.headers{
        font-weight: bold;
        margin: 0.5% 0 0.3% 1px;
        font-size: large;
    }
    p.regularText{
        margin: 0 0 0.2% 1px;
        font-size: medium;
    }
    p.document{
        color: black;
    }
    p.date{
        color: #040120;
    }
    p.SPRtext{
        color: rgb(0, 225, 255);
    }
    p.facility{
        color:rgb(105, 105, 105);
    }
</style>

<body>
    <div class="pastReports">

    <?php
        echo "Test for the php";
    ?>
        <p class="headers">Science Strategic Plan 2023</p>
        <p class="headers">Goals</p>
                <div class="report">
                    <p class="headers">Diverse, Inclusive & Equitable Learning</p>
                    <p class="headers">Inclusion and Diversity</p>
                    <p class="regularText">Ensure the staff and facility compliment is equitable, diverse and inclusive</p>
                    <table class="tablePastReport">
                        <tr class="rowPastReport">
                            <th class="headerActivity">Activity</th>
                            <th class="headerRest">Involvement</th>
                            <th class="headerRest">Historical</th>
                        </tr>
                        <tr class="rowPastReport">
                            <td class="gridActivity">Indigenous presenters in classroom</td>
                            <td class="gridRest">3</td>
                            <td class="gridRest">+2</td>
                        </tr>
                        <tr class="rowPastReport">
                            <td class="gridActivity"> &nbsp; </td>
                            <td class="gridRest"> &nbsp; </td>
                            <td class="gridRest"> &nbsp; </td>
                        </tr>
                        <tr class="rowPastReport">
                            <td class="gridActivity"> &nbsp; </td>
                            <td class="gridRest"> &nbsp; </td>
                            <td class="gridRest"> &nbsp; </td>
                        </tr>
  
                    </table>

                    <p class="headers">Community mindedness</p>
                    <p class="regularText">Promote, support and strengthen a respectful, inclusive, equitable and welcoming culture for all faculty, staff and students</p>

                    <table class="tablePastReport">
                        <tr class="rowPastReport">
                            <th class="headerActivity">Activity</th>
                            <th class="headerRest">Involvement</th>
                        </tr>
                        <tr class="rowPastReport">
                            <td class="gridActivity"> &nbsp; </td>
                            <td class="gridRest"> &nbsp; </td>
                        </tr>
                        <tr class="rowPastReport">
                            <td class="gridActivity"> &nbsp; </td>
                            <td class="gridRest"> &nbsp; </td>
                        </tr>
                        <tr class="rowPastReport">
                            <td class="gridActivity"> &nbsp; </td>
                            <td class="gridRest"> &nbsp; </td>
                        </tr>
                    </table>
                </div>
     </div>
</body>
</html>

<?php
    $html = ob_get_contents();
    ob_end_clean();
    // reference the Dompdf namespace
    use Dompdf\Dompdf;


    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);


    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
    echo $html;
    
?>
