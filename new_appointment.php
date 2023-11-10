<?php
require 'Database.php';
require 'Appointment.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $app = new Appointment();
    $app->setDescription($_POST['descr']);
    $app->setEmail($_POST['email']);
    $app->setDate($_POST['date']);
    $app->setOrganizer($_SESSION['user_id']);
    $db = Database::getInstance();
    $db->addAppointment($app);
    $db->closeConnection();
    header("Location: appointments.html");
}
?>
