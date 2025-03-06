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
    </style>
</head>
<body>
    <h1>Search Car</h1>
    <form method="GET" action="">
        <label for="brand">Brand:</label>
        <select id="brand" name="brand">
            <option value="Porsche">Porsche</option>
            <option value="Ferrari">Ferrari</option>
        </select>
        <input type="submit" value="Search">
    </form>


<?php 
include 'conn.php';




$brand = $_GET['brand'];
$query = "select * from cars where make = '$brand'";


$result = mysqli_query($conn, $query);



if($result){
    // Display the results
    echo "<h2>Results for $brand:</h2>";
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
