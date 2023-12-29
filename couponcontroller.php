<?php
// couponcontroller.php

// Database connection setup (modify with your credentials)
$host = '127.0.0.1';
$dbname = 'f66g4';
$username = 'f66g4';
$password = 'f66g4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Loop through each row of data
        foreach ($_POST['cell1'] as $index => $cell1Value) {
            // Prepare SQL statement
            $stmt = $pdo->prepare("INSERT INTO coupon (coupon_name) VALUES (:column1)");
            $stmt->bindParam(':column1', $cell1Value);

            // Execute the statement
            $stmt->execute();
        }

        echo "Data inserted successfully";
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
