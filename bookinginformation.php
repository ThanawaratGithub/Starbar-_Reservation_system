
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= 'stylesheet' href = 'bookinginformation.css'>
    <title>Document</title>
    <script>
    let st = 0;
    const handleback = ()=>{
        window.location.href = 'reserve.php';
    }
    const handlereserve = ()=>{
        window.location.href = 'confirmpayment.php';
    }
    const handlecheck = ()=>{
  


        var xhr = new XMLHttpRequest();

// Configure it: POST-request for the URL /checkcoupon.php
xhr.open('POST', 'checkcoupon.php', true);

// Set proper header information along with the request
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
var element = document.getElementById('coupon');
console.log('hello')
console.log(element.value);
// Send the request
xhr.send('coupon=' + encodeURIComponent(element.value));
console.log('hello');
// Function to be called when the request is complete
xhr.onload = function() {
    console.log('inthisfunciotn')
    if (xhr.status != 200) { // analyze HTTP response status
        alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
    } else { // show the result
        console.log('inthisfunciton2')
        var res = xhr.responseText;
        console.log(res);
        if(res == 'fail'){
            console.log('thisisfail');
        }
        if(res == 'success'){
            console.log('success')
            let toinsert = (parseInt(document.getElementById('price').value)-500).toString();
            console.log(toinsert);
            document.getElementById('price').value = toinsert;
            document.getElementById('prica').value = toinsert;
            st = 1;
            if(document.getElementById('coupon') == 'a<3a'){
            alert('ดึกแล้ว กลับบ้านได้ยัง')
        }

        }else{
            console.log('fail')
        }
        
        }
    }
};


    
</script>
</head>

<body>


    <?php
    session_start();
    $firstname = $_SESSION['firstname'];
    if (isset($_SERVER["REQUEST_METHOD"])) {
        $param1 = $_POST['select_date'];
        $param2 = $_POST['table_name'];
        $price = 2000;
        include('config.php');
        $smtm = $conn->prepare("SELECT price FROM tableprice WHERE table_name = ?");
        $smtm->bind_param("s", $param2);
        $smtm->execute();
        $result = $smtm->get_result();
        while($db = mysqli_fetch_array($result)){
            $price =  $db[0];
        }


        if($param2==''){
            echo "<script>alert(noselect_date)</script>";
            echo "<script>window.location.href = 'reserve.php'</script>";
        }
    }
        echo "
            <div class = 'whole'>
            <div class = 'header'><div>Booking Information</div></div>
             <div class = 'article'>
             <table>
             <tr>
             <td>Date</td>
             <td><div class = 'detail_box'><div>$param1</div></div></td>
             </tr>
             <tr>
             <td>Table Number</td>
             <td><div class = 'detail_box'><div>$param2</div></div></td>
             </tr>
             <tr>
             <td>Recommend Seat</td>
             <td><div class = 'detail_box'><div>8</div></div></td>
             </tr>
             <tr>
             <td>Booking fee</td>
             <td><input class = 'detail_box' id = 'price' value = $price name = 'price'></td>
             </tr>
             </table>
             </div>
             <img src = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVN_Mjrv72E77epC5GtDcGpiCDH_uzRfEJF0sGNnk&s'>
             apply coupon
             <input name = 'coupon' id = 'coupon'>
             <button onclick = 'handlecheck()' >apply</button>
             <p>You will get 1 Red Label and 4 mixers</p>
             <div class = 'footer'><button onclick = 'handleback()'>Back</button><form method = 'post' action ='confirmpayment.php'><input name ='select_date' value = $param1 hidden><input name = 'price'  id = 'prica' value = $price hidden><input name ='table_name' value = $param2 hidden><button type = 'submit' onclick = 'handlereserve()'>Reserve</button ></div></form>
             </div>
        
        ";

    
    
    
    
    
    
    ?>
</body>
</html>