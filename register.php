<?php

include("./connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
$user_name = htmlspecialchars($data['user_name']);
$password = $data['password'];

 try{
    $checkEmail = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmail->execute([$email]);

    if ($checkEmail->rowCount>0){
        echo json_encode(["message" => "Email already exists"]);
        exit();
    }

    $query = $connection->prepare("INSERT INTO users (user_name,email,password) VALUES (?, ?, ?)");
    $query->execute([$user_name, $email, $password]);
    echo json_encode(["message" => "User registered successfully"]);
}catch (\Throwable $e) {

    echo $e;
}








// $query = $connection->prepare("SELECT * FROM users");

// $query->execute();

// $result = [];

// while ($user = $query->fetch(PDO::FETCH_ASSOC)) {
//     $result[] = $user;
// }

// echo json_encode($result);