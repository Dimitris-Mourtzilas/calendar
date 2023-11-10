<?php
session_start();
require 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Assuming you have a method to fetch appointment data by ID in your Database class
    $db = Database::getInstance();
    $appointmentData = $db->fetchAppointmentById($_SESSION['app_id']);
    // Return the data in JSON format
    header('Content-Type: application/json');
    echo json_encode($appointmentData);
    exit;
} else {
    // If the request method is not POST, return an error
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

