

<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <script>
        function hello(){
           window.location.href = 'reserve.php';
        }
    </script>
</head>
<body>
<?php
session_start();
$firstname = $_SESSION['firstname'];
$email = $_SESSION['email'];

include('config.php');
$smtm = $conn->prepare("SELECT * FROM payment WHERE firstname = ? AND email = ? ORDER BY payment_id DESC");
$smtm->bind_param("ss", $firstname, $email);
$smtm->execute();
$result = $smtm->get_result();

if($result->num_rows > 0){
    while($db = mysqli_fetch_array($result)){
        if($db[5] != 'accepted'){
            echo "<div class = 'whole' style = 'width:100vw ; display:flex; '><div>
            <table id='table' style='border:solid;margin-top:20px' class='table'>
       
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
                <form method = 'post' action ='confirmpayment.php'>
                <input name = 'select_date' value = $db[3] hidden>
                <input name = 'table_name' value = $db[4] hidden>
                <input name = 'price' value = $db[7] hidden>
                <td><button type = 'submit'>pay</button></td>
                </form>
            </tr>
            </table>
        </div></div>";
        }
        
        else{
            echo "<div class = 'whole' style = 'width:100vw ; display:flex; '><div>
            <table id='table' style='border:solid;margin-top:20px' class='table'>
       
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
        </div></div>";
        }

    }
    echo "<button onclick='hello()'>Back to reserve</button>";
}
?>
</body>
</html>
