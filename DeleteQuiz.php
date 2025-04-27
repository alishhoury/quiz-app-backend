<?php

include("./connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$quiz_id = ($data['quiz_id']);

try{
    $query = $connection->prepare("DELETE FROM quizez WHERE quiz_id = ?");
    $query->execute([$quiz_id]);
    echo json_encode(["message" => "Quiz number $quiz_id deleted successfully"]);
} catch (\Throwable $e) {
    echo $e;
}