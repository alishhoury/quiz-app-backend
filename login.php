<?php

include("./connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
$password = $data['password'];

try {
    $query = $connection->prepare ("SELECT user_id,email, password, user_name FROM users WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user){
        echo json_encode(["message" => "invalid crdentials"]);
        exit();
    }
   
    if (password_verify($password, $user['password'])) {
    unset($user['password']);
    echo json_encode([
        "message" => "Welcome back, " . $user['user_name'],
    ]);
    exit();

    } else {
        echo json_encode(["message" => "invalid password"]);
        exit();
    }
}catch (\Throwable $e) {

    echo $e;
}