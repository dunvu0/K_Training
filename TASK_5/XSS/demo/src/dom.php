<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DOM-based XSS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 30px;
        }
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        .demo-section {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 4px;
        }
        .button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>DOM XSS with innerHTML Sink</h2>
  
        <div class="demo-section">
            <p>URL parameter 'q':</p>
            <button class="button" onclick="displayParameter()">Display Parameter</button>
            <br></br>
            <div id="paramOutput">Search query: (no parameter)</div>
        </div>
    </div>

    <script>
        function displayParameter() {
        var urlParams = new URLSearchParams(window.location.search);
        var paramValue = urlParams.get('q') || '(no parameter)';
        document.getElementById("paramOutput").innerHTML = "Search query: " + paramValue;
    }
    </script>