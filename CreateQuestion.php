<?php

include("./connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$question = htmlspecialchars($data["question"]);
$quiz_id = ($data['quiz_id']);

try{
    $checkQuiz = $connection->prepare("SELECT * FROM quizez WHERE quiz_id = ?");
    $checkQuiz->execute([$quiz_id]);
    if ($checkQuiz->rowCount() == 0) {
        echo json_encode(["message" => "Quiz ID $quiz_id does not exist"]);
        exit();
    }
    $query = $connection->prepare("INSERT INTO questions (question, quiz_id) VALUES (?, ?)");
    $query->execute([$question, $quiz_id]);
    echo json_encode(["message" => "Question for quiz $quiz_id created successfully"]);
}catch (\Throwable $e) {

    echo $e;
}