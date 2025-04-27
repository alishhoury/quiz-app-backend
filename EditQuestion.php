<?php

include("./connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$question_id = ($data['question_id']);
$question = htmlspecialchars($data['question']);

try{
    $query = $connection->prepare("UPDATE questions SET question = ? WHERE question_id = ?");
    $query->execute([$question, $question_id]);
    echo json_encode(["message" => "Question $question_id updated successfully"]);
} catch (\Throwable $e) {
    echo $e;
}