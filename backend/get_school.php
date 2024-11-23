<?php
// Prevent any HTML output before JSON
error_reporting(E_ALL);
ini_set('display_errors', 0); // Disable HTML error output

header('Content-Type: application/json'); 

try {
    require_once('../backend/database.php');
    
    // Use prepared statement
    $query = "SELECT DISTINCT school_name FROM academic_programs ORDER BY school_name";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception($conn->error);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $schools = [];
    while ($row = $result->fetch_assoc()) {
        $schools[] = $row['school_name'];
    }
    
    echo json_encode($schools);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

$stmt->close();
$conn->close();
?>