

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="reserve.css">
    <script>
        let status = {'A':0,'B':0,'C':0,'D':0,'E':0,'F':0,'G':0,'H':0}
        let currendate  = '';
        function handlechange(){
            status['A'] = 0;
            status['B'] = 0;
            status['C'] = 0;
            status['D'] = 0;
            status['E'] = 0;
            status['F'] = 0;
            status['G'] = 0;
            status['H'] = 0;
            var changing = document.getElementsByClassName('dot');
            for(var i = 0; i < changing.length; i++) {
                 changing[i].style.backgroundColor = '#bbb';
                 changing[i].disabled = false;

                }
            var dateInput = document.getElementById('datetime').value;
            currendate = dateInput;

// Create an XMLHttpRequest object
            var xhr = new XMLHttpRequest();

// Configure it: GET-request for the URL /fetch_date_data.php
            xhr.open('GET', 'tablestatus.php?date=' + encodeURIComponent(dateInput), true);
            
// Send the request
            xhr.send();

// Function to be called when the request is complete
            xhr.onload = function() {
        if (xhr.status != 200) { // analyze HTTP response status
            alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
        } else { // show the result
            var res = xhr.responseText;
            var arr = JSON.parse(res);
            console.log(arr);
            for(var i =0 ;i<arr.length;i++){
                var table = document.getElementById(arr[i]);
                table.style.backgroundColor = 'red';
                status[arr[i]] = 1
                console.log(status)
                table.disabled = true;
            }
        }
        };

        xhr.onerror = function() {
            alert("Request failed");
            };
        }
        const handleclick = (id)=>{
            document.getElementById('button_id').value = id;
        }
        function changepage(){
            window.location.href = 'history.php'
        }
        const handlehistory = ()=>{
            window.location.href = 'history.php'

        }
        window.onload = function(){
    currentSlide(1);    
}
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("ban_dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}


    </script>
</head>
<body>
    <?php
    session_start();
        $firstname = $_SESSION['firstname'];
        echo "HI ".$firstname;

    
    ?>
    
    <!-- Slideshow container --><div class="slideshow-container">
<div class = 'slido'>
<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="https://observer.com/wp-content/uploads/sites/2/2023/05/fathers-day-whiskey-1.jpg?quality=80" >
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHRHtaiB5zOmbe0mBlLfc_EVl4fSUE6CZAFug9sncCNOV5U3V_cKqMqsfJmMYx-rT5q3k&usqp=CAU ">
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="https://wevino.store/cdn/shop/files/Kilbeggan-Black-Irish-Whiskey-0-7-Liter-40-Vol-.15547a_e9105ef1-a762-4f68-a0e5-08f733eb81f6.jpg?v=1698645504">
</div>

<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>

</div>
</div>
<br>

<div style="text-align:center">
  <span class="ban_dot" onclick="currentSlide(1)"></span> 
  <span class="ban_dot" onclick="currentSlide(2)"></span> 
  <span class="ban_dot" onclick="currentSlide(3)"></span> 
</div>
    <div class="reservation-container">     
        <button onclick = 'handlehistory()'>HISTORY</button>
        <h2>Choose a Table</h2>
        <p>Select the date and tab the table on map below</p>
        <form method="post" action="bookinginformation.php" class="reservation-form">
            
            <div><p>date</p><input type="date" name="select_date" id="datetime" onchange="handlechange()" required></div>
            <input type="hidden" id="button_id" name="table_name" value="">

            <div class="table-selection">
                <div class = 'tablecontrol'>
                <div class = 'stage'><p>Stage</p></div>
                <div class = 'row1'>
                <button class="dot" id="A" type="button" onclick="handleclick(id)">A</button>
                <button class="dot" id="B" type="button" onclick="handleclick(id)">B</button>
                </div>
                
                <div class = 'row2'>
                <button class="dot" id="C" type="button" onclick="handleclick(id)">C</button>
                <button class="dot" id="D" type="button" onclick="handleclick(id)">D</button>
                <button class="dot" id="E" type="button" onclick="handleclick(id)">E</button>
                </div>

                <div class = 'row3'>
                <button class="dot" id="F" type="button" onclick="handleclick(id)">F</button>
                <button class="dot" id="G" type="button" onclick="handleclick(id)">G</button>
                </div>
                <div class = 'row4'>
                <button class="dot" id="H" type="button" onclick="handleclick(id)">H</button>
                </div>
                </div>
            </div>

            <button class="submit-button" type="submit">Confirm Table</button>
        </form>
    </div>
    </body>
    <!-- Script tag for the JavaScript -->
