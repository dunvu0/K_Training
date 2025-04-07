<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Car</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 10px; /* Add padding to increase space */
            text-align: left;
            width: 33%;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        select, input[type="submit"] {
            padding: 5px;
            margin-right: 10px;
            width: 200px;
        }
        input[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Search Car</h1>
    <form method="GET" action="">
        <label for="name">Car Brand:</label>
        <select id="name" name="name">
            <option value="Porsche">Porsche</option>
            <option value="Ferrari">Ferrari</option>
        </select>
        <input type="submit" value="Search">
    </form>

<?php 
$name = $_GET['name'];
include 'conn.php';


$query = "SELECT * FROM cars WHERE make = '$name'";
$result = mysqli_query($conn, $query);
if($result){
    // Display the results
    echo "<h2>Results for $name:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Brand</th><th>Model</th><th>Released</th><th>Value</th></tr>";
                // Display the results
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["make"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["model"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["year"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["value"]) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";

}else{
    echo "Error: " . $conn->error; 
}

?>
