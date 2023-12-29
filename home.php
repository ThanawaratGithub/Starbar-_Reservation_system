<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
        <input></input>
    </form>
    <script>
        const helloword = ()=>{
            window.alert('youarecilkcing');
        }
    </script>
    <button onclick = helloword()>button </button>
<?php
    include('config.php');
    $sql  = "SELECT * FROM helloworddb";
    $result = $conn->query($sql);
    while($dbarr = mysqli_fetch_array($result)){
        echo "$dbarr[0] <br>";
    }

    ?>
</body>
</html>