<!DOCTYPE html>
<html>
<head>
    <title>Coupon Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 60%; /* Adjust the width as needed */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td {
            background-color: #f8f9fa;
        }

        input[type="submit"] {
            padding: 5px 10px;
            background-color: #dc3545; /* Red color for delete buttons */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #c82333;
        }
    </style>
User
<?php
// Database connection setup
$host = '127.0.0.1';
$dbname = 'f66g4';
$username = 'f66g4';
$password = 'f66g4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch data from database
    $stmt = $pdo->prepare("SELECT coupon_id, coupon_name FROM coupon");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Coupon Management</title>
    <!-- Add any required styles or scripts here -->
</head>
<body>

<table>
    <tr>
        <th>Coupon Name</th>
        <th>Action</th>
    </tr>
    <?php foreach ($rows as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['coupon_name']); ?></td>
            <td>
                <form method="post" action="coupondelete.php">
                    <input type="hidden" name="coupon_id" value="<?php echo $row['coupon_id']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>