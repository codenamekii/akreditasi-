<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            max-width: 600px;
            padding: 20px;
        }
        .container img {
            width: 200px;
            height: auto;
            margin-bottom: 20px;
        }
        .container h1 {
            font-size: 80px;
            color: #333;
            margin: 0;
        }
        .container p {
            font-size: 20px;
            color: #666;
        }
        .container a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://cdni.iconscout.com/illustration/premium/thumb/sleeping-white-cat-404-flash-message-8893445-7295636.png?f=webp" alt="Not Found">
        <h1>404</h1>
        <p>Sorry, the page you are looking for does not exist.</p>
        <p>Return to the <a href="{{route('dashboard.index')}}">homepage</a> or try searching again.</p>
    </div>
</body>
</html>
