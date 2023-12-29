<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Collect value of input field
    $date = $_GET['date'];
    if (empty($date)) {
        echo "No date selected";
    } else {
        include('config.php');
        $smtm = $conn->prepare("SELECT table_name FROM tabledb WHERE table_date = ?");
        $smtm->bind_param("s", $date);
        $smtm->execute();
        $result = $smtm->get_result();
        $a=array();
        if($result->num_rows > 0){
            while($db = mysqli_fetch_array($result)){
                array_push($a,$db[0]);
            }
        }

        $json = json_encode($a);
        $smtm->close();
        // Fetch data from your database or source based on the date
        // For demonstration, let's assume we return a simple message
        echo $json;
        // Replace [Your data here] with actual data fetching and processing logic
    }
}
?>
