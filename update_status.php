<?php
$conn = new mysqli("localhost", "root", "", "robot_arm");

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

$conn->query("UPDATE status SET value = 0 WHERE id = 1");
?>
