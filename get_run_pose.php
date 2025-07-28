<?php
$conn = new mysqli("localhost", "root", "", "robot_arm");

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM poses ORDER BY id DESC LIMIT 1");

echo json_encode($result->fetch_assoc());
?>
