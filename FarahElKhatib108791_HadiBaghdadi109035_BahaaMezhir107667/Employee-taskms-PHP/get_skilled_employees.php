<?php
require 'authentication.php';

// Check if user is logged in
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['security_key'])) {
    die(json_encode([]));
}

$skill = isset($_GET['skill']) ? $_GET['skill'] : '';

if (empty($skill)) {
    die(json_encode([]));
}

// Get employees with the specified skill, ordered by proficiency
$sql = "SELECT a.user_id, a.fullname, e.proficiency_level 
        FROM tbl_admin a 
        INNER JOIN employee_skills e ON a.user_id = e.user_id 
        WHERE a.user_role = 2 
        AND e.skill_name = :skill
        ORDER BY FIELD(e.proficiency_level, 'Expert', 'Intermediate', 'Beginner')";

try {
    $stmt = $obj_admin->db->prepare($sql);
    $stmt->bindParam(':skill', $skill);
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($employees);
} catch (PDOException $e) {
    die(json_encode([]));
} 