<?php
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: index.php');
}
include_once './classes/user.php';
header('Content-Type: application/json');
$objUser1 = new User();
$stmt = $objUser1->runQuery('SELECT emp_type, COUNT(emp_type) AS count_emp_type FROM employee INNER JOIN emp_type ON employee.emp_type_id = emp_type.emp_type_id GROUP BY employee.emp_type_id');
$stmt->execute();
$employee = $stmt->fetchAll(PDO::FETCH_OBJ);

echo json_encode($employee,  JSON_UNESCAPED_UNICODE);
