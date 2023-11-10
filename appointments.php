<?php
require 'Database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $database = Database::getInstance();
        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            throw new Exception("User ID not found in session.");
        }

        $appointments = $database->fetchAppointments($userId);

        if (empty($appointments)) {
            echo "<strong>No available appointments at the moment</strong>";
        } else {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Appointments | Calendar App</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            </head>
            <body>
            <div class="container mt-5">
                <h2>Appointments</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($appointments as $appointment) {
                        echo "<tr>";
                        echo "<td>{$appointment['id']}</td>";
                        $_SESSION['app_id'] = $appointment['id'];
                        echo "<td>{$appointment['date']}</td>";
                        echo "<td>{$appointment['description']}</td>";
                        echo "<td>{$appointment['email']}</td>";
                        echo "<td><a href='edit_appointment.php' class='btn btn-primary'>Edit</a></td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            </body>
            </html>
            <?php
        }

        $database->closeConnection();

    } catch (Exception $e) {
        header('Content-Type: text/html; charset=utf-8');
        echo "<h2 style='color:red'>Exception: {$e->getMessage()}</h2>";
    }
}
?>
