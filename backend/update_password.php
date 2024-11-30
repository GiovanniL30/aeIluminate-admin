<?php
// Load vlucas/phpdotenv
require __DIR__ . '/../vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

include('../backend/database.php');
header('Content-Type: application/json');

// start session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passowrds match
    if ($new_password === $confirm_password) {
        // Update password
        $query = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $confirm_password, $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            session_unset();
            session_destroy();
            echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update password']);
        }
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Passwords do not match']);
    }
}
