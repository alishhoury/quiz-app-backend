<?php

include("./connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$question_id = ($data['question_id']);

try{
    $query = $connection->prepare("DELETE FROM questions WHERE question_id = ?");
    $query->execute([$question_id]);
    echo json_encode(["message" => "Question number $question_id deleted successfully"]);
} catch (\Throwable $e) {
    echo $e;
}