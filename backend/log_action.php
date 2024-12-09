<?php
include('database.php');

function logAction($userID, $action, $ipAddress, $deviceInfo, $osInfo, $browserInfo, $actionDetails)
{
    global $conn;

    $query = "INSERT INTO activity_log (logID, userID, action, ipAddress, deviceInfo, osInfo, browserInfo, actionDetails, createdAt) VALUES (UUID(), ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssss', $userID, $action, $ipAddress, $deviceInfo, $osInfo, $browserInfo, $actionDetails);
    $stmt->execute();
    $stmt->close();
}