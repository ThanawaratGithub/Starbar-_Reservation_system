

<?php


if(isset($_POST['submitbutton'])){
include('config.php');
$startdate = $_POST['start'];
$enddate = $_POST['end'];
$stt = 'accepted';

$smtm = $conn->prepare("SELECT table_date , COUNT(*) FROM payment WHERE table_date >= ? AND table_date <= ? GROUP BY table_date WHERE status = $stt ");
$smtm->bind_param("ss", $startdate,$enddate);
$smtm->execute();
$result = $smtm->get_result();
$a = array();
while ($db = mysqli_fetch_array($result)){
    array_push($a , array("y" => $db[1], "label" => $db[0]));
}
$dataPoints = $a;
$smtm->close();

$smtm = $conn->prepare("SELECT table_name , COUNT(*) FROM payment WHERE table_date >= ? AND table_date <= ? GROUP BY table_name WHERE status =$stt ");
$smtm->bind_param("ss", $startdate,$enddate);
$smtm->execute();
$result = $smtm->get_result();
$a = array();
while ($db = mysqli_fetch_array($result)){
    array_push($a , array("y" => $db[1], "label" => $db[0]));
}
$dataPoints2 = $a;


}

 
?>
<!DOCTYPE HTML>
<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type='date'] {
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .chart-container {
            width: 100%;
            height: 300px;
            margin-bottom: 20px;
        }
    </style>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<script>
window.onload = function () {
      var chart1 = new CanvasJS.Chart("chartContainer1",{
    title :{
        text: "Number of reservaion in each day"
    },
    data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
var chart2 = new CanvasJS.Chart("chartContainer2",{
    title :{
	text: "number of reservation in each table"
    },
    data: [{
		type: "column",
		yValueFormatString: "#,##0.## people",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
 
chart1.render();
chart2.render();

}

</script>
</head>
<body>
    <form method = 'post' action = ''>
    startdate
    <input type = 'date' id = 'start' name = 'start' required>
    enddate
    <input type = 'date' id = 'end' name = 'end' required>
    

    <button name = 'submitbutton' type = 'submit'>submit</button>
    </form> 
    <div id="chartContainer1" style="width: 45%; height: 300px; width: 100%;"></div> 
<div id="chartContainer2" style="width: 45%; height: 300px ;width: 100%;;"></div>


</body>
</html>               