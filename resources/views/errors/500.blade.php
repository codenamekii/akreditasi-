<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 Internal Server Error</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
        }
        .container img {
            width: 200px;
            height: auto;
            margin-bottom: 20px;
        }
        .container h1 {
            font-size: 72px;
            color: #ff0000;
            margin: 0;
        }
        .container p {
            font-size: 18px;
            color: #333;
        }
        .container a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body style="background:white;">
    <div class="container">
        <img src="https://cdn.dribbble.com/users/926537/screenshots/8259812/media/59d9003d13e5a79418b957c366e9d199.png?resize=400x300&vertical=center" alt="Error Image">
        <h1>500</h1>
        <p>Oops! Something went wrong on our end.</p>
        <p>Please try again later or <a href="{{route('dashboard.index')}}">return to the homepage</a>.</p>
    </div>
</body>
</html>
