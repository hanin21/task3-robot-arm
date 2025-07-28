<?php
$id = $_GET['id'];

$conn = new mysqli("localhost", "root", "", "robot_arm");

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

$conn->query("DELETE FROM poses WHERE id=$id");
?>
