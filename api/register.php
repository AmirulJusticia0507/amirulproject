<?php
include 'db.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$data = json_decode(file_get_contents("php://input"), true);
$name = $data['name'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_BCRYPT);

$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Registration successful"]);
} else {
    echo json_encode(["message" => "Error: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>
