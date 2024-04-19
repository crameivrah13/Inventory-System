<?php
require_once('auth.php');
require_once('MainClass.php');
require_once('index.html');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home | Login with OTP</title>
    <link rel="stylesheet" href="Font-Awesome-master/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./Font-Awesome-master/js/all.min.js"></script>
    <style>
        html,body{
            height:100%;
            width:100%;
        }
        main{
            height:100%;
            width: 100%;
            display:flex;
            flex-flow:column;
        }
        .welcome-message {
            text-align: left;
            margin-bottom: 20px;
        }
        .chart-container {
            width: 100%;
            max-width: 600px; /* Adjust as needed */
            margin: 0 auto;
            margin-bottom: 20px;
        }
        @media (min-width: 768px) {
            .chart-container {
                width: 20%; /* Adjust as needed */
                margin-bottom: 0;
            }
        }

    </style>
</head>
<body>
    <main>
    <div class="container py-3" id="page-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow rounded-0">
                    <div class="card-body">
                        <h5 class="welcome-message">Welcome! <mark><?= ucwords($_SESSION['firstname'].' '.$_SESSION['middlename'].' '.$_SESSION['lastname']) ?></mark></h5>
                        <hr>
                        <a href="login.php" class="btn btn-danger">Logout</a>
                        <!--<hr>
                        <p>You are logged in using <?= $_SESSION['email'] ?></p>
                        <div class="clear-fix mb-4"></div>-->
                        <?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "sinhs");

// Check if the connection was successful
if (!$con) {
    // If connection fails, display an error message and exit
    echo "Problem in database connection! Contact administrator! Error: " . mysqli_connect_error();
    exit(); // Exit the script to prevent further execution
} else {
    // If connection is successful, proceed with the queries

    // First query for the first chart
    $sql1 = "SELECT description, SUM(quantity) AS total_quantity FROM depedexpendable GROUP BY description";
    $result1 = mysqli_query($con, $sql1);

    // Second query for the second chart
    $sql2 = "SELECT description, SUM(quantity) AS total_quantity FROM expendable GROUP BY description";
    $result2 = mysqli_query($con, $sql2);

    // Third query for the third chart
    $sql3 = "SELECT description, SUM(quantity) AS total_quantity FROM mooepar GROUP BY description";
    $result3 = mysqli_query($con, $sql3);

    $sql4 = "SELECT description, SUM(quantity) AS total_quantity FROM depedexpendable GROUP BY description";
    $result4 = mysqli_query($con, $sql4);

    // Second query for the second chart
    $sql5 = "SELECT description, SUM(quantity) AS total_quantity FROM depedexpendable GROUP BY description";
    $result5 = mysqli_query($con, $sql5);

    // Third query for the third chart
    $sql6 = "SELECT description, SUM(quantity) AS total_quantity FROM depedpar GROUP BY description";
    $result6 = mysqli_query($con, $sql6);

    $sql7 = "SELECT description, SUM(quantity) AS total_quantity FROM depedpar GROUP BY description";
    $result7 = mysqli_query($con, $sql7);

    // Second query for the second chart
    $sql8 = "SELECT description, SUM(quantity) AS total_quantity FROM otherexpendable GROUP BY description";
    $result8 = mysqli_query($con, $sql8);

    // Third query for the third chart
    $sql9 = "SELECT description, SUM(quantity) AS total_quantity FROM otherpar GROUP BY description";
    $result9 = mysqli_query($con, $sql9);

    // Check if the queries were successful
    if ($result1 && $result2 && $result3) {
        // Initialize arrays to store product descriptions and quantities for each chart
        $descriptionNames1 = array();
        $quantity1 = array();
        $descriptionNames2 = array();
        $quantity2 = array();
        $descriptionNames3 = array();
        $quantity3 = array();
        $descriptionNames4 = array();
        $quantity4 = array();
        $descriptionNames5 = array();
        $quantity5 = array();
        $descriptionNames6 = array();
        $quantity6 = array();
        $descriptionNames7 = array();
        $quantity7 = array();
        $descriptionNames8 = array();
        $quantity8 = array();
        $descriptionNames9 = array();
        $quantity9 = array();

        // Fetch data from the result sets of each query
        while ($row = mysqli_fetch_array($result1)) {
            $descriptionNames1[] = $row['description'];
            $quantity1[] = $row['total_quantity'];
        }
        while ($row = mysqli_fetch_array($result2)) {
            $descriptionNames2[] = $row['description'];
            $quantity2[] = $row['total_quantity'];
        }
        while ($row = mysqli_fetch_array($result3)) {
            $descriptionNames3[] = $row['description'];
            $quantity3[] = $row['total_quantity'];
        }
        while ($row = mysqli_fetch_array($result4)) {
            $descriptionNames4[] = $row['description'];
            $quantity4[] = $row['total_quantity'];
        }
        while ($row = mysqli_fetch_array($result5)) {
            $descriptionNames5[] = $row['description'];
            $quantity5[] = $row['total_quantity'];
        }
        while ($row = mysqli_fetch_array($result6)) {
            $descriptionNames6[] = $row['description'];
            $quantity6[] = $row['total_quantity'];
        }
        while ($row = mysqli_fetch_array($result7)) {
            $descriptionNames7[] = $row['description'];
            $quantity7[] = $row['total_quantity'];
        }
        while ($row = mysqli_fetch_array($result8)) {
            $descriptionNames8[] = $row['description'];
            $quantity8[] = $row['total_quantity'];
        }
        while ($row = mysqli_fetch_array($result9)) {
            $descriptionNames9[] = $row['description'];
            $quantity9[] = $row['total_quantity'];
        }
    } else {
        // If any query fails, display an error message
        echo "Error retrieving data from database: " . mysqli_error($con);
    } 
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graph</title> 
    <style>
      .chart-container {
            width: 30%;
            display: inline-block;
            vertical-align: top;
            margin: 10px;
            margin-bottom: 20px; /* Added margin between each row */
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- DEPED CHART -->
    <h2>MOOE</h2>
    <!-- First copy of the bar chart -->
    <div class="chart-container">
        <!-- <h2 class="page-header">DEPED</h2> -->
        <div style="text-align: center;">SUPPLY</div>
        <canvas id="chartjs_bar1"></canvas> 
    </div>    
    <!-- Second copy of the bar chart -->
    <div class="chart-container">
        <!-- <h2 class="page-header">DEPED</h2> -->
        <div style="text-align: center;">SEM-EXPENDABLE</div>
        <canvas id="chartjs_bar2"></canvas> 
    </div>    

    <!-- Third copy of the bar chart -->
    <div class="chart-container">
        <!-- <h2 class="page-header">DEPED</h2> -->
        <div style="text-align: center;">PROPERTY, PLANT, AND EQUIPMENT</div>
        <canvas id="chartjs_bar3"></canvas> 
    </div> 
    <hr>
<!-- MOOE CHART -->
    <h2>DEPED</h2>
    <!-- First copy of the bar chart -->
    <div class="chart-container">
        <!-- <h2 class="page-header">DEPED</h2> -->
        <div style="text-align: center;">SEMI-EXPENDABLE</div>
        <canvas id="chartjs_bar4"></canvas> 
    </div>    

    <!-- Second copy of the bar chart -->
    <div class="chart-container">
        <!-- <h2 class="page-header">DEPED</h2> -->
        <div style="text-align: center;">SUPPLY</div>
        <canvas id="chartjs_bar5"></canvas> 
    </div>    

    <!-- Third copy of the bar chart -->
    <div class="chart-container">
        <!-- <h2 class="page-header">DEPED</h2> -->
        <div style="text-align: center;">PROPERTY, PLANT, AND EQUIPMENT</div>
        <canvas id="chartjs_bar6"></canvas> 
    </div>
    <hr>
       <!--CUSTODIAN CHART  -->
    <h2>OTHERS</h2>
    <!-- First copy of the bar chart -->
    <div class="chart-container">
        <!-- <h2 class="page-header">DEPED</h2> -->
        <div style="text-align: center;">SEMI-EXPENDABLE</div>
        <canvas id="chartjs_bar7"></canvas> 
    </div>    

    <!-- Second copy of the bar chart -->
    <div class="chart-container">
        <!-- <h2 class="page-header">DEPED</h2> -->
        <div style="text-align: center;">SUPPLY</div>
        <canvas id="chartjs_bar8"></canvas> 
    </div>    

    <!-- Third copy of the bar chart -->
    <div class="chart-container">
        <!-- <h2 class="page-header">DEPED</h2> -->
        <div style="text-align: center;">PROPERTY, PLANT, AND EQUIPMENT</div>
        <canvas id="chartjs_bar9"></canvas> 
    </div>   
</body>
</html>

<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
    // JavaScript for the first chart
    var ctx1 = document.getElementById("chartjs_bar1").getContext('2d');
    var myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($descriptionNames1); ?>,
            datasets: [{
                backgroundColor: [
                    "#5969ff",
                    "#ff407b",
                    "#25d5f2",
                    "#ffc750",
                    "#2ec551",
                    "#7040fa",
                    "#ff004e"
                ],
                data: <?php echo json_encode($quantity1); ?>,
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#71748d',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                }
            }
        }
    });

    // JavaScript for the second chart
    var ctx2 = document.getElementById("chartjs_bar2").getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($descriptionNames2); ?>,
            datasets: [{
                backgroundColor: [
                    "#5969ff",
                    "#ff407b",
                    "#25d5f2",
                    "#ffc750",
                    "#2ec551",
                    "#7040fa",
                    "#ff004e"
                ],
                data: <?php echo json_encode($quantity2); ?>,
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#71748d',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                }
            }
        }
    });

    // JavaScript for the third chart
    var ctx3 = document.getElementById("chartjs_bar3").getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($descriptionNames3); ?>,
            datasets: [{
                backgroundColor: [
                    "#5969ff",
                    "#ff407b",
                    "#25d5f2",
                    "#ffc750",
                    "#2ec551",
                    "#7040fa",
                    "#ff004e"
                ],
                data: <?php echo json_encode($quantity3); ?>,
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#71748d',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                }
            }
        }
    });
    // JavaScript for the fourth chart
    var ctx3 = document.getElementById("chartjs_bar4").getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($descriptionNames4); ?>,
            datasets: [{
                backgroundColor: [
                    "#5969ff",
                    "#ff407b",
                    "#25d5f2",
                    "#ffc750",
                    "#2ec551",
                    "#7040fa",
                    "#ff004e"
                ],
                data: <?php echo json_encode($quantity4); ?>,
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#71748d',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                }
            }
        }
    });
        // JavaScript for the fifth chart
        var ctx3 = document.getElementById("chartjs_bar5").getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($descriptionNames5); ?>,
            datasets: [{
                backgroundColor: [
                    "#5969ff",
                    "#ff407b",
                    "#25d5f2",
                    "#ffc750",
                    "#2ec551",
                    "#7040fa",
                    "#ff004e"
                ],
                data: <?php echo json_encode($quantity5); ?>,
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#71748d',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                }
            }
        }
    });
        // JavaScript for the sixth chart
        var ctx3 = document.getElementById("chartjs_bar6").getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($descriptionNames6); ?>,
            datasets: [{
                backgroundColor: [
                    "#5969ff",
                    "#ff407b",
                    "#25d5f2",
                    "#ffc750",
                    "#2ec551",
                    "#7040fa",
                    "#ff004e"
                ],
                data: <?php echo json_encode($quantity6); ?>,
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#71748d',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                }
            }
        }
    });
        // JavaScript for the seventh chart
        var ctx3 = document.getElementById("chartjs_bar7").getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($descriptionNames7); ?>,
            datasets: [{
                backgroundColor: [
                    "#5969ff",
                    "#ff407b",
                    "#25d5f2",
                    "#ffc750",
                    "#2ec551",
                    "#7040fa",
                    "#ff004e"
                ],
                data: <?php echo json_encode($quantity7); ?>,
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#71748d',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                }
            }
        }
    });
        // JavaScript for the eight chart
        var ctx3 = document.getElementById("chartjs_bar8").getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($descriptionNames8); ?>,
            datasets: [{
                backgroundColor: [
                    "#5969ff",
                    "#ff407b",
                    "#25d5f2",
                    "#ffc750",
                    "#2ec551",
                    "#7040fa",
                    "#ff004e"
                ],
                data: <?php echo json_encode($quantity8); ?>,
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#71748d',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                }
            }
        }
    });
        // JavaScript for the nine chart
        var ctx3 = document.getElementById("chartjs_bar9").getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($descriptionNames9); ?>,
            datasets: [{
                backgroundColor: [
                    "#5969ff",
                    "#ff407b",
                    "#25d5f2",
                    "#ffc750",
                    "#2ec551",
                    "#7040fa",
                    "#ff004e"
                ],
                data: <?php echo json_encode($quantity9); ?>,
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#71748d',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                }
            }
        }
    });
</script>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
    </main>
</body>
</html>