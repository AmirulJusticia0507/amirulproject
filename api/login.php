<?php
include 'db.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];
$password = $data['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        echo json_encode(["message" => "Login successful", "user" => $row]);
    } else {
        echo json_encode(["message" => "Invalid credentials"]);
    }
} else {
    echo json_encode(["message" => "User not found"]);
}

$conn->close();
?>
