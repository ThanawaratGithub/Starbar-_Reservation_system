


<?php

include('config.php');
$timeobj = new DateTime();
$date_time = $timeobj->format('Y-m-d H:i:s');
$stt = 'pending';
$smtm = $conn->prepare("SELECT table_date , table_name  FROM payment WHERE TIMESTAMPDIFF(MINUTE, `date`, NOW()) > 2 AND status = ? ");
$smtm->bind_param('s',$stt);
$smtm->execute();
$result = $smtm->get_result();
$smtm->close();
while($db  = mysqli_fetch_array($result)){
  $pp = $conn->prepare("DELETE FROM tabledb WHERE table_name = ? AND table_date = ? ");
  $pp->bind_param('ss',$db[1],$db[0]);
  $pp->execute();
  $pp->close();


  $pp = $conn->prepare("UPDATE payment SET status = 'cancelled' WHERE table_name = ? AND table_date = ? ");
  $pp->bind_param('ss',$db[1],$db[0]);
  $pp->execute();
  $pp->close();
}


 
?>