<?php
session_start();
require 'Database.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $database = Database::getInstance();

        // Validate and sanitize user inputs
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        $stmt = $database->prepare("SELECT id FROM user WHERE username = ? AND password = ? LIMIT 1");
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user_id);
            $stmt->fetch();

            // Store the user ID in the session after successful authentication
            $_SESSION['user_id'] = $user_id;

            header("Location: dashboard.php");
            exit(); // Ensure script execution stops after redirection
        } else {
            echo "Wrong credentials";
        }
    }
} catch (mysqli_sql_exception $e) {
    // Handle exceptions more gracefully, log the error, and avoid exposing sensitive information
    error_log("SQL Exception: " . $e->getMessage());
    echo "An error occurred. Please try again later.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Calendar App</title>
    <link rel="stylesheet" href="config.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            color: #45a049;
        }
    </style>
</head>
<body>
<form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Log in</button>
    <a href="registration.php">Not registered yet?</a>
</form>
</body>
</html>