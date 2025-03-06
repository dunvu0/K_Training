<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Search</title>
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
        input[type="text"], input[type="submit"] {
            padding: 5px;
            margin-right: 10px;
        }
        input[type="submit"] {
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
    <h1>Search Artist</h1>
    <form method="GET" action="">
        <label for="id">Artist ID:</label>
        <input type="text" id="id" name="id">
        <input type="submit" value="Search">
    </form>






<?php

$id = $_GET['id'];
$query = "SELECT * FROM artists WHERE ArtistId=".$id;
if (isset($id)) {
   class MyDB extends SQLite3
   {
      function __construct()
      {
	 // This folder is world writable - to be able to create/modify databases from PHP code
         $this->open('../test/chinook.db');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }
   echo "Query : ".$query."\n";


   $ret = $db->query($query);
   echo "<table>";
   echo "<tr><th>Artist ID</th><th>Name</th></tr>";
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['ArtistId']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
    echo "</tr>";
   }
   echo "</table>";
   if($ret==FALSE)
    {
	echo "Error : ".$db->lastErrorMsg();
    }
   $db->close();

}
?>