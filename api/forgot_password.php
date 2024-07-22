<?php
include 'db.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Generate and send reset token (simplified for example)
    $reset_token = bin2hex(random_bytes(16));
    $sql_update = "UPDATE users SET remember_token='$reset_token' WHERE email='$email'";
    if ($conn->query($sql_update) === TRUE) {
        echo json_encode(["message" => "Reset token sent to email"]);
    } else {
        echo json_encode(["message" => "Error updating token"]);
    }
} else {
    echo json_encode(["message" => "User not found"]);
}

$conn->close();
?>
