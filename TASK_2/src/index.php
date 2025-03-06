<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="https://i.imgur.com/KGylDrc.png">

    <title>KCSC</title>
</head>
<style>
    header {
    background-color: #333; /*Chọn màu thanh header*/
    height: 60px;               /*Chiều cao thanh header*/
    display: flex;                  /*Sắp xếp các element trong thẻ header theo hàng ngang*/
    justify-content: space-around;  /*Sắp xếp các element từ giữa tách sang hai bên*/
    align-items: center;            /*Sếp xếp chữ ở giữa theo chiều cao*/
    padding: 0 20px;                /*Tăng độ rộng 20px*/
    }

    nav ul {
    list-style: none; /*Ẩn style (ý hiệu mỗi đầu hàng)*/
    margin: 0;         
    padding: 0;
    display: flex; /*Sắp xếp các element trong thẻ nav ul theo hàng ngang*/
    }

    nav li {
    margin: 0 10px; 
    }

    nav a {
    color: #fff; 
    text-decoration: none; /*ẩn màu của thẻ a*/
    font-size: 18px;
    padding: 10px;
    }

    nav a:hover {
    background-color: #ddd;
    color: #333;
    border-radius: 5px;
    }
    
    form {
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 20px;
    max-width: 400px;
    margin: 0 auto;
    margin-top: 40px;
    }

    h2 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    }

    .form-group {
    margin-bottom: 10px;
    }

    label {
    display: block;
    margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    }

    button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    }

    button[type="submit"]:hover {
    background-color: #45a049;
    }
</style>
<body style="height: 100vh;overflow-y: hidden;">
    <header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <div>
        <form>
            <h2>Login</h2>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Log in</button>
        </form>
    </div>

    </body>
</html>