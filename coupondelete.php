<?php
// coupondelete.php

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['coupon_id'])) {
    $coupon_id = $_POST['coupon_id'];

    // Database connection setup
    $host = '127.0.0.1';
    $dbname = 'f66g4';
    $username = 'f66g4';
    $password = 'f66g4';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("DELETE FROM coupon WHERE coupon_id = :coupon_id");
        $stmt->bindParam(':coupon_id', $coupon_id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect back to the displaying page
        header("Location: couponlanding.php");
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
