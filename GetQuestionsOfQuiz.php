<?php

include("./connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$quiz_id = ($data['quiz_id']);

try {
    
    $query = $connection->prepare("SELECT question_id,question  FROM questions Where quiz_id = ?");
    $query->execute([$quiz_id]);
    if ($query->rowCount() == 0) {
        echo json_encode(["message" => "No questions found for quiz ID $quiz_id"]);
        exit();
    }
    $quizez = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($quizez);

}catch (\Throwable $e) {

    echo $e;
}