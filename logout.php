<?php
require 'Database.php';
session_start();
$db = Database::getInstance();
$user = $db->prepare('')