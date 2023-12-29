<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  
<script>
    const handleclick = ()=>{
        window.location.href = 'reserve.php'
    }
  function back(){
    window.location.href = 'reserve.php'

  }
</script>
</head>
<body>
  
<style>
  body {
    font-family: Arial, sans-serif;
  }
  .container {
    display: flex;
    justify-content: space-between;
    padding: 20px;
  }
  .form-section, .summary-section {
    width: 48%;
  }
  input, select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  button {
    width: 100%;
    padding: 10px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  .billing-info {
    margin-bottom: 20px;
  }
  .price-details {
    border-top: 1px solid #ccc;
    padding-top: 10px;
  }
  .subtotal {
    margin-top: 10px;
    font-weight: bold;
  }

</style>

<?php

       session_start();
       if($_SESSION["login"]!=TRUE){
           echo "<script type='text/javascript'>
           alert('please login');
           window.location.href = 'login.php';
               </script>"; 
       }else{
if (isset($_SERVER["REQUEST_METHOD"])) {
    include('config.php');
    $param1 = '';
    $param2 = '';
    $ff = $_SESSION['firstname'];
    $ee = $_SESSION['email'];
    if($_SESSION['gopayment'] == TRUE){
        $param1 = $_SESSION['select_date'];
        $param2 = $_SESSION['table_name'];
        $price = $_SESSION['price'];
        $_SESSION['gopayment'] = FALSE;
    }else{
        $param1 = $_POST['select_date'];
        $param2 = $_POST['table_name'];
        $price = $_POST['price'];
        $status = 'pending';
        $timeobj = new DateTime();
        $date_time = $timeobj->format('Y-m-d H:i:s');
        $check = $conn->prepare("SELECT * FROM payment WHERE table_date = ? AND table_name = ?");
        $check->bind_param("ss",$param1 , $param2);
        $check->execute();
        $re_check = $check->get_result();
        $num_visit = $re_check->num_rows;
    
          echo $_SESSION['firstname'].$_SESSION['email'].$param1.$param2.$status.$date_time.$price;
          $smtm = $conn->prepare("INSERT INTO tabledb (table_date , table_name) VALUES(?,?)");
          $smtm->bind_param("ss", $param1 , $param2);
          $smtm->execute();
          $result = $smtm->get_result();
      
          $smtm->close();
  
          $pay = $conn->prepare("INSERT INTO payment (firstname,email,table_date,table_name,status,date,price) VALUES (?,?,?,?,?,?,?)");
          $pay->bind_param("sssssss",$_SESSION['firstname'],$_SESSION['email'],$param1,$param2,$status,$date_time,$price);
          $pay->execute();
  
          $pay->close();

    }


    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
    </head>
    <body>
    <div class='container'>
    <div class='form-section'>
      <h2>Enter your payment details</h2>
      <form method = 'post' action = 'http://161.200.89.228/~friday_2023/F04/htdocs/checkpayment.php'>
       <div> $ff</div>
       <div>table: $param2</div>
       <div>date: $param1</div>
       <div>price: $price</div>


        <input type='text' id='card-number' name='cardnumber' placeholder='Card number' onchange = 'handlepay()' required >
        <input type='text' id='card-owner' name='cardowner' placeholder='Owner name' required>
        <input type='text' id='zip-code' name='cvc' placeholder='CVC' required>
        <input type='hidden' id='fname' name='firstname' value=$ff>
        <input type='hidden' id='tname' name='table_name' value=$param2>
        <input type='hidden' id='tdate' name='table_date' value=$param1>
        <input type='hidden' id='em' name='email' value=$ee>
    
    
        <button type='submit' >Next: Review</button>
        <br>
        <button onclick = 'back()' style = 'background-color:'green''>backtoreservepage</button>

      </form>
    </div>
    </body>
    </html>
  ";

} else {
    echo "This is not a POST request.";
}
       }
?>
</body>
</html>

