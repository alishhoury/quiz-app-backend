<?php

include("./connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$quiz_id = ($data['quiz_id']);
$quiz_category = htmlspecialchars($data['quiz_category']);

try{
    $query = $connection->prepare("UPDATE quizez SET quiz_category = ? WHERE quiz_id = ?");
    $query->execute([$quiz_category, $quiz_id]);
    echo json_encode(["message" => "Quiz updated successfully"]);
} catch (\Throwable $e) {
    echo $e;
}