

<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
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

        .whole {
            background-color:'red';
            width: 80%; /* Adjust as needed */
            margin-top: 20px;
        }

        #table {
            border-collapse: collapse;
            width: 100%;
            margin: auto;
        }

        #table, #table td {
            border: 1px solid #ddd;
        }


 
        table{
            background-color:'red';
        }
    </style>
    <script>
        function hello(){
            window.location.href = 'ownerlanding.php';
        }
    </script>
</head>
<body>
    <form method='post' action=''>
        <input type='date' name='date'>
        <button type='submit' name='submitbutton'>Check</button>
    </form>

    <?php


if(isset($_POST['submitbutton'])){
include('config.php');
$date = $_POST['date'];
$smtm = $conn->prepare("SELECT * FROM payment WHERE table_date = ?");
$smtm->bind_param("s", $date);
$smtm->execute();
$result = $smtm->get_result();
if($result->num_rows > 0){
    while($db = mysqli_fetch_array($result)){
        if($db[5] != 'accepted'){
            echo "<div class = 'whole' style = 'width:100vw ; display:flex; background-color:'red'; '>
            <table id='table' style='border:solid;margin-top:20px' class='table'>
                <tr>
                    <td>Customer ID</td>
                    <td>{$db[1]}</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>{$db[3]}</td>
                </tr>
                <tr>
                    <td>Table Number</td>
                    <td>{$db[4]}</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>{$db[5]}</td>
                </tr>
                <tr>
                <td>price</td>
                <td>{$db[7]}</td>
                </tr>
                <tr>
                <td></td>

            </tr>
            </table>
        </div>";
        }
        
        else{
            echo "<div class = 'whole' style = 'width:100vw ; display:flex; background-color:'red'; '>
            <table id='table' style='border:solid;margin-top:20px' class='table'>
                <tr>
                    <td>Customer ID</td>
                    <td>{$db[1]}</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>{$db[3]}</td>
                </tr>
                <tr>
                    <td>Table Number</td>
                    <td>{$db[4]}</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>{$db[5]}</td>
                </tr>
                <tr>
                <td>price</td>
                <td>{$db[7]}</td>
                </tr>
            </table>
      </div>";
        }

    }
    echo "<button onclick='hello()'>Back to home</button>";
}
}
?>

</body>
</html>
