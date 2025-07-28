<?php
$conn = new mysqli("localhost", "root", "", "robot_arm");

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM poses");

$poses = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($poses);
?>
