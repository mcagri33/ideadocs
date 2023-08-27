<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>İdeadocs</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #ffffff;
    }

    .container {
      text-align: center;
    }

    .login-button {
      padding: 10px 20px;
      font-size: 18px;
      background-color: #4caf50;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .login-button:hover {
      background-color: #45a049;
    }

  </style>
</head>
<body>
<div class="container">
  <a href="{{route('castle.panel.index')}}" class="login-button">Panel Girişi</a>
</div>
</body>
</html>
