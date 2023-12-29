<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <style>
        /* Add your CSS styles here or link to an external stylesheet */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .main {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header, .footer {
            text-align: center;
            padding: 10px 0;
        }

        .header > div:first-child {
            font-size: 22px;
            color: #333;
        }

        .header > div:last-child {
            font-size: 28px;
            color: #007bff;
        }

        .input {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class='main'>
        <div class='header'>
            <div>Time to have fun!</div>
            <div>Login</div>
        </div>
        <div class='article'>
            <form method='post' action='' >
                <label for="email">Email</label>
                <input id="email" name="email" type="email" class='input' required>
                
                <label for="password">Password</label>
                <input id="password" name="password" type="password" class='input' required>
                
                <button type='submit' name='submitbutton'>Submit</button>
            </form>
        </div>
        <div class='footer'></div>
    </div>

</body>
</html>
<?php
    include('config.php');
    session_start();
    if(isset($_POST['submitbutton'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if($email == 'admin@admin.com' && $password == 'root'){
            header('Location: ownerlanding.php');
            exit();
        }

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT firstname FROM stardb WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $db = $result->fetch_assoc();
            $_SESSION["firstname"] = $db['firstname'];
            $_SESSION["email"] = $email;
            $_SESSION["login"] = TRUE;
            

        $timeobj = new DateTime();
        $date_time = $timeobj->format('Y-m-d H:i:s');
        $obj2 = $conn->prepare("INSERT INTO login_status (firstname , email , login_time) VALUES(?,?,?)");
        $obj2->bind_param("sss",$_SESSION["firstname"], $email,$date_time );
        $obj2->execute();
        echo "<script> alert('$obj2->error')</script>"   ; 
        $obj2->close();
            header('Location: reserve.php');
            exit();
        } else {
            echo "<script type='text/javascript'>alert('Incorrect email or password.');</script>";
        }


        
    }
?>