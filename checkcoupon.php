<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input field
    $coupon = $_POST['coupon'];
    if (empty($coupon)) {
        echo "No date selected";
    } else {

        include('config.php');
        $smtm = $conn->prepare("SELECT * FROM coupon WHERE coupon_name = ?");
        $smtm->bind_param("s", $coupon);
        $smtm->execute();
        $result = $smtm->get_result();

        if($result->num_rows > 0){
            $smtm = $conn->prepare("DELETE FROM coupon WHERE coupon_name = ?");
            $smtm->bind_param("s", $coupon);
            $smtm->execute();
            $result = $smtm->get_result();
            echo 'success';
        }else{
            echo 'fail';
        }

    }
}
?>
