<?php
$host = 'localhost';
$user = 'root';
$pass = 'your_password'; // TODO: change this
$db   = 'expense_tracker';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
