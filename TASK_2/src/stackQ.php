<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
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
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Search Products</h1>
    <form method="GET" action="">
        <label for="categoryId">Category ID:</label>
        <select id="categoryId" name="categoryId">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>
        <input type="submit" value="Search">
    </form>
<?php 
$category= $_GET['categoryId'];
$conn = pg_connect("host=172.30.13.232 dbname=postgres user=postgres password=root");

$query = "select product_id, product_name, unit, price from products where category_id=$category;";
$result = pg_query($conn, $query);


if ($result) {
    if (pg_num_rows($result) > 0) {
        echo "<h2>Results for #$category</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Unit</th><th>Price</th></tr>";
        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["product_id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["product_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["unit"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No products found for Category ID: " . htmlspecialchars($category) . "</p>";
    }
} else {
    echo "<p>An error occurred:  </p>";
}

?>
