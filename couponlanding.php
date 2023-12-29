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

        a.button {
            display: inline-block;
            width: 150px; /* Fixed width */
            margin: 10px;
            padding: 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .insert-button {
            background-color: #28a745; /* Green */
        }

        .delete-button {
            background-color: #dc3545; /* Red */
        }

        a.button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href='couponmanagement.php' class="button insert-button">Insert</a>    
        <a href='coupondeletepage.php' class="button delete-button">Delete</a>    
    </div>
</body>
</html>
