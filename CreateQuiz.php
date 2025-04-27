<?php

include("./connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$quiz_category = htmlspecialchars($data['quiz_category']);

try{
    $query = $connection->prepare("INSERT INTO quizez (quiz_category) VALUES (?)");
    $query->execute([$quiz_category]);
    echo json_encode(["message" => "Quiz created successfully"]);
}catch (\Throwable $e) {

    echo $e;
}