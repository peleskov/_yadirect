<?php
require_once 'config.php';

header('Content-Type: application/json');

$response = ['success' => false, 'error' => '', 'id' => null];

// Получаем JSON данные из POST запроса
$json_data = file_get_contents('php://input');
$form_data = json_decode($json_data, true);

if ($form_data === null) {
    $response['error'] = 'Invalid JSON data';
    echo json_encode($response);
    exit;
}

// Функция для генерации UUID v4
function generate_uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Проверяем, есть ли уже ID в данных формы
    $id = (isset($form_data['formId']) && !empty($form_data['formId'])) ? $form_data['formId'] : generate_uuid();
    
    // Используем имя таблицы из конфига
    $stmt = $pdo->prepare("INSERT INTO $table_name (id, json_data) VALUES (:id, :json_data) ON DUPLICATE KEY UPDATE json_data = VALUES(json_data)");

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':json_data', $json_data);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['id'] = $id;
    } else {
        $response['error'] = 'Failed to save data';
    }
} catch (PDOException $e) {
    $response['error'] = 'Database error: ' . $e->getMessage();
}

echo json_encode($response);
