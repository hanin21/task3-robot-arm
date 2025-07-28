<?php
$data = json_decode(file_get_contents('php://input'), true);

$conn = new mysqli("localhost", "root", "", "robot_arm");

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO poses (motor1, motor2, motor3, motor4, motor5, motor6) VALUES (?, ?, ?, ?, ?, ?)");

$stmt->bind_param("iiiiii", 
    $data['motor1'],
    $data['motor2'],
    $data['motor3'],
    $data['motor4'],
    $data['motor5'],
    $data['motor6']
);

$stmt->execute();
?>
