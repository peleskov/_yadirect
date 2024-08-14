<?php
require_once 'config.php';

header('Content-Type: application/json');

$response = ['success' => false, 'error' => '', 'data' => null];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("SELECT json_data FROM $table_name WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            $response['success'] = true;
            $response['data'] = json_decode($result['json_data'], true);
        } else {
            $response['error'] = 'Form data not found';
        }
    } catch (PDOException $e) {
        $response['error'] = 'Database error: ' . $e->getMessage();
    }
} else {
    $response['error'] = 'No ID provided';
}

echo json_encode($response);