<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Row Addition</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            text-align: center;
        }

        table {
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        button, input[type="submit"] {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover, input[type="submit"]:hover {
            background-color: #0056b3;
            color: white;
        }

        input[type="text"] {
            padding: 5px;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<form method="post" action="couponcontroller.php">
    <table id="dynamicTable">
        <tr>
            <th>Coupon name</th>
            <!-- Removed Column 2 -->
        </tr>
        <!-- Rows will be added dynamically here -->
    </table>

    <button type="button" onclick="addRow()">Add Coupon</button>
    <input type="submit" value="Submit">
</form>

<script>
    function addRow() {
        var table = document.getElementById("dynamicTable");
        var row = table.insertRow(-1); // Inserts a new row
        var cell1 = row.insertCell(0); // Creates a new cell

        // Create a text input and append it to the cell
        var input1 = document.createElement("input");
        input1.type = "text";
        input1.name = "cell1[]"; // Name it for easy processing on the server-side
        cell1.appendChild(input1);

        // Removed the second cell creation
    }
</script>

</body>
</html>
