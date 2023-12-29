
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            text-align: center;
        }

        a {
            display: inline-block;
            width: 200px; /* Fixed width */
            margin: 10px;
            padding: 10px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href='couponlanding.php'>Coupon Management</a>    
        <a href='viewsummary.php'>View History Summary</a>    
        <a href='showresult.php'>Analytics</a>    
    </div>
</body>
</html>
