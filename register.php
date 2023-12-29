<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <!-- PHP code here -->
    <?php
        include('config.php');

        if(isset($_POST['submitbutton'])){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $birthdate = $_POST['birthdate'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $password = $_POST['password'];
            $conpass = $_POST['confirmpassword'];
          if($password!=$conpass){
            echo "<script type='text/javascript'>
            alert('unmatched password');
                </script>"; 
          }
          else{
            $sql = "INSERT INTO stardb (firstname , lastname , birthdate,tel , email , password ) VALUES ('$firstname','$lastname','$birthdate','$tel','$email','$password')";

           if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
            alert('register successfully');
            window.location.href = '';
                </script>"; 
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
        }else{
            $_POST = array();

        }


       

    ?>
    <div class="flex-container">
        <div class="header">
            <h2>Welcome to the Adventure!</h2>
            <h2>Register</h2>
        </div>
        <div class="article">
            <form method="post" action="">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstname" required>
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastname" required>
                </div>

                <div class="form-group">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" name="birthdate" id="birthdate" required>
                </div>

                <div class="form-group">
                    <label for="tel">Tel</label>
                    <input type="tel" name="tel" id="tel" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="form-group">
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="password" name="confirmpassword" id="confirmpassword" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="submitbutton">Submit</button>
                </div>
            </form>
        </div>
        <div class="footer">
            <!-- Footer content here -->
        </div>
    </div>
</body>
</html>

