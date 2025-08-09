<?php
require 'authentication.php';

// Check if user is logged in and is an employee
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['security_key']) || $_SESSION['user_role'] != 2) {
    die(json_encode(['success' => false]));
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$task_id = isset($data['task_id']) ? $data['task_id'] : null;
$status = isset($data['status']) ? $data['status'] : null;
$user_id = $_SESSION['admin_id'];

if (!$task_id || !$status || !in_array($status, ['accepted', 'rejected'])) {
    die(json_encode(['success' => false]));
}

// Verify this task is assigned to the current user
$sql = "SELECT t_user_id FROM task_info WHERE task_id = :task_id";
try {
    $stmt = $obj_admin->db->prepare($sql);
    $stmt->bindParam(':task_id', $task_id);
    $stmt->execute();
    $task = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$task || $task['t_user_id'] != $user_id) {
        die(json_encode(['success' => false]));
    }
    
    // Update assignment status
    $update_sql = "UPDATE task_info SET 
                   assignment_status = :status,
                   status = CASE 
                     WHEN :status2 = 'accepted' THEN 1 
                     WHEN :status3 = 'rejected' THEN 0 
                     ELSE status 
                   END 
                   WHERE task_id = :task_id";
    
    $stmt = $obj_admin->db->prepare($update_sql);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':status2', $status);
    $stmt->bindParam(':status3', $status);
    $stmt->bindParam(':task_id', $task_id);
    $stmt->execute();
    
    echo json_encode(['success' => true]);
    
} catch (PDOException $e) {
    die(json_encode(['success' => false]));
} 