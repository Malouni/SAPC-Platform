var chart;
function load_charts_PDF(){

    var url = 'Controller.php';
    var query = {page: 'ReportPDF', command: 'LoadCharts'};

    $.post(url, query, function(data) {
        var result = JSON.parse(data);

        if(result != "No Data")
        {   
            //list of year
            var CurrentYear = result[0]['CurrentYear'];
            var Year1 = result[0]['Year1'];
            var Year2 = result[0]['Year2'];

            //list of Answer_Percentage
            var Value  = result[0]['Value'];
            var Value1 = result[0]['Value1'];
            var Value2 = result[0]['Value2'];     

            circleChart(Value);
            calculateLiner(CurrentYear , Year1 , Year2 ,Value , Value1 ,Value2);            
        }else{
            calculateLiner(0 , 0 , 0 ,0 , 0 ,0);       
        }
    });          

}


// Linear graph
function calculateLiner(CurrentYear, year1 , year2 ,value, value1, value2) {

    if(chart != null){chart.destroy();}    
    if(year2 == null ){
        var previousYears = [year1 , CurrentYear];
        var dataNum = [value1 * 100 , value * 100];
    }else{
        var previousYears = [year2 , year1 , CurrentYear];
        var dataNum = [value2 * 100 , value1 * 100 , value * 100 ];
    }

    var ctx = document.getElementById("lineChart").getContext("2d");
    chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: previousYears,
            datasets: [
                {
                    label: "Avg. Answer Percent",
                    data: dataNum,
                    backgroundColor: "rgba(255, 255, 0, 0.1)",
                    borderColor: " rgb(255, 145, 0)",
                    borderWidth: 2,
                },
            ],
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            width: 300,
            height: 200,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: "Avg. Answer Percent",
                    },
                },
                x: {
                    title: {
                        display: true,
                        text: "Year",
                    },
                },
            },
            animation: {
                onComplete: function() {
                    var canvas = document.getElementById('lineChart');
                    var imageData = canvas.toDataURL('image/png');
                    document.getElementById("lineChartData").value = imageData ; 
                    $('#sendChart').submit();
                }
            },
        },
    });
}


function circleChart(data){
    // Get the canvas element
    var ctx = document.getElementById("circleChart").getContext('2d');

    var percentage = Math.round(data * 100);
    // Set the data for the chart
    var data = {
        datasets: [{        
            data: [percentage, 100 - percentage],
            backgroundColor: ['rgb(255, 145, 0)', 'rgb(225, 225, 225)'],
            borderWidth: 1,
            cutout: '90%'
        }],
        labels: ['Avg. Answer Percent']
    };

    // Set the options for the chart
    var options = {
        responsive: false,
        maintainAspectRatio: false,
        width: 200,
        height: 200,
        cutoutPercentage: 75,
        tooltips: {
            enabled: false
        },
        hover: {
            mode: null
        },       
        animation: {
          duration: 1000,
          onComplete: function() {
            var CircleCanvas = document.getElementById('circleChart');
            var CircleData = CircleCanvas.toDataURL('image/png');
            document.getElementById("circleChartData").value = CircleData; 
            }
        },               
    };
    const centerText= {
        id: 'centerText',
        afterDatasetsDraw(chartz , args , options) {
            const {ctx , chartArea: {left , right, top , bottom , width, height}} = chartz;
            ctx.save();
            ctx.font = 'bolder 2vw arial';
            ctx.fillStyle = 'rgb(14, 86, 134)';
            ctx.textAlign = 'center';
            ctx.fillText( percentage +"%" , width / 2 , height / 2 + top);
        }
    }

    // Create the chart
    var circleChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: options,
        plugins: [centerText]        
    });
}


