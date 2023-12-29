<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      session_start();
      $_SESSION['gopayment'] = TRUE;
      $cardnumber = $_POST['cardnumber'];
      $price = $_POST['price'];

      $cardowner = $_POST['cardowner'];
      $cvc = $_POST['cvc'];
      $firstname = $_POST['firstname'];
      $email = $_POST['email'];
      $table_name = $_POST['table_name'];
      $table_date = $_POST['table_date'];
      $_SESSION['select_date'] = $table_date;
      $_SESSION['table_name'] = $table_name;
      $_SESSION['price'] = $price;

      if(($cardnumber == '123456' &&$cardowner == 'tong'&&$cvc == '123')||($cardnumber == '000000' &&$cardowner == 'bas'&&$cvc == '666')){
        $_SESSION['gopayment'] = FALSE;
        include('config.php');
        $c_status = 'accepted';
        $smtm = $conn->prepare("UPDATE payment SET status = ? WHERE firstname = ? AND table_name = ? AND table_date = ?");
        $smtm->bind_param("ssss", $c_status,$firstname , $table_name , $table_date);
        $smtm->execute();
        $result = $smtm->get_result();
        if(!$conn->error){
            echo "<script> alert('successful');         window.location.href = 'history.php';
            </script>";
        }

      }else{
        echo "<script> alert('payment_denied');         window.location.href = 'confirmpayment.php'
        </script>";
      }

}
?>
